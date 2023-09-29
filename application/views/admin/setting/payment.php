<?php
include VIEWPATH . 'admin/header.php';

$stripe = (set_value("stripe")) ? set_value("stripe") : (!empty($payment_data) ? $payment_data['stripe'] : 'N');
$paypal = (set_value("paypal")) ? set_value("paypal") : (!empty($payment_data) ? $payment_data['paypal'] : 'N');
$on_cash = (set_value("on_cash")) ? set_value("on_cash") : (!empty($payment_data) ? $payment_data['on_cash'] : 'N');
$stripe_secret = (set_value("stripe_secret")) ? set_value("stripe_secret") : (!empty($payment_data) ? $payment_data['stripe_secret'] : '');
$stripe_publish = (set_value("stripe_publish")) ? set_value("stripe_publish") : (!empty($payment_data) ? $payment_data['stripe_publish'] : '');
$paypal_merchant_email = (set_value("paypal_merchant_email")) ? set_value("paypal_merchant_email") : (!empty($payment_data) ? $payment_data['paypal_merchant_email'] : '');
$paypal_sendbox_live = (set_value("paypal_sendbox_live")) ? set_value("paypal_sendbox_live") : (!empty($payment_data) ? $payment_data['paypal_sendbox_live'] : '');

$razorpay = (set_value("razorpay")) ? set_value("razorpay") : (!empty($payment_data) ? $payment_data['razorpay'] : 'N');
$razorpay_merchant_key_id = (set_value("razorpay_merchant_key_id")) ? set_value("razorpay_merchant_key_id") : (!empty($payment_data) ? $payment_data['razorpay_merchant_key_id'] : '');
$razorpay_merchant_key_secret = (set_value("razorpay_merchant_key_secret")) ? set_value("razorpay_merchant_key_secret") : (!empty($payment_data) ? $payment_data['razorpay_merchant_key_secret'] : '');

$id = !empty($payment_data) ? $payment_data['id'] : 0;

$stripe_yes = $stripe_no = "";

if ($stripe == 'Y') {
    $stripe_yes = 'checked';
} else {
    $stripe_no = 'checked';
}

$paypal_yes = $paypal_no = "";
if ($paypal == 'Y') {
    $paypal_yes = 'checked';
} else {
    $paypal_no = 'checked';
}

$razorpay_yes = $razorpay_no = "";

if ($razorpay == 'Y') {
    $razorpay_yes = 'checked';
} else {
    $razorpay_no = 'checked';
}

$on_cash_yes = $on_cash_no = "";
if ($on_cash == 'Y') {
    $on_cash_yes = 'checked';
} else {
    $on_cash_no = 'checked';
}
?>
<input type="hidden" id="stripe_hidden_id" value="<?php echo $stripe; ?>" />
<input type="hidden" id="paypal_hidden_id" value="<?php echo $paypal; ?>" />
<input type="hidden" id="razorpay_hidden_id" value="<?php echo $razorpay; ?>" />


<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/payment-setting'); ?>"><?php echo dt_translate('payment_setting');?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                <?php include VIEWPATH . 'admin/setting/nav.php';?>
                <div class="card">
                    <div class="card-header">
                        <?php echo dt_translate('payment_setting'); ?>
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <?php
                        echo form_open('admin/save-payment-setting', array('name' => 'PaymentForm', 'id' => 'PaymentForm'));
                        echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => $id));
                        ?>
                        <label class="form-label"><?php echo dt_translate('stripe'); ?></label>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" name='stripe' value="Y" type='radio' id='stripe_yes'   <?php echo isset($stripe_yes) ? $stripe_yes : ''; ?> onchange="check_stripe_val(this.value);">
                            <label class="custom-control-label"  for="stripe_yes"><?php echo dt_translate('yes'); ?></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" name='stripe' type='radio'  value='N' id='stripe_no'  <?php echo isset($stripe_no) ? $stripe_no : ''; ?> onchange="check_stripe_val(this.value);">
                            <label class="custom-control-label"  for='stripe_no'><?php echo dt_translate('no'); ?></label>
                        </div>

                        <div class="form-group stripe-html d-none  mt-3">
                            <label for="stripe_secret"> <?php echo dt_translate('stripe_secret_key'); ?><small class="required">*</small></label>
                            <input type="text" autocomplete="off" id="stripe_secret" name="stripe_secret" value="<?php echo $stripe_secret; ?>" class="form-control" placeholder="<?php echo dt_translate('stripe_secret_key'); ?>">
                            <?php echo form_error('stripe_secret'); ?>
                        </div>
                        <div class="form-group stripe-html d-none">
                            <label for="stripe_publish"> <?php echo dt_translate('stripe_publish_key'); ?><small class="required">*</small></label>
                            <input type="text" autocomplete="off" id="stripe_publish" name="stripe_publish" value="<?php echo $stripe_publish; ?>" class="form-control" placeholder="<?php echo dt_translate('stripe_publish_key'); ?>">
                            <?php echo form_error('stripe_publish'); ?>
                        </div>
                        <hr/>

                        <label class="form-label"><?php echo dt_translate('paypal'); ?></label>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" name='paypal' value="Y" type='radio' id='paypal_yes'   <?php echo isset($paypal_yes) ? $paypal_yes : ''; ?> onchange="check_paypal_val(this.value);">
                            <label class="custom-control-label"  for="paypal_yes"><?php echo dt_translate('yes'); ?></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" name='paypal' type='radio'  value='N' id='paypal_no'  <?php echo isset($paypal_no) ? $paypal_no : ''; ?> onchange="check_paypal_val(this.value);">
                            <label class="custom-control-label" for='paypal_no'><?php echo dt_translate('no'); ?></label>
                        </div>

                        <div class="palpal-html  mt-3">
                            <div class="form-group">
                                <label for="paypal_sendbox_live"> <?php echo dt_translate('paypal_mode'); ?><small class="required">*</small></label>
                                <select class="form-control" id="paypal_sendbox_live" name="paypal_sendbox_live">
                                    <option <?php echo ($paypal_sendbox_live == 'S') ? "selected='selected'" : ""; ?> value="S"><?php echo dt_translate('paypal_sendbox'); ?></option>
                                    <option <?php echo ($paypal_sendbox_live == 'L') ? "selected='selected'" : ""; ?> value="L"><?php echo dt_translate('paypal_live'); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paypal_merchant_email"> <?php echo dt_translate('paypal_merchant_email'); ?><small class="required">*</small></label>
                                <input type="email" id="paypal_merchant_email" name="paypal_merchant_email" value="<?php echo $paypal_merchant_email; ?>" class="form-control" placeholder="<?php echo dt_translate('paypal_merchant_email'); ?>">
                                <?php echo form_error('paypal_merchant_email'); ?>
                            </div>
                        </div>
                        <hr/>
                        <label class="form-label">Razorpay</label>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" name='razorpay' value="Y" type='radio' id='razorpay_yes'   <?php echo isset($razorpay_yes) ? $razorpay_yes : ''; ?> onchange="check_razorpay_val(this.value);">
                            <label class="custom-control-label" for="razorpay_yes"><?php echo dt_translate('yes'); ?></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" name='razorpay' type='radio'  value='N' id='razorpay_no'  <?php echo isset($razorpay_no) ? $razorpay_no : ''; ?> onchange="check_razorpay_val(this.value);">
                            <label class="custom-control-label" for='razorpay_no'><?php echo dt_translate('no'); ?></label>
                        </div>

                        <div class="form-group razorpay-html d-none mt-3">
                            <label for="stripe_secret">Merchant Key ID<small class="required">*</small></label>
                            <input type="text" autocomplete="off" id="razorpay_merchant_key_id" name="razorpay_merchant_key_id" value="<?php echo $razorpay_merchant_key_id; ?>" class="form-control" placeholder="">
                            <?php echo form_error('stripe_secret'); ?>
                        </div>

                        <div class="form-group razorpay-html d-none">
                            <label for="stripe_publish">Merchant Key Secret<small class="required">*</small></label>
                            <input type="text" autocomplete="off" id="razorpay_merchant_key_secret" name="razorpay_merchant_key_secret" value="<?php echo $razorpay_merchant_key_secret; ?>" class="form-control" placeholder="">
                            <?php echo form_error('razorpay_merchant_key_secret'); ?>
                        </div>

                        <br/>

                        <div class="form-group mt-4">
                            <a class="btn btn-warning" href="<?php echo base_url('admin/dashboard'); ?>"><?php echo dt_translate('cancel'); ?></a>
                            <button type="submit" class="btn btn-primary"><span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <?php echo dt_translate('save'); ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>
<script src="<?php echo base_url('assets/admin/js/payment_setting.js') ?>"></script>