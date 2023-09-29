$(document).ready(function(e){

    if($('table').length>0){
        $('table').DataTable();
    }
	
	$(".datepicker").datepicker({
		format: "yyyy-mm-dd"
	});

    r = $("#Login,#Forgot_password,#Save_Form,#site_form,#site_email_form,#PaymentForm,#LanguageForm,#Reset_password").validate({
        ignore: ":hidden",
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            error.addClass( "invalid-feedback" );
            error.insertAfter( element );
            if ( element.prop( "id" ) === "email_address" || element.prop( "id" ) === "phone_number" ) {
                error.insertAfter( element.parent('div') ) ;
            }
            if( $(element).attr('data-live-search') === "true" ){
                error.insertAfter( element.parent('div') );
            }
            if(element.prop('type') === 'file'){
                error.insertAfter( element.parent('div').parent('div') );
            }
            if( $(element).hasClass('kt-selectpicker')){
                error.insertAfter( element.parent('div') );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            if( $(element).attr('data-live-search') === "true" ){
                $( element ).parent('div').addClass( "is-invalid" ).removeClass( "is-valid" );
            }
            if( $(element).hasClass('kt-selectpicker')){
                $( element ).parent('div').addClass( "is-invalid" ).removeClass( "is-valid" );
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            if( $(element).attr('data-live-search') === "true" ){
                $( element ).parent('div').addClass( "is-valid" ).removeClass( "is-invalid" );
            }
            if( $(element).hasClass('kt-selectpicker')){
                $( element ).parent('div').addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        },
        submitHandler: function (form) {
            $(".spinner-border").removeClass('d-none');
            $("button[type='submit']").prop('disabled',true);
            form.submit();
        }
    });


    if($("#change_password_form").length>0){
        $("#change_password_form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                error.addClass( "invalid-feedback" );
                error.insertAfter( element );
                if ( element.prop( "id" ) === "email_address" || element.prop( "id" ) === "phone_number" ) {
                    error.insertAfter( element.parent('div') ) ;
                }
                if( $(element).attr('data-live-search') === "true" ){
                    error.insertAfter( element.parent('div') );
                }
                if(element.prop('type') === 'file'){
                    error.insertAfter( element.parent('div').parent('div') );
                }
                if( $(element).hasClass('kt-selectpicker')){
                    error.insertAfter( element.parent('div') );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                if( $(element).attr('data-live-search') === "true" ){
                    $( element ).parent('div').addClass( "is-invalid" ).removeClass( "is-valid" );
                }
                if( $(element).hasClass('kt-selectpicker')){
                    $( element ).parent('div').addClass( "is-invalid" ).removeClass( "is-valid" );
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                if( $(element).attr('data-live-search') === "true" ){
                    $( element ).parent('div').addClass( "is-valid" ).removeClass( "is-invalid" );
                }
                if( $(element).hasClass('kt-selectpicker')){
                    $( element ).parent('div').addClass( "is-valid" ).removeClass( "is-invalid" );
                }
            },
            submitHandler: function (form) {
                $(".spinner-border").removeClass('d-none');
                $("button[type='submit']").prop('disabled',true);
                form.submit();
            }
        });
    }

});




function toggle_payment_type(type) {
    if(type!="P" && type!="S"){
        if(type=='CA'){
            $("#cheq_div").addClass('d-none');
            $("#cheque_no").attr('required',false);
        }else{
            $("#cheq_div").removeClass("d-none");
            $("#cheque_no").attr('required',true);
        }
    }
}
function copy_link() {
    var copyText = document.getElementById("copy_web_link");
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/
    document.execCommand("copy");
}
function change_php() {
    $("#php_block").removeClass('d-none');
    $("#php_block").addClass('d-block');

    $("#smtp_block").removeClass('d-block');
    $("#smtp_block").addClass('d-none');

    $("#email_from").attr("required", true);
}
function change_smtp() {
    $("#php_block").removeClass('d-block');
    $("#php_block").addClass('d-none');

    $("#smtp_block").removeClass('d-none');
    $("#smtp_block").addClass('d-block');

    $("#email_from").attr("required", false);
}
function DeleteConfirm(element) {
    var id = $(element).attr('data-id');
    var action = $(element).attr('data-action');
    $("#record_id").val(id);
    $("#form_action").val(action);
}
function DeleteRecord(element) {
    var id = $("#record_id").val();
    var form_action = $("#form_action").val();
    $.ajax({
        url: base_url +'admin/'+ form_action + '/' + id,
        type: "post",
        data: {},
        beforeSend: function () {

        },
        success: function (data) {
            window.location.reload();
        }
    });
}
// Profile Image On Click Function
function company_logo_change(input) {
    var id = $(input).attr("id");
    var image = '#' + id;
    //alert(image);
    var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
        var reader = new FileReader();
    reader.onload = function (e) {
        $('img' + image).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}

// Profile Image On Click Function
function company_favicon_change(input) {
    var id = $(input).attr("id");
    var image = '#' + id;

    var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))

        var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_fav_icon').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}

// Image On Click Function
function readURL(input) {
    var id = $(input).attr("id");
    var image = '#' + id;
    //alert(image);
    var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
        var reader = new FileReader();
    reader.onload = function (e) {
        $('img' + image).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}
function preview_banner_image(input) {
    var id = $(input).attr("id");
    var nm = $(input).data("nm");
    var image = '#' + nm;

    var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
        var reader = new FileReader();
    reader.onload = function (e) {
        $('img' + image).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}