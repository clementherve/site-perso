//Change the color on drag over
var upBox = $(".upBox");
upBox.on("dragstart dragover dragenter", function () {
    "use strict";
    upBox.css({"background-color": "#B39DDB"});
});

//Back to the original color
upBox.on("dragend dragleave drop", function () {
    "use strict";
    upBox.css({"background-color": "white"});
});

//Prevent default
upBox.on("dragenter dragstart dragend dragleave dragover drag change", function (event) {
    "use strict";
    event.stopImmediatePropagation;
    event.stopPropagation;
    return false;
});

//Upload
upBox.on("drop", function (event) {
    "use strict";
    event.dataTransfer = event.originalEvent.dataTransfer;

    var files = event.dataTransfer.files,
        formData = new FormData(),
        name = Date.now();

    //Adding the post variables
    formData.append("media", files[0]);
    formData.append("name", name);

    //Ajax upload
    $.ajax({
        url: "../admin/functions/media_upload.php",
        type: "POST",
        contentType: false,
        processData: false,
        data: formData
    })
    //Upload status feedback
    .always(function(resp){
        "use strict";
        resp = JSON.parse(resp);
        if (resp["status"] === "ok") {
           $(".upbox p").html("Successful upload!");
            $(".upbox p").css({"color": "white"});
        } else {
            $(".upbox p").html("Upload failed :( Reason: " + resp["why"]);
            $(".upbox p").css({"color": "white"});
        }
    })
    event.stopImmediatePropagation;
    event.stopPropagation;
    return false;
})