var get_stripepublish=$("#get_stripepublish").val();

var handler = StripeCheckout.configure({
    key: get_stripepublish,
    image: '',
    token: function (token) {
        $('#loadingmessage').show();
        $('#donationForm').append("<input type='hidden' name='stripeToken' value='" + token.id + "' />");
        $("#donationForm").submit();
    }
});

// Close Checkout on page navigation
$(window).on('popstate', function () {
    handler.close();
});

function get_stripe() {
    var payment_price = $("#amount").val();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    var get_current_currency=$("#get_current_currency_hidden").val();

    var total = parseInt(payment_price) * 100;
    handler.open({
        name: first_name + " " + last_name,
        email: email,
        amount: total,
        currency:get_current_currency,
    });
}



