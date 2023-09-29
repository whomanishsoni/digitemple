(function($){
    "use strict";
    $(document).ready(() => {

        var stripe_value=$("#stripe_hidden_id").val();
        var paypal_value=$("#paypal_hidden_id").val();
        var razorpay_value=$("#razorpay_hidden_id").val();

        check_stripe_val(stripe_value);
        check_paypal_val(paypal_value);
        check_razorpay_val(razorpay_value);

    });
})(jQuery);


function check_stripe_val(e) {
    if (e == 'Y') {
        $('.stripe-html').removeClass('d-none');
        $('#stripe_secret').attr('required', true);
        $('#stripe_publish').attr('required', true);
    } else {
        $('.stripe-html').addClass('d-none');
        $('#stripe_secret').attr('required', false);
        $('#stripe_publish').attr('required', false);
    }
}

function check_razorpay_val(e) {
    if (e == 'Y') {
        $('.razorpay-html').removeClass('d-none');
        $('#razorpay_merchant_key_id').attr('required', true);
        $('#razorpay_merchant_key_secret').attr('required', true);
    } else {
        $('.razorpay-html').addClass('d-none');
        $('#razorpay_merchant_key_id').attr('required', false);
        $('#razorpay_merchant_key_secret').attr('required', false);
    }
}

function check_paypal_val(e) {
    if (e == 'Y') {
        $('.palpal-html').removeClass('d-none');
        $('#paypal_merchant_email').attr('required', true);
    } else {
        $('.palpal-html').addClass('d-none');
        $('#paypal_merchant_email').attr('required', false);
    }
}