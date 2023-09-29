<?php
include VIEWPATH . 'front/theme1/header.php';
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
<div class="container padding_top_7">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb_background">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('donate') ?></li>
        </ol>
    </nav>
</div>
<section class="ftco-section" id="asdn">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex ftco-animate">
                <div class="img img-about align-self-stretch width_100pr" style="background-image: url(<?php echo $banner_image_path; ?>);"></div>
            </div>
            <div class="col-md-6 pl-md-5 ftco-animate">
                <?php if(dt_check_payment_method('paypal')==false && dt_check_payment_method('stripe')==false) :?>
                    <div class="form-content">
                        <div class="col-md-10 text-left">
                            <?php $this->load->view('message'); ?>
                            <div>
                                <h3><?php echo dt_translate('slogan_one') ?></h3>
                                <p class="mt-5 mb-5"><?php echo dt_translate('currently_not_available'); ?></p>
                            </div>
                            <hr/>
                            <p class="text-center mb-0 mt-1">&copy; <?php echo date('Y')." ".dt_get_CompanyName(). ". ".dt_translate('rights_reserved_message'); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="form-content">
                        <div class="col-md-12 text-left">
                            <?php $this->load->view('message'); ?>
                            <h3><?php echo dt_translate('slogan_one') ?></h3>

                            <p><?php echo dt_translate('slogan_two') ?></p>
                            <br/>
                            <?php
                            $attributes = array('id' => 'donationForm', 'name' => 'donationForm', 'method' => "post");
                            echo form_open('donate-action', $attributes);
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="text" name="first_name" id="first_name" placeholder="<?php echo dt_translate('first_name') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="text" name="last_name" id="last_name" placeholder="<?php echo dt_translate('last_name') ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" data-msg-email="<?php echo dt_translate('enter_valid_email'); ?>"  class="form-control" type="email" name="email" id="email" placeholder="<?php echo dt_translate('email') ?>" required>
                                     </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" maxlength="14" type="number"  id="phone" name="phone" placeholder="<?php echo dt_translate('phone') ?>" required>
                                     </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="text" maxlength="50" id="city" name="city" placeholder="<?php echo dt_translate('city') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="input-symbol-euro">
                                             <input autocomplete="off" data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" class="form-control" type="number" min="1" id="amount" name="amount" placeholder="<?php echo dt_translate('amount')." (".$get_current_currency['currency_code'].")"; ?>" required>
                                        </span>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label><?php echo dt_translate('donation_towards'); ?></label>
                                    <select data-msg-required="<?php echo dt_translate('this_field_is_required'); ?>" required class="form-control" id="category_id" name="category_id">
                                        <option value=""><?php echo dt_translate('select'); ?></option>
                                        <?php foreach ($app_donation_category as $val): ?>
                                            <option value="<?php echo $val['id']; ?>"><?php echo $val['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div id="emotion">
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
                                <button  type="button" onclick="submit_donation_form()" class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <?php echo dt_translate('donate_now') ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
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