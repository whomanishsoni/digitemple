<?php

class Razorpay {

    var $fields = array();           // array holds the fields to submit to paypal

    function __construct() {
        $this->api_url="https://api.razorpay.com/v1/checkout/embedded";
    }

    function add_field($field, $value) {
        $this->fields["$field"] = $value;
    }

    function submit() {
        echo "<html>\n";
        echo "<body onLoad=\"document.forms['razorpay_form'].submit();\">\n";
        echo "<form method=\"post\" name=\"razorpay_form\" ";
        echo "action=\"" . $this->api_url . "\">\n";
        foreach ($this->fields as $name => $value) {
            echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
        }
        echo "</form>\n";
        echo "</body></html>\n";
    }

}
