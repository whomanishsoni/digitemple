(function($){
    "use strict";
    $('#summornote_div_id').summernote({
        minHeight: 200,
        callbacks: {
            onImageUpload: function (files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        }
    });
 })(jQuery);

function sendFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: base_url+"admin/upload-summernote-image",
        cache: false,
        contentType: false,
        processData: false,
        success: function (url) {
            $('#summornote_div_id').summernote('insertImage', url, function ($image) {
                $image.attr('class', 'summornote_image_res');
            });
            if(url==""){
                alert("Please select image with size lower than 1MB.");
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}