function submit_donation_form() {
    if ($("#donationForm").valid()) {
        var payment_by = $("input[name='payment_by']:checked"). val();
        if(payment_by=='S'){
            get_stripe();
        }else{
            $("#donationForm").submit();
        }
    }
}

function submit_contact_form() {
    if ($("#contact_us_form").valid()) {
        $("#contact_us_form").submit();
    }
}