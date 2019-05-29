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

    //460*700
    var rightSidebar = L.control.sidebar('sidebar-right', {
        position: 'right',
        closeButton: true,
        autoPan: false,

    });
    map.addControl(rightSidebar);



    // setTimeout(function () {
    //     rightSidebar.toggle();
    // }, 2000);




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
            case "shops":
                if (hotelFetch == false) {
                    ajaxCall(type, shopLayer);
                    shopsFetch = true;
                } else {
                    shopLayer.addTo(map);
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
            case "shopsAll":
                if (shopsFetchAll == false) {
                    ajaxCallAll("shops", shopLayerAll);
                    shopsFetchAll = true;
                } else {
                    shopLayerAll.addTo(map);
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

            case "shops":
                shopLayer.remove();
                break;

            case "vehiclerenterAll":
                vehiclerenterLayerAll.remove();
                break;

            case "hotelAll":
                hotelLayerAll.remove();
                break;

            case "shopsAll":
                shopLayerAll.remove();
                break;
        }

    }

    function ajaxCallAll(type, layer) {

        $.ajax({

            url: '../GetData/data.php',

            type: 'POST',
            //passing variable to php
            data: 'type=' + type,

            async: true,

            success: function (data) {

                myJSON = JSON.parse(data);
                console.log(myJSON);
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

            url: '../GetData/data.php',

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

        props = e.layer.feature.properties;
        geometry = e.layer.feature.geometry;
        type = e.layer.feature.type;

        rightSidebar.hide();
        $("#sidebar-right-content").empty();
        console.log("userid"+props.userid, "title"+props.title,"id"+props.id);
        requestData(props.userid, props.title, props.id);
        load_rating(props.id, props.title);
        rightSidebar.show();
        
        //ajaxVehicleRenter(props.name,props.title);

    }

    function requestData(user_id, title, id) {
        $.ajax({

            url: '../GetData/DataRequest.php',

            type: 'POST',
            //passing variable to php

            data: {
                'user': user_id,
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
                            //div class = img-holder
                            image_holder = $("<div class='jumbotron'>");
                            $("#sidebar-right-content").append(image_holder);
                            $("<h4 align='center'>" + element.type + "</h3>").appendTo(image_holder);
                            
                            $("<hr><pre class='text-secondary'><i class='fas fa-car'></i><b> Modal : </b>" + element.model + "</pre>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-wind'></i><b> AC : </b>" + element.ac + "</pre>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-dollar-sign'></i><b> Cost Rs : </b>" + element.cost + "</pre>").appendTo(image_holder);
                            //can change width and height 
                            foto = $(`<div class="fotorama" data-width="100%"
                                data-height="250" data-auto="false"
                                data-allowfullscreen="true"
                                ></div>`);
                            image_holder.append(foto);
                            (element.files).forEach(el => {

                                img_src = JSON.stringify(element.directory + el);
                                foto.append(`<img src=${img_src} >`);

                            });

                            $("<pre class='text-secondary'><i class='fas fa-info-circle'></i><b> Details : </b>" + element.details + "</pre>").appendTo(image_holder);

                        });
                        jumbo = $("<div class='jumbotron'>");
                        $("#sidebar-right-content").append(jumbo);
                        jumbo.append(`<div id="rate-container">
                            <p id="current-rating">Current Rating: </p>
                            <p>Rate:
                            <i class="far fa-star" id="starone"data-index="0" ></i>
                            <i class="far fa-star" data-index="1" ></i>
                            <i class="far fa-star" data-index="2" ></i>
                            <i class="far fa-star" data-index="3" ></i>
                            <i class="far fa-star" data-index="4" ></i></p>
                        </div>`);
                        addRateEvent(id,title);
                        load_rating(id,title);

                        $('.fotorama').fotorama();
                        break;

                    case 'hotel':
                        recievedData.forEach(element => {

                            image_holder = $("<div class='jumbotron' id='marker-detail' style='padding:25px 20px'>");
                            $("#sidebar-right-content").append(image_holder);
                            $("<h4 align='center'>" + element.hotelName + "</h3>").appendTo(image_holder);
                            $("<pre class='text-secondary'><i class='fas fa-info-circle'></i><b> Details : </b>" + element.details + "</pre>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-phone'></i><b> Contact : </b>" + element.telephone + "</pre>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-road'></i><b> Address : </b>" + element.address + "</pre>").appendTo(image_holder);

                            foto = $(`<div class="fotorama" data-width="100%"
                                data-height="250" data-auto="false"
                                data-allowfullscreen="true"
                                ></div>`);
                            image_holder.append(foto);

                            (element.files).forEach(el => {
                                img_src = JSON.stringify(element.directory + el);
                                foto.append(`<img src=${img_src} >`);
                            });

                            image_holder.append(`<div id="rate-container">
                            <p id="current-rating">Current Rating: </p>
                            <p>Rate:
                            <i class="far fa-star" id="starone"data-index="0" ></i>
                            <i class="far fa-star" data-index="1" ></i>
                            <i class="far fa-star" data-index="2" ></i>
                            <i class="far fa-star" data-index="3" ></i>
                            <i class="far fa-star" data-index="4" ></i></p>
                        </div>`);



                        });
                        $('.fotorama').fotorama();
                        
                        console.log('hotelid'+id);
                        addRateEvent(id,title);
                        load_rating(id,title);
                        break;

                    case 'shops':
                        recievedData.forEach(element => {
                            image_holder = $("<div class='jumbotron'style='padding:25px 20px'>");
                            $("#sidebar-right-content").append(image_holder);
                            $("<h4 align='center'>" + element.shopName + "</h3>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-store-alt'></i><b> Shop Type : </b>" + element.shopType + "</pre>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-info-circle'></i><b> Details : </b>" + element.details + "</pre>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-phone'></i><b> Contact : </b>" + element.telephone + "</pre>").appendTo(image_holder);
                            $("<hr><pre class='text-secondary'><i class='fas fa-road'></i><b> Address : </b>" + element.address + "</pre>").appendTo(image_holder);

                            foto = $(`<div class="fotorama" data-width="100%"
                                data-height="250" data-auto="false"
                                data-allowfullscreen="true"
                                ></div>`);
                            image_holder.append(foto);
                            (element.files).forEach(el => {
                                img_src = JSON.stringify(element.directory + el);
                                foto.append(`<img src=${img_src} >`);
                            });
                            image_holder.append(`<div id="rate-container">
                            <p id="current-rating">Current Rating: </p>
                            <p>Rate:
                            <i class="far fa-star" id="starone"data-index="0" ></i>
                            <i class="far fa-star" data-index="1" ></i>
                            <i class="far fa-star" data-index="2" ></i>
                            <i class="far fa-star" data-index="3" ></i>
                            <i class="far fa-star" data-index="4" ></i></p>
                        </div>`);
                        });
                        $('.fotorama').fotorama();
                        addRateEvent(id,title);
                        load_rating(id,title);
                        break;

                }

            },

        });

    }

    function addRateEvent(id,title){
        $('.fa-star').click(function () {
            ratedIndex = parseInt($(this).data('index'));
            var current_user = 0;
            $.get("http://localhost/php-mvc-master/public/mapquest/current-user", function (data,status) {
                
                current_user = data;
                rate = ratedIndex + 1;
                console.log(id+'id'+title+'title'+rate+'rate'+'user'+current_user);
                update_rating(id, title, rate, current_user);
                load_rating(id, title);

            }).fail(function () {
                alert("fail")
            });
        });
    }


    function load_rating(id, type) {

        $.ajax({

            url: '../GetData/fetch.php',

            type: 'POST',

            data: {
                'id': id,
                'type': type,
            },
            success: function (data) {

                myJSON = JSON.parse(data);
                console.log("load_rate");
                console.log(myJSON);
                $("#current-rating").text("Current Rating: " + myJSON[0].rate+"/5");
            },
            error: function () {
                alert("ajax error");
            }
        });
    };

    function update_rating(id, type, rate, user_id) {
        $.ajax({
            url: '../GetData/update.php',

            type: 'POST',

            data: {
                'id': id,
                'type': type,
                'rate': rate,
                'user_id': user_id,
            },
            success: function (data) {

                myJSON = JSON.parse(data);
                console.log(myJSON);
            },
            error: function () {
                alert("ajax error");
            }
        });
    };

    var ratedIndex=-1;

    resetColors();
    if (localStorage.getItem('ratedIndex') != null) {
        setStars(parseInt(localStorage.getItem('ratedIndex')));
    };

    $(document).on('click', '.fa-star', function () {
        console.log("hello");

        //update_rating(5,"type",rate,23);
        load_rating(5, 'type');
        // localStorage.setItem('ratedIndex', ratedIndex);
        //saveToDatabase();
    });


    $(document).on('mouseover', '.fa-star', function () {
        resetColors();
        var currentIndex = parseInt($(this).data('index'));
        setStars(currentIndex);
    });

    $(document).on('mouseleave', '.fa-star', function () {
        resetColors();
        if (ratedIndex != -1) {
            setStars(ratedIndex);
        }
    });



    function setStars(max) {
        for (var i = 0; i <= max; i++) {
            $('.fa-star:eq(' + i + ')').css('color', 'orange')
        }
    };

    function resetColors() {
        $('.fa-star').css('color', 'black');
    };



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