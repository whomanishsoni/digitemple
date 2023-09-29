<?php
$first_name = isset($customer_data['first_name']) ? $customer_data['first_name'] : set_value('first_name');
$last_name = isset($customer_data['last_name']) ? $customer_data['last_name'] : set_value('last_name');
$email = isset($customer_data['email']) ? $customer_data['email'] : set_value('email');
$status = isset($customer_data['status']) ? $customer_data['status'] : 'A';
$phone = isset($customer_data['phone']) ? $customer_data['phone'] : set_value('phone');
$id = isset($customer_data['id']) ? (int) $customer_data['id'] : (int) set_value('id');
$amount = isset($customer_data['amount']) ? $customer_data['amount'] : set_value('amount');
$city = isset($customer_data['city']) ? $customer_data['city'] : set_value('city');
$type = isset($customer_data['type']) ? $customer_data['type'] : set_value('type');

include VIEWPATH . 'admin/header.php';

?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/staff'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('staff') ?></a></li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header">
                <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('staff'); ?>
            </div>
            <div class="card-body">
                <?php
                $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Login', 'name' => 'Login', 'method' => "post");
                echo form_open('admin/save-staff', $attributes);
                ?>
                <?php $this->load->view('message'); ?>
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name"><?php echo dt_translate('first_name') ?><small class="required">*</small></label>
                            <div>
                                <input type="text" autofocus tabindex="1" required="" autocomplete="off" value="<?php echo isset($first_name) ? $first_name : ""; ?>" class="form-control" id="first_name" name="first_name" placeholder="<?php echo dt_translate('first_name') ?>">
                                <?php echo form_error('first_name'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name"><?php echo dt_translate('last_name') ?><small class="required">*</small></label>
                            <div>
                                <input type="text" tabindex="2" required="" autocomplete="off"  value="<?php echo isset($last_name) ? $last_name : ""; ?>" class="form-control" id="last_name" name="last_name" placeholder="<?php echo dt_translate('last_name') ?>">
                                <?php echo form_error('last_name'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone"><?php echo dt_translate('phone') ?><small class="required">*</small></label>
                            <div>
                                <input type="text" tabindex="3"  required="" maxlength="10" autocomplete="off" value="<?php echo isset($phone) ? $phone : ""; ?>"  class="form-control" id="phone" name="phone" placeholder="<?php echo dt_translate('phone') ?>">
                                <?php echo form_error('phone'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city"><?php echo dt_translate('city') ?><small class="required">*</small></label>
                            <div>
                                <input type="text" tabindex="4"  autocomplete="off"  value="<?php echo isset($city) ? $city : ""; ?>" class="form-control" id="city" name="city" placeholder="<?php echo dt_translate('city') ?>">
                                <?php echo form_error('city'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount"><?php echo dt_translate('amount') ?><small class="required">*</small></label>
                            <div>
                                <input type="text" tabindex="3"  required="" maxlength="10" autocomplete="off" value="<?php echo isset($amount) ? $amount : ""; ?>"  class="form-control" id="amount" name="amount" placeholder="<?php echo dt_translate('amount') ?>">
                                <?php echo form_error('amount'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">User Role (If online user)</label>
                            <select name="type" id="type" class="form-control">
                                <option value="C" <?php if($type=="C") { echo "selected"; }?>>Not Online User</option>
                                <option value="A" <?php if($type=="A") { echo "selected"; }?> >Admin</option>
                                <option value="S" <?php if($type=="S") { echo "selected"; }?> >Staff Member</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo dt_translate('status'); ?> <small class="required">*</small></label>
                            <div class="form-inline">
                                <?php
                                $active = $inactive = '';
                                if ($status == "I") {
                                    $inactive = "checked";
                                } else {
                                    $active = "checked";
                                }
                                ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" name='status' value="A" type='radio' id='active'   <?php echo $active; ?>>
                                    <label class="custom-control-label"  for="active"><?php echo dt_translate('active'); ?></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" name='status' type='radio'  value='I' id='inactive'  <?php echo $inactive; ?>>
                                    <label class="custom-control-label"  for='inactive'><?php echo dt_translate('inactive'); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="<?php echo base_url('admin/staff'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                            <button type="submit" class="btn btn-primary" name="signup" value="Sign up">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <?php echo dt_translate('save') ?></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>