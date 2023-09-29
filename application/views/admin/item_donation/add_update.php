<?php
include VIEWPATH . 'admin/header.php';

$first_name = isset($item_donation_data['first_name']) ? escape_data($item_donation_data['first_name']) : set_value('first_name');
$last_name = isset($item_donation_data['last_name']) ? escape_data($item_donation_data['last_name']) : set_value('last_name');
$city = isset($item_donation_data['city']) ? escape_data($item_donation_data['city']) : set_value('city');
$qty = isset($item_donation_data['qty']) ? $item_donation_data['qty'] : set_value('qty');
$email = isset($item_donation_data['email']) ? escape_data($item_donation_data['email']) : set_value('email');
$phone = isset($item_donation_data['phone']) ? escape_data($item_donation_data['phone']) : set_value('phone');
$item_id = isset($item_donation_data['item_id']) ? $item_donation_data['item_id'] : set_value('item_id');
$status = isset($item_donation_data['status']) ? $item_donation_data['status'] : "NR";
$id = isset($item_donation_data['id']) ? (int) $item_donation_data['id'] : (int) set_value('id');

?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/item-donation'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('item'). " " . dt_translate('donation'); ?></a></li>
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
                        echo form_open('admin/save-item-donation', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>

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
                                    <label for="title"><?php echo dt_translate('email') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="email" tabindex="3" required="" autocomplete="off" value="<?php echo isset($email) ? $email : ""; ?>" class="form-control" id="email" name="email" placeholder="<?php echo dt_translate('email') ?>">
                                        <?php echo form_error('email'); ?>
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

                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('phone') ?></label>
                                    <div>
                                        <input type="text" tabindex="5" maxlength="10" minlength="10"  autocomplete="off" value="<?php echo isset($phone) ? $phone : ""; ?>" class="form-control" id="phone" name="phone" placeholder="<?php echo dt_translate('phone') ?>">
                                        <?php echo form_error('phone'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('item') ?><small class="required">*</small></label>
                                    <div>
                                        <select tabindex="6" required="" id="item_id" name="item_id" class="form-control">
                                            <option value=""><?php echo dt_translate('select')." ".dt_translate('item'); ?></option>
                                            <?php foreach ($app_item as $value): ?>
                                                <option value="<?php echo $value['id']; ?>"  <?php echo ($value['id']==$item_id)?"selected='selected'" :"";?> ><?php echo $value['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('item_id'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('qty') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="number" min="1" tabindex="7" required="" autocomplete="off" value="<?php echo isset($qty) ? $qty : ""; ?>" class="form-control" id="qty" name="qty" placeholder="<?php echo dt_translate('qty') ?>">
                                        <?php echo form_error('qty'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php
                                    $received=$not_received="";

                                    if($status=='R'){
                                        $received="checked";
                                    }else{
                                        $not_received="checked";
                                    }
                                    ?>
                                    <label><?php echo dt_translate('status') ?></label>
                                    <br/>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" <?php echo ($status=="R")?"checked":""; ?> type="radio" id="received"  class="form-check-input" value="R" name="status">
                                        <label class="custom-control-label"  for='received'><?php echo dt_translate('received'); ?></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" <?php echo ($status=="NR")?"checked":""; ?> type="radio" id="not_received"  class="form-check-input" value="NR" name="status">
                                        <label class="custom-control-label"  for='not_received'><?php echo dt_translate('not_received'); ?></label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a tabindex="10" href="<?php echo base_url('admin/item-donation'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
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

