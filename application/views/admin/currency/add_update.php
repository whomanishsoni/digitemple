<?php
include VIEWPATH . 'admin/header.php';

$id = isset($currency_data['id']) ? $currency_data['id'] : set_value('id');
$title = isset($currency_data['title']) ? escape_data($currency_data['title']) : set_value('title');
$code = isset($currency_data['code']) ? escape_data($currency_data['code']) : set_value('code');
$symbol = isset($currency_data['currency_code']) ? $currency_data['currency_code'] : set_value('currency_code');
$is_default = isset($currency_data['is_default']) ? $currency_data['is_default'] : set_value('is_default');
$stripe_support = isset($currency_data['stripe_support']) ? $currency_data['stripe_support'] : set_value('stripe_support');
$paypal_support = isset($currency_data['paypal_support']) ? $currency_data['paypal_support'] : set_value('paypal_support');

$is_default = (set_value("is_default")) ? set_value("is_default") : (!empty($category_data) ? $currency_data['is_default'] : '');
?>

<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/currency'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('currency') ?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('currency'); ?>
                    </div>
                    <div class="card-body">
                        <?php
                        $attributes = array('id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post");
                        echo form_open_multipart('admin/save-currency', $attributes);
                        ?>
                        <input type="hidden" name="id" id="id" value="<?php echo isset($currency_data['id']) ? $currency_data['id'] : 0; ?>"/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo form_label(dt_translate('title') . '<small class ="required">*</small>', 'title', array('class' => 'control-label')); ?>
                                    <?php echo form_input(array('id' => 'title','required'=>true,'autocomplete' => 'off', 'class' => 'form-control', 'name' => 'title', 'value' => $title, 'placeholder' => dt_translate('title'))); ?>
                                    <?php echo form_error('title'); ?>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo form_label(dt_translate('currency')." ".dt_translate('code') . '<small class ="required">*</small>', 'code', array('class' => 'control-label')); ?>
                                    <?php echo form_input(array('id' => 'code','required'=>true,'autocomplete' => 'off', 'class' => 'form-control', 'name' => 'code', 'value' => $code, 'placeholder' => dt_translate('code'))); ?>
                                    <?php echo form_error('code'); ?>
                                    <small>Example : (USD, INR) </small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo form_label('Currency Symbol' . '<small class ="required">*</small>', 'currency_code', array('class' => 'control-label')); ?>
                                    <?php echo form_input(array('id' => 'currency_code','required'=>true,'autocomplete' => 'off', 'class' => 'form-control', 'name' => 'currency_code', 'value' => $symbol, 'placeholder' => 'Currency Code')); ?>
                                    <?php echo form_error('currency_code'); ?>
                                    <small>Example : ($, ₹) </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 b-r">
                                <div class="form-group">
                                    <a href="<?php echo base_url('admin/currency'); ?>" class="btn btn-warning waves-effect mt-4"><?php echo dt_translate('cancel'); ?></a>
                                    <button type="submit" class="btn btn-primary waves-effect mt-4">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <?php echo dt_translate('submit'); ?>
                                    </button>
                                </div>
                            </div>
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