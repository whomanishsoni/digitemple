(function($){
    "use strict";
    $(document).ready(() => {
        $('[data-toggle="popover-custom-content"]').each(function(t, e) {
            $(this).popover({
                html: !0,
                placement: "auto",
                template: '<div class="popover popover-custom" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                content: function() {
                    var t = $(this).attr("popover-id");
                    return $("#popover-content-" + t).html()
                }
            })
        }), $(".dropdown-menu").on("click", function(t) {
            var e= {};
            e = e.click || [];
            for (var i = 0; i < e.length; i++) e[i].selector && ($(t.target).is(e[i].selector) && e[i].handler.call(t.target, t), $(t.target).parents(e[i].selector).each(function() {
                e[i].handler.call(this, t)
            }));
            t.stopPropagation()
        }), $('[data-toggle="popover-custom-bg"]').each(function(t, e) {
            var i = $(this).attr("data-bg-class");
            $(this).popover({
                trigger: "focus",
                placement: "top",
                template: '<div class="popover popover-bg ' + i + '" role="tooltip"><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
            })
        }), $(function() {
            $('[data-toggle="popover"]').popover()
        }), $('[data-toggle="popover-custom"]').each(function(t, e) {
            $(this).popover({
                html: !0,
                container: $(this).parent().find(".rm-max-width"),
                content: function() {
                    return $(this).next(".rm-max-width").find(".popover-custom-content").html()
                }
            })
        }), $("body").on("click", function(t) {
            $('[rel="popover-focus"]').each(function() {
                $(this).is(t.target) || 0 !== $(this).has(t.target).length || 0 !== $(".popover").has(t.target).length || $(this).popover("hide")
            })
        }), $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        }), $(function() {
            $('[data-toggle="tooltip-light"]').tooltip({
                template: '<div class="tooltip tooltip-light"><div class="tooltip-inner"></div></div>'
            })
        }), $(".open-right-drawer").click(function() {
            $(this).addClass("is-active"), $(".app-drawer-wrapper").addClass("drawer-open"), $(".app-drawer-overlay").removeClass("d-none")
        }), $(".drawer-nav-btn").click(function() {
            $(".app-drawer-wrapper").removeClass("drawer-open"), $(".app-drawer-overlay").addClass("d-none"), $(".open-right-drawer").removeClass("is-active")
        }), $(".app-drawer-overlay").click(function() {
            $(this).addClass("d-none"), $(".app-drawer-wrapper").removeClass("drawer-open"), $(".open-right-drawer").removeClass("is-active")
        }), $(".mobile-toggle-nav").click(function() {
            $(this).toggleClass("is-active"), $(".app-container").toggleClass("header-mobile-open"), $(".app-header-right").hasClass("header-mobile-open") && $(".app-header-right").removeClass("header-mobile-open")
        }), $(".mobile-toggle-header-nav").click(function() {
            $(this).toggleClass("active"), $(".app-header-right").toggleClass("header-mobile-open"), $(".app-container").hasClass("header-mobile-open") && $(".app-container").removeClass("header-mobile-open")
        }), $(".show-menu-btn").on("click", function() {
            $(".app-inner-layout-page").addClass("app-layout-menu-open")
        }), $(".close-menu-btn").on("click", function() {
            $(".app-inner-layout-page").removeClass("app-layout-menu-open")
        }), $(".mobile-app-menu-btn").click(function() {
            $(".hamburger", this).toggleClass("is-active"), $(".app-inner-layout").toggleClass("open-mobile-menu")
        }), $(window).scroll(function() {
            var t = $(".app-top-bar").height();
            $(this).scrollTop() >= t ? $(".app-container").addClass("fixed-header") : $(".app-container").removeClass("fixed-header"), $(this).scrollTop() >= t + 50 ? $(".app-container").addClass("scrolled-header") : $(".app-container").removeClass("scrolled-header"), $(this).scrollTop() >= t + 80 ? $(".app-container").addClass("smaller-header") : $(".app-container").removeClass("smaller-header")
        }), $(window).on("resize", function() {
            $(this).width() > 991 && ($(".app-container").removeClass("header-mobile-open"), $(".mobile-toggle-nav").removeClass("is-active"))
        })
    });

    if($("#example").length>0) {
        $('#example').DataTable();
    }

    // Changes Passworf Form


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
            messages: {
                password: {
                    required: "Please enter new password",
                    minlength: "Please enter minimum 8 characters"
                },
                confirm_password: {
                    required: "Please enter confirm password",
                    equalTo: "Password and confirm must be same"
                }
            },
            highlight: function (e) {
                $(e).closest('.validate').removeClass('has-success has-error').addClass('has-error');
            }
        });
    }


})(jQuery);


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
            if (data == true) {
                window.location.reload();
            } else {
                window.location.reload();
            }
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