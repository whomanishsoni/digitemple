<?php
include VIEWPATH . 'front/theme1/header.php';
//Banner Content
$get_current_currency = dt_get_current_currency();
$app_site_setting=dt_app_site_setting();

$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('causes_background');
$banner_image_path = base_url() . img_path . "/causes.jpg";

if (isset($banner_content) && $banner_content!= "") {
    if (file_exists(FCPATH .uploads_path.'/'.$banner_content)) {
        $banner_image_path = base_url() . uploads_path . '/' .$banner_content;
    }
}
?>
<?php if(isset($is_breadcrumb_enabled) && $is_breadcrumb_enabled=="N"): ?>
    <div class="hero-wrap" style="background-image: url('<?php echo $banner_image_path; ?>');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-12 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><a href="<?php echo base_url('causes'); ?>"><?php echo dt_translate('causes') ?></a></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $app_causes['title']; ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('causes'); ?>"><?php echo dt_translate('causes') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo escape_data($app_causes['title']); ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>
<input type="hidden" id="get_current_currency_hidden" value="<?php echo $get_current_currency['code']; ?>" />
<input type="hidden" id="get_stripepublish" value="<?php echo dt_get_Stripepublish(); ?>" />
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <?php $this->load->view('message'); ?>
            <div class="row">

                <div class="col-md-8 ftco-animate">
                    <h2 class="mb-3"><?php echo escape_data($app_causes['title']); ?></h2>
                    <p><?php echo $app_causes['description']; ?></p>

                    <div class="commentbox"></div>

                </div>
                <!-- .col-md-8 -->

                <div class="col-md-4 sidebar ftco-animate">
                    <div class="sidebar-box ftco-animate card">
                        <?php
                        $attributes = array('id' => 'donationForm', 'name' => 'donationForm', 'method' => "post");
                        echo form_open_multipart('save-cause-donation', $attributes);
                        $raised_per=($app_causes['received_amount']/($app_causes['target_amount']))*100;
                        ?>
                        <input name="cause_id" value="<?php echo $app_causes['id']; ?>" type="hidden" />
                        <input name="cause_title" value="<?php echo $app_causes['title']; ?>" type="hidden" />
                        <h3><?php echo dt_translate('donate_now'); ?></h3>
                        <div class="progress custom-progress-success">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $raised_per; ?>%" aria-valuenow="<?php echo $raised_per; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="fund-raised d-block"><?php echo dt_price_format($app_causes['received_amount']); ?> <?php echo dt_translate('raised_of');?> <?php echo dt_price_format($app_causes['target_amount']); ?></span>
                        <br/>
                        <div class="form-group">
                            <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="text" name="first_name" id="first_name" placeholder="<?php echo dt_translate('first_name') ?>" required>
                        </div>

                        <div class="form-group">
                            <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="text" name="last_name" id="last_name" placeholder="<?php echo dt_translate('last_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" data-msg-email="<?php echo dt_translate('enter_valid_email'); ?>"  class="form-control" type="email" name="email" id="email" placeholder="<?php echo dt_translate('email') ?>" required>
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" maxlength="14" type="number"  id="phone" name="phone" placeholder="<?php echo dt_translate('phone') ?>" required>
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="text" maxlength="50" id="city" name="city" placeholder="<?php echo dt_translate('city') ?>" required>
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="number" min="1" id="amount" name="amount" placeholder="<?php echo dt_translate('amount')." (".$get_current_currency['currency_code'].")"; ?>" required>
                        </div>
                        <div class="form-group" id="emotion">
                            <?php if (dt_check_payment_method('paypal')): ?>
                                <input checked type="radio" name="payment_by" id="happy" value="P" />
                                <label for="happy"><img class="width_100px" src="<?php echo base_url('assets/images/paypal.png') ?>" alt="PayPal" /></label>
                            <?php endif; ?>

                            <?php if (dt_check_payment_method('stripe')): ?>
                                <input checked type="radio" name="payment_by" id="stripe_in" value="S" />
                                <label for="stripe_in"><img class="width_100px" src="<?php echo base_url('assets/images/stripe.png') ?>" alt="Stripe" /></label>
                            <?php endif; ?>
                            <?php if (dt_check_payment_method('razorpay')): ?>
                                <input checked type="radio" name="payment_by" id="razorpay_in" value="R" />
                                <label for="razorpay_in"><img class="width_100px" src="<?php echo base_url('assets/images/razorpay.png') ?>" alt="razorpay" /></label>
                            <?php endif; ?>
                        </div>
                        <div class="form-button">
                            <button  type="button" onclick="submit_donation_form()" class="btn btn-primary"><?php echo dt_translate('donate_now') ?></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- .section -->
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>
<?php
include VIEWPATH . 'validation_js_message.php';
?>
<?php if (dt_check_payment_method('stripe')) { ?>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="<?php echo base_url('assets/global/js/stripe_custom.js'); ?>"></script>
<?php } ?>
<script src="<?php echo base_url('assets/global/js/front_custom.js'); ?>"></script>
