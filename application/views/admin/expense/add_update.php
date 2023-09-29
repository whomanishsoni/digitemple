<?php
include VIEWPATH . 'admin/header.php';

$amount = isset($expense_data['amount']) ? $expense_data['amount'] : set_value('amount');
$details = isset($expense_data['details']) ? escape_data($expense_data['details']) : set_value('details');
$category_id = isset($expense_data['category_id']) ? $expense_data['category_id'] : set_value('category_id');
$expense_date = isset($expense_data['expense_date']) ? $expense_data['expense_date'] : set_value('expense_date',date("Y-m-d"));
$account_id = isset($expense_data['account_id']) ? $expense_data['account_id'] : set_value('account_id');
$party_name = isset($expense_data['party_name']) ? $expense_data['party_name'] : set_value('party_name');
$party_phone = isset($expense_data['party_phone']) ? $expense_data['party_phone'] : set_value('party_phone');
$ref_no = isset($expense_data['ref_no']) ? $expense_data['ref_no'] : set_value('ref_no');

$id = isset($expense_data['id']) ? (int) $expense_data['id'] : (int) set_value('id');
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/expense'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('expense') ?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('expense'); ?>
                    </div>
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post", "enctype" => 'multipart/form-data');
                        echo form_open('admin/save-expense', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Party Name</label>
                                    <div>
                                        <input type="text" name="party_name" class="form-control" value="<?php echo $party_name;?>" placeholder="<?php echo dt_translate('party_name');?>">
                                        <?php echo form_error('party_name'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Party Phone</label>
                                    <div>
                                        <input type="text" name="party_phone" class="form-control" value="<?php echo $party_phone;?>" placeholder="<?php echo dt_translate('party_phone');?>">
                                        <?php echo form_error('party_phone'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Ref No / Bill No</label>
                                    <div>
                                        <input type="text" name="ref_no" class="form-control" value="<?php echo $ref_no;?>" placeholder="<?php echo dt_translate('ref_no');?>">
                                        <?php echo form_error('ref_no'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('expense_category') ?><small class="required">*</small></label>
                                    <div>
                                        <select  required="" id="category_id" name="category_id" class="form-control">
                                            <option value=""><?php echo dt_translate('select')." ".dt_translate('expense_category'); ?></option>
                                            <?php foreach ($app_expense_category as $value): ?>
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
                                        <select  required="" id="account_id" name="account_id" class="form-control">
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
                                        <input type="number" min="1"  required="" autocomplete="off" value="<?php echo isset($amount) ? $amount : ""; ?>" class="form-control" id="amount" name="amount" placeholder="<?php echo dt_translate('amount') ?>">
                                        <?php echo form_error('amount'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('date') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="text"  required="" autocomplete="off" value="<?php echo isset($expense_date) ? $expense_date : ""; ?>" class="form-control datepicker" id="expense_date" name="expense_date" placeholder="<?php echo dt_translate('date') ?>">
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
                                        <textarea  required="" class="form-control" placeholder="<?php echo dt_translate('details') ?>" id="details" name="details"><?php echo isset($details) ? $details : ""; ?></textarea>
                                        <?php echo form_error('details'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Select Bill Photo</label>
                                    <div>
                                        <input type="file" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg,image/png">
                                        <?php echo form_error('image'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a  href="<?php echo base_url('admin/expense'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                                    <button  type="submit" class="btn btn-primary" name="Save" value="Save">
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