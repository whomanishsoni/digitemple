<?php
$name = isset($account_data['name']) ? $account_data['name'] : set_value('name');
$status = isset($account_data['status']) ? $account_data['status'] : set_value('status');
$id = isset($account_data['id']) ? (int) $account_data['id'] : (int) set_value('id');

include VIEWPATH . 'admin/header.php';

?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/account'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('account') ?></a></li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header">
                <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('account'); ?>
            </div>
            <div class="card-body">
                <?php
                $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Login', 'name' => 'Login', 'method' => "post");
                echo form_open('admin/save-account', $attributes);
                ?>
                <?php $this->load->view('message'); ?>
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><?php echo dt_translate('account_name') ?><small class="required">*</small></label>
                            <div>
                                <input type="text" autofocus tabindex="1" required="true" autocomplete="off" value="<?php echo isset($name) ? $name : ""; ?>" class="form-control" id="name" name="name" placeholder="<?php echo dt_translate('account_name') ?>">
                                <?php echo form_error('name'); ?>
                            </div>
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
                                if ($status) {
                                    $inactive = "checked";
                                } else {
                                    $active = "checked";
                                }
                                ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" name='status' value="1" type='radio' id='active'   <?php echo $active; ?>>
                                    <label class="custom-control-label"  for="active"><?php echo dt_translate('active'); ?></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" name='status' type='radio'  value='0' id='inactive'  <?php echo $inactive; ?>>
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
                            <a href="<?php echo base_url('admin/account'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                            <button type="submit" class="btn btn-primary" >
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
<?php
include VIEWPATH . 'admin/footer.php';
?>