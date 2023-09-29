<?php
$app_site_setting=dt_app_site_setting();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print</title>
    <link href="<?php echo base_url('assets/global/css/print.css'); ?>"rel="stylesheet" />
</head>

<body onload="window.print()" onfocus="window.close()">
<body>
<div class="invoice-box print">
    <table cellpadding="0" cellspacing="0" >
        <tr class="top">
            <td colspan="4">
                <table class="border_bottom_3">
                    <tr class="text_align_center">
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
            <td colspan="4">
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
            <td><?php echo dt_translate('category'); ?></td>
            <td><?php echo dt_translate('description'); ?></td>
            <td width="150"><?php echo dt_translate('amount'); ?></td>
        </tr>
        <?php if (isset($expense_data) && count($expense_data)>0): ?>
            <?php $i=1;$total_amount=0; foreach ($expense_data as $val): ?>
                <tr class="item">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $val['category_title']; ?></td>
                    <td><?php echo $val['details']; ?></td>
                    <td><?php echo dt_price_format($val['amount']); ?></td>
                </tr>
            <?php
                $total_amount=$total_amount+$val['amount'];
                $i++; endforeach; ?>
        <?php endif;?>
        <tr class="item">
            <td colspan="2"></td>
            <td class="text_align_right"><?php echo dt_translate('total'); ?> :</td>
            <td><?php echo dt_price_format($total_amount); ?></td>
        </tr>
    </table>
    <br/>
    <table id="income_expense">
        <tr class="item">
            <td><?php echo dt_translate('donation'); ?> :</td>
            <td><?php echo isset($donation)?dt_price_format($donation):""; ?></td>
        </tr>
        <tr class="item">
            <td><?php echo dt_translate('expense'); ?> :</td>
            <td><?php echo dt_price_format($total_amount); ?></td>
        </tr>
        <?php
            $total_cash=($donation-$total_amount);
        ?>
        <tr class="item">
            <td><?php echo dt_translate('cash'); ?> :</td>
            <td><?php echo dt_price_format($total_cash); ?></td>
        </tr>
    </table>
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