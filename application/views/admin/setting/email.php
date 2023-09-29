<?php
include VIEWPATH . 'admin/header.php';
$smtp_host = isset($email_data->smtp_host) ? $email_data->smtp_host : set_value('smtp_host');
$smtp_username = isset($email_data->smtp_username) ? $email_data->smtp_username : set_value('smtp_username');
$smtp_password = isset($email_data->smtp_password) ? $email_data->smtp_password : set_value('smtp_password');
$smtp_port = isset($email_data->smtp_port) ? $email_data->smtp_port : set_value('smtp_port');
$smtp_secure = isset($email_data->smtp_secure) ? $email_data->smtp_secure : set_value('smtp_secure');
$email_from = isset($email_data->email_from) ? $email_data->email_from : set_value('email_from');
$mail_type = isset($email_data->mail_type) ? $email_data->mail_type : set_value('mail_type');
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/email-setting'); ?>"><?php echo dt_translate('email_setting'); ?></a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <?php include VIEWPATH . 'admin/setting/nav.php';?>

                    <div class="card">
                        <div class="card-header">
                            <?php echo dt_translate('email_setting'); ?>
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <?php echo form_open('admin/save-email-setting', array('name' => 'site_email_form', 'id' => 'site_email_form')); ?>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group form-inline">
                                        <?php
                                        $smtp = $php_mailer = '';
                                        $display_block_php = $display_smtp = "d-none";
                                        if (isset($mail_type) && $mail_type == "P") {
                                            $php_mailer = "checked";
                                            $display_block_php = 'd-block';
                                        } else {
                                            $display_smtp = 'd-block';
                                            $smtp = "checked";
                                        }
                                        ?>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" name='mail_type' value="P" type='radio' onclick="change_php()" id='active' <?php echo $php_mailer; ?>>
                                            <label class="custom-control-label"  for="active">PHP Mailer</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" name='mail_type' type='radio' onclick="change_smtp()" value='S' id='inactive'  <?php echo $smtp; ?>>
                                            <label class="custom-control-label"  for='inactive'>SMTP</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="php_block" class="<?php echo $display_block_php; ?>">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <?php echo form_label('From email<small class ="required">*</small>', 'email_from', array('class' => 'control-label')); ?>
                                            <?php echo form_input(array('autocomplete' => 'off', 'type' => 'text', 'id' => 'email_from', 'class' => 'form-control', "required" => true, 'name' => 'email_from', 'value' => $email_from, 'placeholder' => 'From email')); ?>
                                            <?php echo form_error('email_from'); ?>
                                        </div>
                                        <div class="error" id="smtp_host_validate"></div>
                                    </div>
                                </div>
                            </div>


                            <!---- -->
                            <div id="smtp_block" class="<?php echo $display_smtp; ?>">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('smtp_host') . '<small class ="required">*</small>', 'smtp_host', array('class' => 'control-label')); ?>
                                            <?php echo form_input(array('autocomplete' => 'off', 'id' => 'smtp_host', 'class' => 'form-control', 'name' => 'smtp_host', 'value' => $smtp_host, 'placeholder' => dt_translate('smtp_host'))); ?>
                                            <?php echo form_error('smtp_host'); ?>
                                        </div>
                                        <div class="error" id="smtp_host_validate"></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('username') . '<small class ="required">*</small>', 'smtp_username', array('class' => 'control-label')); ?>
                                            <?php echo form_input(array('autocomplete' => 'off', 'id' => 'smtp_username', 'class' => 'form-control', 'name' => 'smtp_username', 'value' => $smtp_username, 'placeholder' => dt_translate('username'))); ?>
                                            <?php echo form_error('smtp_username'); ?>
                                        </div>
                                        <div class="error" id="smtp_username_validate"></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('password') . '<small class ="required">*</small>', 'smtp_password', array('class' => 'control-label')); ?>
                                            <?php echo form_password(array('autocomplete' => 'off', 'id' => 'smtp_password', 'class' => 'form-control', 'name' => 'smtp_password', 'value' => $smtp_password, 'placeholder' => dt_translate('password'))); ?>
                                            <?php echo form_error('smtp_password'); ?>
                                        </div>
                                        <div class="error" id="smtp_password_validate"></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('smtp_secure') . '<small class ="required">*</small>', 'smtp_secure', array('class' => 'control-label')); ?>
                                            <select name="smtp_secure" id="smtp_secure" class="form-control">
                                                <option value="tls" <?php echo isset($smtp_secure) && $smtp_secure == 'tls' ? "selected" : "" ?>>TLS</option>
                                                <option value="ssl" <?php echo isset($smtp_secure) && $smtp_secure == 'ssl' ? "selected" : "" ?>>SSL</option>
                                            </select>
                                            <?php echo form_error('smtp_secure'); ?>
                                        </div>
                                        <div class="error" id="smtp_secure_validate"></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('port') . '<small class ="required">*</small>', 'smtp_port', array('class' => 'control-label')); ?>
                                            <?php echo form_input(array('autocomplete' => 'off', 'id' => 'smtp_port', 'class' => 'form-control', 'type' => 'number', 'name' => 'smtp_port', 'value' => $smtp_port, 'placeholder' => dt_translate('port'))); ?>
                                            <?php echo form_error('smtp_port'); ?>
                                        </div>
                                        <div class="error" id="smtp_port_validate"></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <?php echo form_label('From email<small class ="required">*</small>', 'email_from_smtp', array('class' => 'control-label')); ?>
                                            <?php echo form_input(array('autocomplete' => 'off', 'type' => 'email', 'id' => 'email_from_smtp', 'class' => 'form-control', "required" => true, 'name' => 'email_from_smtp', 'value' => $email_from, 'placeholder' => 'From email')); ?>
                                            <?php echo form_error('email_from_smtp'); ?>
                                        </div>
                                        <div class="error" id="smtp_host_validate"></div>
                                    </div>
                                </div>

                            </div>

                            <br/>
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <div class="form-group">
                                        <a class="btn btn-warning" href="<?php echo base_url('admin/dashboard'); ?>"><?php echo dt_translate('cancel'); ?></a>
                                        <button type="submit" class="btn btn-primary">
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            <?php echo dt_translate('update'); ?></button>
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