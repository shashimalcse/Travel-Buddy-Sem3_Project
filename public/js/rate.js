$(document).ready(function () {

    var ratedIndex = -1;
    var current_user = 0;
    $.get("http://localhost/php-mvc-master/public/mapquest/current-user", function (data) {
        current_user = data;
    });

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
                $("#rate").text("" + myJSON[0].rate);
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



    resetColors();
    if (localStorage.getItem('ratedIndex') != null) {
        setStars(parseInt(localStorage.getItem('ratedIndex')));
    };

    $('.fa-star').on('click', function () {

        rate = parseInt($(this).data('index')) + 1;
        //update_rating(5,"type",rate,23);
        load_rating(5, 'type');
        // localStorage.setItem('ratedIndex', ratedIndex);
        //saveToDatabase();
    });

    $('.fa-star').mouseover(function () {
        resetColors();
        var currentIndex = parseInt($(this).data('index'));
        setStars(currentIndex);
    });

    $('.fa-star').mouseleave(function () {
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


});