<?php
include VIEWPATH . 'front/'.$this->theme.'/header.php';
$get_current_currency = dt_get_current_currency();
$app_site_setting=dt_app_site_setting();


$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('donation_background');
$banner_image_path = base_url() . img_path . "/donation.jpg";

if (isset($banner_content) && $banner_content!= "") {
    if (file_exists(FCPATH .uploads_path.'/'.$banner_content)) {
        $banner_image_path = base_url() . uploads_path . '/' .$banner_content;
    }
}
?>
<input type="hidden" id="get_current_currency_hidden" value="<?php echo $get_current_currency['code']; ?>" />
<input type="hidden" id="get_stripepublish" value="<?php echo dt_get_Stripepublish(); ?>" />

<section class="donate-area ptb-100 ">
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 text-center">
                <img class="thank_you_image" src="<?php echo base_url('assets/img/correct.png'); ?>"/>
                <h2 class="p-2 text-success"><?php echo dt_translate('transaction_successful') ?></h2>
            </div>
        </div>
        <div class="row justify-content-md-center fadeInUp animated">
            <div class="col-lg-6">
                <div class="donates-wraps">
                    <div class="contact-form">

                            <div class="form-content">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tr>
                                            <td class="border-top-0"><?php echo dt_translate('transaction_number'); ?></td>
                                            <td class="border-top-0"><?php echo $app_donation['transaction_id']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="border-top-0"><?php echo dt_translate('name'); ?></td>
                                            <td class="border-top-0"><?php echo $app_donation['first_name']." ".$app_donation['last_name']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="border-top-0"><?php echo dt_translate('amount'); ?></td>
                                            <td class="border-top-0"><?php echo dt_price_format($app_donation['amount']); ?></td>
                                        </tr>

                                        <tr>
                                            <td class="border-top-0"><?php echo dt_translate('email'); ?></td>
                                            <td class="border-top-0"><?php echo $app_donation['email']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="border-top-0"><?php echo dt_translate('date'); ?></td>
                                            <td class="border-top-0"><?php echo date('d-M-Y H:i',strtotime($app_donation['created_on'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-top-1 text-center">
                                                <p class="text-left"><b><?php echo dt_translate('note'); ?> : </b><?php echo dt_translate('donation_certy_note'); ?></p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2" class="border-top-1 text-center"><a href="<?php echo base_url('assets/uploads/'.$app_donation['certificate_file']); ?>" download="" class="btn btn-success text-white p-3"><?php echo dt_translate('Download_Donation_Certificate'); ?></a></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include VIEWPATH . 'front/'.$this->theme.'/footer.php';
?>
