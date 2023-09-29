(function($){
    "use strict";
    var onFormSubmit = function ($form) {

        $form.find('[type="submit"]').find(".button-text").addClass("hide");
        $("#alert-container").html("");
    };
    var onSubmitSussess = function ($form) {
        $form.find('[type="submit"]').removeAttr('disabled').find(".loader").addClass("hide");
        $form.find('[type="submit"]').find(".button-text").removeClass("hide");
    };

    $(document).ready(function () {
        $( "#form_wizard" ).wizard({
            submit: ".submit",
            beforeForward: function( event, state ) {
                if ( state.stepIndex === 1 ) {
                    $("#name").text($("[name=name]").val());

                } else if ( state.stepIndex === 2 ) {
                    $("#gender").text($("[name=gender]").val());
                }
                return $( this ).wizard( "form" ).valid();
            }
        }).wizard( "form" ).submit(function( event ) {
            event.preventDefault();
            $("#config-form").ajaxSubmit({
                dataType: "json",
                beforeSend: function () {
                    $('.loadingmessage').show();
                },
                success: function (result) {
                    $('.loadingmessage').hide();
                    //onSubmitSussess($form, result);

                    if (result.success == true) {
                        $("#configuration").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                        $("#finished").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                        $("#finished").addClass("active");
                        $("#finished-tab").addClass("active");
                        var base_url = $("#base_url").val();
                        window.location.href = base_url;
                        $('.loadingmessage').hide();
                    } else {
                        $('.loadingmessage').hide();
                        $("#dashboard-error").hide();
                        $("#alert-container").html('<div class="alert alert-danger" role="alert">' + result.message + '</div>');
                        $("input[type='submit']").removeAttr("disabled");
                        $("#" + result.id).trigger("click");
                    }
                },
                error: function (result) {
                    $('.loadingmessage').hide();
                    $("#dashboard-error").show();
                    $("input[type='submit']").removeAttr("disabled");
                    $("#db_step").trigger("click");
                }
            });

        }).validate();
    });
})(jQuery);


function readURL(input) {
    var id = $(input).attr("id");
    var image = '#' + id;
    $('img' + image).removeClass("d-none");
    var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
        var reader = new FileReader();
    reader.onload = function (e) {
        $('img' + image).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}
function func_php() {
    $("#php_block").show();
    $("#smtp_block").hide();
    $("#email_from").attr("required", true);
}
function func_smtp() {
    $("#php_block").hide();
    $("#smtp_block").show();
    $("#email_from").attr("required", false);
}