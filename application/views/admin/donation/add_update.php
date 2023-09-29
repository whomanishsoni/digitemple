<?php
include VIEWPATH . 'admin/header.php';

$first_name = isset($donation_data['first_name']) ? escape_data($donation_data['first_name']) : set_value('first_name');
$last_name = isset($donation_data['last_name']) ? escape_data($donation_data['last_name']) : set_value('last_name');
$city = isset($donation_data['city']) ? escape_data($donation_data['city']) : set_value('city');
$amount = isset($donation_data['amount']) ? $donation_data['amount'] : set_value('amount');
$email = isset($donation_data['email']) ? escape_data($donation_data['email']) : set_value('email');
$phone = isset($donation_data['phone']) ? escape_data($donation_data['phone']) : set_value('phone');
$category_id = isset($donation_data['category_id']) ? $donation_data['category_id'] : set_value('category_id');
$account_id = isset($donation_data['account_id']) ? $donation_data['account_id'] : set_value('account_id');
$type = isset($donation_data['type']) ? $donation_data['type'] : set_value('type');
$id = isset($donation_data['id']) ? (int) $donation_data['id'] : (int) set_value('id');
$cheque_no = isset($donation_data['cheque_no']) ? (int) $donation_data['cheque_no'] : (int) set_value('cheque_no');
$details = isset($donation_data['details']) ? escape_data($donation_data['details']) : set_value('details');
$date = isset($donation_data['date']) ? $donation_data['date'] : set_value('date',date("Y-m-d"));
$ref_no = isset($donation_data['ref_no']) ? escape_data($donation_data['ref_no']) : set_value('ref_no');
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/donation'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('donation') ?></a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('donation'); ?>
                    </div>
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post");
                        echo form_open('admin/save-donation', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <input type="hidden" name="donator_id" value="<?php echo isset($donation_data['user_id']) ? $donation_data['user_id'] : 0; ?>"/>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('first_name') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="text" autofocus tabindex="1" required="" autocomplete="off" value="<?php echo isset($first_name) ? $first_name : ""; ?>" class="form-control" id="first_name" name="first_name" placeholder="<?php echo dt_translate('first_name') ?>">
                                        <?php echo form_error('first_name'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('last_name') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="text" tabindex="2" required="" autocomplete="off" value="<?php echo isset($last_name) ? $last_name : ""; ?>" class="form-control" id="last_name" name="last_name" placeholder="<?php echo dt_translate('last_name') ?>">
                                        <?php echo form_error('last_name'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('city') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="text" tabindex="4" required="" autocomplete="off" value="<?php echo isset($city) ? $city : ""; ?>" class="form-control" id="city" name="city" placeholder="<?php echo dt_translate('city') ?>">
                                        <?php echo form_error('city'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('phone') ?></label>
                                    <div>
                                        <input type="text" tabindex="5" maxlength="10" minlength="10"  autocomplete="off" value="<?php echo isset($phone) ? $phone : ""; ?>" class="form-control" id="phone" name="phone" placeholder="<?php echo dt_translate('phone') ?>">
                                        <?php echo form_error('phone'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('department') ?><small class="required">*</small></label>
                                    <div>
                                        <select tabindex="6" required="" id="category_id" name="category_id" class="form-control">
                                            <option value=""><?php echo dt_translate('select')." ".dt_translate('department'); ?></option>
                                            <?php foreach ($app_donation_category as $value): ?>
                                                <option value="<?php echo $value['id']; ?>"  <?php echo ($value['id']==$category_id)?"selected='selected'" :"";?> ><?php echo $value['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('category_id'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="account_id"><?php echo dt_translate('Account') ?><small class="required">*</small></label>
                                    <div>
                                        <select tabindex="6" required="" id="account_id" name="account_id" class="form-control">
                                            <option value=""><?php echo dt_translate('select')." ".dt_translate('account'); ?></option>
                                            <?php foreach ($accounts as $value): ?>
                                                <option value="<?php echo $value['id']; ?>"  <?php echo ($value['id']==$account_id)?"selected='selected'" :"";?> ><?php echo $value['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('account_id'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('amount') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="number" min="1" tabindex="7" required="" autocomplete="off" value="<?php echo isset($amount) ? $amount : ""; ?>" class="form-control" id="amount" name="amount" placeholder="<?php echo dt_translate('amount') ?>">
                                        <?php echo form_error('amount'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type">Amount Type</label>
                                    <div>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value=""></option>
                                            <option value="CASH" <?php if($type == "CASH") {echo "selected";} ?>  >CASH</option>
                                            <option value="CHEQUE" <?php if($type == "CHEQUE") {echo "selected";} ?> >CHEQUE</option>
                                            <option value="ONLINE" <?php if($type == "ONLINE") {echo "selected";} ?> >ONLINE</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3 <?php echo ($type!="CQ")?'d-none':''; ?>" id="cheq_div">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('cheque')." ".dt_translate('number'); ?><small class="required">*</small></label>
                                    <div>
                                        <input type="number" minlength="4" tabindex="8"  autocomplete="off" value="<?php echo isset($cheque_no) ? $cheque_no : ""; ?>" class="form-control" id="cheque_no" name="cheque_no" placeholder="<?php echo dt_translate('cheque')." ".dt_translate('number') ?>">
                                        <?php echo form_error('cheque_no'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Ref No / Receipt No</label>
                                    <div>
                                        <input type="text" name="ref_no" class="form-control" value="<?php echo $ref_no;?>" placeholder="<?php echo dt_translate('ref_no');?>">
                                        <?php echo form_error('ref_no'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <div>
                                        <input type="text" name="date" class="form-control datepicker" value="<?php echo $date; ?>" placeholder="<?php echo dt_translate('select_date');?>">
                                        <?php echo form_error('date'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('details') ?><small class="required">*</small></label>
                                    <div>
                                        <textarea class="form-control" placeholder="<?php echo dt_translate('details') ?>" id="details" name="details"><?php echo $details; ?></textarea>
                                        <?php echo form_error('details'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a tabindex="10" href="<?php echo base_url('admin/donation'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                                    <button tabindex="9" type="submit" class="btn btn-primary" name="Save" value="Save">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <?php echo dt_translate('save') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>

