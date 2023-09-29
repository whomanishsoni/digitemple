(function($){
    "use strict";
    $(document).ready(function () {
        $('.save_translated_lang').on('click', function () {
            var id = $(this).attr('data-id');
        });
    });
})(jQuery);

function save_translated_lang(element) {
    var id = $(element).attr('data-id');
    var field = $(element).attr('data-field');
    var text_value = $("#db_field_" + id).val();
    var record_update_hidden=$("#record_update_hidden").val();

    $.ajax({
        url: base_url +"admin/"+ "save-translated-language/" + id,
        type: "post",
        data: {id: id, field: field, text_value: text_value},
        beforeSend: function () {
            $('.loadingmessage').show();
        },
        success: function (data) {
            $('.loadingmessage').hide();
            if (data == true) {
                alert(record_update_hidden);
            } else {
                window.location.reload();
            }
        }
    });
}

function get_more_image(e) {
    h = '<input type="file" name="image[]" class="form-control mt-10">';
    $("#image-data").append(h);
}