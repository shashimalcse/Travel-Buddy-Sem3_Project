window.onload = function () {

    L.mapquest.key = 'DVCBD2Ox8xqJfaPbtLgTMLBAHsWN6XbB';

    var map = L.mapquest.map('map', {
        center: [6.9271510828, 79.845242500], //lat,long
        layers: L.mapquest.tileLayer('map'),
        zoom: 8,

    });

    map.addControl(L.mapquest.geocodingControl({
        position: 'topright',
        searchAhead: true,
        searchAheadOptions: {
            countryCode: 'LK',
        }
    }));
    map.addControl(L.mapquest.control({
        position: 'bottomright',
    }));

    let directionsControl = L.mapquest.directionsControl({
        className: '',
        directions: {
            options: {
                timeOverage: 25,
                doReverseGeocode: false,
            }
        },
        directionsLayer: {
            startMarker: {
                title: 'Drag to change location',
                draggable: false,
                icon: 'marker-start',
                iconOptions: {
                    size: 'sm'
                }
            },
            endMarker: {
                draggable: false,
                title: 'Drag to change location',
                icon: 'marker-end',
                iconOptions: {
                    size: 'sm'
                }
            },
            viaMarker: {
                title: 'Drag to change route'
            },
            routeRibbon: {
                showTraffic: true
            },
            alternateRouteRibbon: {
                showTraffic: true
            },
            paddingTopLeft: [450, 20],
            paddingBottomRight: [180, 20],
        },
        startInput: {
            compactResults: true,
            disabled: false,
            location: {},
            placeholderText: 'Starting point or click on the map...',
            geolocation: {
                enabled: true
            },
            clearTitle: 'Remove starting point'
        },
        endInput: {
            compactResults: true,
            disabled: false,
            location: {},
            placeholderText: 'Destination',
            geolocation: {
                enabled: true
            },
            clearTitle: 'Remove this destination'
        },
        addDestinationButton: {
            enabled: true,
            maxLocations: 10,
        },
        routeTypeButtons: {
            enabled: true,
        },
        reverseButton: {
            enabled: true,
        },
        optionsButton: {
            enabled: true,
        },
        routeSummary: {
            enabled: true,
            compactResults: false,
        },
        narrativeControl: {
            enabled: true,
            compactResults: false,
            interactive: true,
        }
    }).addTo(map);

    var circleArray = Array();
    var desArray = Array();
    //layers
    var vehiclerenterLayer = L.geoJSON().addTo(map);
    var hotelLayer = L.geoJSON().addTo(map);
    var shopLayer = L.geoJSON().addTo(map);
    var vehiclerenterLayerAll = L.geoJSON().addTo(map);
    var hotelLayerAll = L.geoJSON().addTo(map);
    var shopLayerAll = L.geoJSON().addTo(map);


    //check if already fetched.
    var vehiclerenterFetch = false;
    var hotelFetch = false;
    var shopsFetch = false;
    var vehiclerenterFetchAll = false;
    var hotelFetchAll = false;
    var shopsFetchAll = false;

    //checkboxes

    var checkB1 = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name = "checkbox" id="hotel" ><label class="custom-control-label" for="hotel">Hotels</label> </div>';
    var checkB2 = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name = "checkbox" id="vehiclerenter" ><label class="custom-control-label" for="vehiclerenter">Vehicles</label></div>';
    var checkB3 = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name = "checkbox" id="shops"><label class="custom-control-label" for="shops">Shops</label></div>';
    var checkbox = '<div class= "checkboxes">' + checkB1 + checkB2 + checkB3 + '</div>';

    var opB1 = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="hotelAll" ><label class="custom-control-label" for="hotelAll">AllHotels</label> </div>';
    var opB2 = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="vehiclerenterAll" ><label class="custom-control-label" for="vehiclerenterAll">AllVehicles</label></div>';
    var opB3 = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="shopsAll"><label class="custom-control-label" for="shopsAll">AllShops</label></div>';

    var opbox = '<div class= "opboxes">' + opB1 + opB2 + opB3 + '</div>';
    var box = '<div>' + checkbox + opbox + '</div>';
    $(".options-control-container").append(box);
    $(".options-control-container").attr("style", "margin-bottom:3%;");
    //

    //remove this
    // map.on('click', function(e) {

    //     var temp = addTodesArray();
    //     if(JSON.stringify(desArray) != JSON.stringify(temp) ){
    //         console.log(temp);
    //         desArray = temp;
    //     }


    // });

    var observer = new MutationObserver(function (mutations) {
        var temp = addTodesArray();
        if (JSON.stringify(desArray) != JSON.stringify(temp)) {
            hotelLayer.clearLayers();
            vehiclerenterLayer.clearLayers();
            shopLayer.clearLayers();
            vehiclerenterFetch = false;
            hotelFetch = false;
            shopsFetch = false;
            var checkboxes = $("input[name='checkbox']");
            for (let index = 0; index < checkboxes.length; index++) {
                const element = checkboxes[index];
                if (element.checked) {

                    ifChecked(element.id);
                };

            }
            desArray = temp;
            circleArray.forEach(el => {
                el.remove();
            });
            circleArray.length = 0;
            desArray.forEach(crd => {
                createCircle(crd.lat, crd.lng, 10000);
            });
            //look for ticks and ajaxcall them again   
        }
    });

    // Let's configure the observer
    var config = {
        childList: true,
        subtree: true,
        attributes: true,
        characterData: true,
        characterDataOldValue: true,
        attributeOldValue: true
    };

    var target = document.getElementsByClassName("input-container")[0];

    observer.observe(target, config);


    //Geolocation to get positions. need to implement this
    //possible to use layer.filter
    //remove a cuurent layer
    $("#new").click(function () {
        hotelLayer.clearLayers();
        console.log("layer romeved");
    });



    // changed it to below one
    $(".custom-control-input").change(function () {
        if (this.checked == true) {
            ifChecked(this.id);
        } else {
            ifUnchecked(this.id);
        }
    });
    //checkboxes
    function ifChecked(type) {
        console.log(type);
        switch (type) {
            case "vehiclerenter":
                if (vehiclerenterFetch == false) {
                    ajaxCall(type, vehiclerenterLayer);
                    vehiclerenterFetch = true;
                } else {
                    vehiclerenterLayer.addTo(map);
                }
                break;
            case "hotel":
                if (hotelFetch == false) {
                    ajaxCall(type, hotelLayer);
                    hotelFetch = true;
                } else {
                    hotelLayer.addTo(map);
                }
                break;
            case "vehiclerenterAll":
                if (vehiclerenterFetchAll == false) {
                    ajaxCallAll("vehiclerenter", vehiclerenterLayerAll);
                    vehiclerenterFetchAll = true;
                } else {
                    vehiclerenterLayerAll.addTo(map);
                }
                break;
            case "hotelAll":
                if (hotelFetchAll == false) {
                    ajaxCallAll("hotel", hotelLayerAll);
                    hotelFetchAll = true;
                } else {
                    hotelLayerAll.addTo(map);
                }
                break;
        }
    }

    function ifUnchecked(type) {
        switch (type) {
            case "vehiclerenter":
                vehiclerenterLayer.remove();
                break;

            case "hotel":
                hotelLayer.remove();
                break;

            case "vehiclerenterAll":
                vehiclerenterLayerAll.remove();
                break;

            case "hotelAll":
                hotelLayerAll.remove();
                break;
        }

    }

    function ajaxCallAll(type, layer) {

        $.ajax({

            url: 'data.php',

            type: 'POST',
            //passing variable to php
            data: 'type=' + type,

            async: true,

            success: function (data) {

                myJSON = JSON.parse(data);
                //console.log(typeof myJSON);
                layer.addData(myJSON);

                layer.on("click", markerOnClick);

            },
        });
    }

    function addTodesArray() {
        //creating destinations array and circles
        var desArray = [];

        for (var loc in directionsControl._locations) {
            desArray.push(directionsControl._locations[loc].displayLatLng)
        };
        //console.log(desArray);
        //console.log(circleArray);
        return desArray;

    }

    function ajaxCall(type, layer) {
        console.log(layer);
        desArray = addTodesArray();

        // createCircle(map._layers[key]._latlng.lat,map._layers[key]._latlng.lng,10000);

        $.ajax({

            url: 'data.php',

            type: 'POST',
            //passing variable to php
            data: 'type=' + type,

            async: true,

            success: function (data) {

                myJSON = JSON.parse(data);
                //radius
                filteredJSON = (checkWithinCircle(desArray, myJSON, 10000));
                layer.addData(filteredJSON);
                layer.on("click", markerOnClick);

            },
        });
    }

    function createCircle(lat, lon, radius) {
        //radius in meters
        circleArray.push(L.circle([lat, lon], {
            radius: radius
        }).addTo(map));
    }


    var props;
    var geometry;
    var type;

    function markerOnClick(e) {

        //add here shop details
        var div = $('<div id="markerDetails" />');
        props = e.layer.feature.properties;
        geometry = e.layer.feature.geometry;
        type = e.layer.feature.type;

        $.dialog({
            "body": div,
            "title": "DETAILS",
            "show": true,
            "modal": true
        });
        requestData(props.name, props.title, props.id);
        //ajaxVehicleRenter(props.name,props.title);

    }

    function requestData(username, title, id) {
        $.ajax({

            url: 'DataRequest.php',

            type: 'POST',
            //passing variable to php

            data: {
                'user': username,
                'title': title,
                'id': id
            },

            async: true,

            success: function (data) {
                recievedData = JSON.parse(data);
                console.log(recievedData);
                switch (title) {
                    case 'vehiclerenter':
                        recievedData.forEach(element => {

                            image_holder = $("<div class=image-holder-dialog>");
                            $("#markerDetails").append(image_holder);
                            $("<p><b>Type : </b>" + element.type + "</p>").appendTo(image_holder);
                            $("<p><b>Model : </b>" + element.model + "</p>").appendTo(image_holder);
                            (element.files).forEach(el => {

                                img_src = element.directory + el;

                                $("<img />", {
                                    "src": img_src,
                                    "class": "thumb-image",
                                    "style": "width:33.3%;height:150px"
                                }).appendTo(image_holder);
                            });
                            $("<p><b>Details : </b>" + element.details + "</p>").appendTo(image_holder);
                        });
                        break;

                        case 'hotel':
                            recievedData.forEach(element => {

                                image_holder = $("<div class=image-holder-dialog>");
                                $("#markerDetails").append(image_holder);
                                $("<pre class='text-secondary'><b>Hotel : </b>"+element.hotelName+"</pre>").appendTo(image_holder);
                                $("<pre class='text-secondary'><b>Rooms : </b>"+element.rooms+"</pre>").appendTo(image_holder);
                                $("<pre class='text-secondary'><b>Price : Rs.</b>"+element.price+"</pre>").appendTo(image_holder);
                                $("<pre class='text-secondary'><b>Facilities : </b>"+element.facilities+"</pre>").appendTo(image_holder);
                                
                            (element.files).forEach(el => {



                                img_src=element.directory+el;

                                $("<img />", {
                                    "src": img_src,
                                    "class": "thumb-image",
                                    "style": "width:33.3%;height:150px"
                                }).appendTo(image_holder);
                            });

                        });
                        break;
                    
                   

                    
                }

            },

        });

    }

};





function checkWithinCircle(desArray, jsonData, radius) {
    filteredData = Array();
    for (data in jsonData) {
        lon = jsonData[data].geometry.coordinates[0];
        lat = jsonData[data].geometry.coordinates[1];

        for (coord in desArray) {

            if (radius >= getDistanceFromLatLonInKm(lat, lon, desArray[coord].lat, desArray[coord].lng)) {

                filteredData.push(jsonData[data]);
                break;
            }
        }

    }
    return filteredData;
};

function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1); // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d * 1000; //distance in meters
}

function deg2rad(deg) {
    return deg * (Math.PI / 180)
}

class type {

    get Layer() {
        return this.Layer;
    }
    get Fetch() {
        return this.Fetch;
    }
    Fetch(bool) {
        this.Fetch = bool;
    }

}