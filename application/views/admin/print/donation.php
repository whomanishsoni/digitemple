<?php
$app_site_setting=dt_app_site_setting();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print</title>
   <link href="<?php echo base_url('assets/global/css/print.css'); ?>"  rel="stylesheet"/>
</head>
<body onload="window.print()" onfocus="window.close()">
<div class="invoice-box print">
    <table cellpadding="0" cellspacing="0" >
        <tr class="top">
            <td colspan="5">
                <table class="border_bottom_3">
                    <tr  class="text_align_center">
                        <td class="print_company_name">
                            <?php echo $app_site_setting['company_name'];?> <br>
                        </td>
                    </tr>
                    <?php if (isset($app_site_setting['company_address']) && $app_site_setting['company_address']!=""): ?>
                        <tr class="text_align_center">
                            <td class="padding_bottom_0">
                                <?php echo $app_site_setting['company_address']; ?>
                            </td>
                        </tr>
                    <?php endif; ?>


                    <tr class="text_align_center">
                        <td>
                            <?php if (isset($app_site_setting['company_email']) && $app_site_setting['company_email']!=""): ?>
                                <?php echo dt_translate('email'); ?> : <?php echo $app_site_setting['company_email'];?> |
                            <?php endif; ?>

                            <?php if (isset($app_site_setting['company_phone']) && $app_site_setting['company_phone']!=""): ?>
                                <?php echo dt_translate('phone'); ?> : <?php echo $app_site_setting['company_phone'];?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="5">
                <table>
                    <tr>
                        <td>
                            <b><?php echo dt_translate('from_date'); ?></b> : <?php echo isset($start_date)?$start_date:""; ?><br/> <b><?php echo dt_translate('to_date'); ?></b> : <?php echo isset($to_date)?$to_date:""; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td width="100"> # </td>
            <td><?php echo dt_translate('name'); ?></td>
            <td><?php echo dt_translate('category'); ?></td>
            <td><?php echo dt_translate('date'); ?></td>
            <td width="150"><?php echo dt_translate('amount'); ?></td>
        </tr>

        <?php if (isset($donation_data) && count($donation_data)>0): ?>
            <?php
            $i=1;
            $total_amount=0;
            foreach ($donation_data as $val): ?>
                <tr class="item">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $val['first_name']." ".$val['last_name']; ?></td>
                    <td><?php echo $val['title']; ?></td>
                    <td><?php echo get_formated_date($val['created_on']); ?></td>
                    <td><?php echo dt_price_format($val['amount']); ?></td>
                </tr>
            <?php
                $total_amount=$total_amount+$val['amount'];
                $i++; endforeach;
            ?>
        <?php endif;?>

        <tr class="item">
            <td colspan="3"></td>
            <td class="text_align_right"><?php echo dt_translate('total'); ?> :</td>
            <td><?php echo dt_price_format($total_amount); ?></td>
        </tr>
    </table>
    <br/>
    <table class="margin_top_50">
        <tr>
            <td class="head_accountant"></td>
            <td class="head_accountant"></td>
            <td class="head_accountant"><?php echo dt_translate('head_accountant'); ?></td>
        </tr>
    </table>
</div>
</body>
</html>