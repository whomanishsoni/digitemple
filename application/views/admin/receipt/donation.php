<?php
$site_setting=dt_app_site_setting();
//echo "<pre>";
//print_r($donation_data);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Print</title>
    <link href="<?php echo base_url('assets/admin/css/receipt.css'); ?>" rel="stylesheet">
</head>
<body>
<body onload="window.print()" onfocus="window.close()">
<div class="body">
    <div class="header">
        <table id="header_details">
            <tr>
                <td style="text-align: left">
                    <img width="250" src="<?php echo dt_get_CompanyLogo(); ?>"/>
                </td>
                <td>
                    <h3 class="no-margin"><?php echo isset($site_setting['company_name'])?$site_setting['company_name']:""; ?></h3>

                    <?php if(isset($site_setting['trust_registration_no']) && $site_setting['trust_registration_no']!=""): ?>
                    <h4 class="no-margin"><?php echo dt_translate('reg_no'); ?>: <?php echo isset($site_setting['trust_registration_no'])?$site_setting['trust_registration_no']:""; ?></h4>
                    <?php endif; ?>

                    <?php if(isset($site_setting['company_address']) && $site_setting['company_address']!=""): ?>
                        <h5 class="no-margin"><?php echo isset($site_setting['company_address'])?$site_setting['company_address']:""; ?></h5>
                    <?php endif; ?>

                    <?php if(isset($site_setting['company_phone']) && $site_setting['company_phone']!=""): ?>
                        <h5 class="no-margin"><?php echo dt_translate('phone'); ?>: <?php echo isset($site_setting['company_phone'])?$site_setting['company_phone']:""; ?></h5>
                    <?php endif;?>

                    <?php if(isset($site_setting['company_email']) && $site_setting['company_email']!=""): ?>
                        <h5 class="no-margin"><?php echo dt_translate('email'); ?>: <?php echo isset($site_setting['company_email'])?$site_setting['company_email']:""; ?></h5>
                    <?php endif; ?>
                </td>
                <td style="text-align: right">
                    <h4 class="no-margin"><?php echo dt_translate('receipt_no'); ?> : <?php echo $donation_data['id']; ?></h4>
                    <h4 class="no-margin"><?php echo dt_translate('date'); ?>. : <?php echo get_formated_date($donation_data['created_on']); ?></h4>
                </td>
            </tr>
        </table>
        <hr/>
    </div>
    <br/>
    <div class="content">
        <div class="fees-content">
            <p style="margin-bottom: 0px;" class="amount"><?php echo dt_translate('donation_receipt_message_one'); ?></p>
            <p style="margin-bottom: 0px;" class="amount"><?php echo dt_translate('donation_receipt_message_two'); ?></p>
            <p style="margin-bottom: 0px;" class="amount"><?php echo dt_translate('donation_receipt_message_three'); ?></p>
        </div>
        <br/>
        <table>
            <tr>
                <td width="60"><b><?php echo dt_translate('name'); ?></b></td>
                <td><p style="border-bottom: 1px solid #000;margin: 0px;"><?php echo $donation_data['first_name']." ".$donation_data['last_name']; ?></p></td>
            </tr>
            <tr>
                <td width="60"><b><?php echo dt_translate('email'); ?></b></td>
                <td><p style="border-bottom: 1px solid #000;margin: 0px;"><?php echo $donation_data['email']; ?></p></td>
            </tr>
            <tr>
                <td width="60"><b><?php echo dt_translate('phone'); ?></b></td>
                <td><p style="border-bottom: 1px solid #000;margin: 0px;"><?php echo $donation_data['phone']; ?></p></td>
            </tr>
        </table>
        <table id="footer_table">
            <tr>
                <td style="text-align: left">
                    <p class="receipt_user_amount">
                        <?php echo dt_price_format($donation_data['amount']); ?>
                    </p>
                    <?php
                    if($donation_data['type']=="CA"){
                        echo dt_translate('cash');
                    }elseif ($donation_data['type']=="CQ"){
                        echo dt_translate('cheque');
                    }elseif ($donation_data['type']=="P"){
                        echo "PayPal";
                    }elseif ($donation_data['type']=="S"){
                        echo "Stripe";
                    }elseif ($donation_data['type']=="R"){
                        echo "Razorpay";
                    }
                    ?>
                </td>

                <td style="text-align: center">

                </td>
                <td style="text-align: right">
                    <div class="signarea">
                        <p style="border-bottom:2px solid #e2e3e5;padding: 1em;"><b><?php echo dt_translate('received_by'); ?></b>: <?php echo $donation_data['created_first_name']." ".$donation_data['created_last_name'] ?></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>