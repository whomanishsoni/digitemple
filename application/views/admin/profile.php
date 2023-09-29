<?php
include VIEWPATH . 'admin/header.php';
$first_name = isset($customer_data['first_name']) ? escape_data($customer_data['first_name']) : set_value('first_name');
$last_name = isset($customer_data['last_name']) ? escape_data($customer_data['last_name']) : set_value('last_name');
$email = isset($customer_data['email']) ? escape_data($customer_data['email']) : set_value('email');
$phone = isset($customer_data['phone']) ? escape_data($customer_data['phone']) : set_value('phone');
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/profile'); ?>"><?php echo dt_translate('profile'); ?></a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $attributes = array('class' => 'col-md-12', 'id' => 'Login', 'name' => 'Login', 'method' => "post");
                            echo form_open('admin/profile-save', $attributes);
                            ?>
                            <?php $this->load->view('message'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name"><?php echo dt_translate('first_name') ?><small class="required">*</small></label>
                                        <div>
                                            <input type="text" maxlength="60" required autocomplete="off" value="<?php echo $first_name; ?>" class="form-control" id="first_name" name="first_name" placeholder="<?php echo dt_translate('first_name') ?>">
                                            <?php echo form_error('first_name'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name"><?php echo dt_translate('last_name') ?><small class="required">*</small></label>
                                        <div>
                                            <input type="text" maxlength="60" required autocomplete="off"  value="<?php echo $last_name; ?>" class="form-control" id="last_name" name="last_name" placeholder="<?php echo dt_translate('last_name') ?>">
                                            <?php echo form_error('last_name'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"><?php echo dt_translate('email') ?><small class="required">*</small></label>
                                        <div>
                                            <input type="email" maxlength="100" autocomplete="off" required value="<?php echo $email; ?>" class="form-control" id="email" name="email" placeholder="<?php echo dt_translate('email') ?>">
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"><?php echo dt_translate('phone') ?></label>
                                        <div>
                                            <input type="text" minlength="10"  autocomplete="off" value="<?php echo $phone; ?>" maxlength="10"  class="form-control" id="phone" name="phone" placeholder="<?php echo dt_translate('phone') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

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
<?php
include VIEWPATH . 'admin/footer.php';
?>