$("#image").on('change', function() {

    //Get count of selected files
    var countFiles = $(this)[0].files.length;
    var image_holder = $("#image-holder");
    image_holder.empty();


    if (typeof(FileReader) != "undefined") {

        //loop for each file selected for uploaded.
        for (var i = 0; i < countFiles; i++) {

            var reader = new FileReader();
            reader.onload = function(e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    "style": "width:48%"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[i]);
        }

    } else {
        alert("This browser does not support FileReader.");
    }

});