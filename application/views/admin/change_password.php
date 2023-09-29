<?php
include VIEWPATH . 'admin/header.php';
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/change-password'); ?>"><?php echo dt_translate('change_password');?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card mb-3 card">
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12', 'id' => 'change_password_form', 'name' => 'change_password_form', 'method' => "post");
                        echo form_open('admin/update-password-action', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name"><?php echo dt_translate('new_password'); ?><small class="required">*</small></label>
                                    <div>
                                        <input type="password" required  autocomplete="off" value="" class="form-control" id="password" name="password" placeholder="<?php echo dt_translate('new_password'); ?>">
                                        <?php echo form_error('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name"><?php echo dt_translate('confirm_password'); ?><small class="required">*</small></label>
                                    <div>
                                        <input type="password" required autocomplete="off"  value="" class="form-control" id="confirm_password" name="confirm_password" placeholder="<?php echo dt_translate('confirm_password'); ?>">
                                        <?php echo form_error('confirm_password'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
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
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<?php
include VIEWPATH . 'admin/footer.php';
?>

