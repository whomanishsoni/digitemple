<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Language" content="en"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <link rel="icon" type="image/x-icon" href="<?php echo dt_get_fevicon(); ?>"/>
    <title><?php echo dt_translate('reset_password'); ?></title>

    <link href="<?php echo base_url('assets/global/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/global/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/fade-down.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/p-scroll.css');?>" rel="stylesheet" type="text/css">
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets/admin/css/color.css');?>">
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100 bg-plum-plate bg-animation">
            <div class="d-flex h-100 justify-content-center align-items-center">
                <div class="mx-auto app-login-box col-md-8 padding_top_100">
                    <div class="text-center w-100 mx-auto">
                        <a href="<?php echo base_url('admin/login'); ?>">
                            <img class="application_logo_image" alt="<?php echo dt_get_CompanyName(); ?>" src="<?php echo dt_get_CompanyLogo(); ?>"/></a>
                    </div>
                    <div class="modal-dialog w-100 mx-auto">
                        <div class="modal-content">
                            <?php
                            $hidden = array("id" => $id);
                            $attributes = array('id' => 'change_password_form', 'name' => 'change_password_form', 'method' => "post");
                            echo form_open('admin/reset-password-action', $attributes, $hidden);
                            ?>
                            <div class="modal-body">
                                <div class="h5 modal-title text-center">
                                    <h4 class="mt-2">
                                        <span><?php echo dt_translate('reset_password') ?></span>
                                    </h4>
                                </div>
                                <?php $this->load->view('message'); ?>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <input type="password" data-msg-required="<?php echo dt_translate('required_message'); ?>" required="" id="password" minlength="8" autocomplete="off"  name="password" value="" class="form-control" placeholder="<?php echo dt_translate('password'); ?>">
                                            <?php echo form_error('password'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <input type="password" data-msg-required="<?php echo dt_translate('required_message'); ?>" required="" id="confirm_password"  autocomplete="off" name="confirm_password" value="" class="form-control" placeholder="<?php echo dt_translate('confirm_password'); ?>">
                                            <?php echo form_error('Cpassword'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider"></div>
                            </div>
                            <div class="modal-footer clearfix">
                                <div class="float-left"><a href="<?php echo base_url("login"); ?>" class="btn-lg btn btn-link"><?php echo dt_translate('login'); ?></a></div>
                                <div class="float-right">
                                    <button class="btn btn-primary btn-lg" type="submit">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <?php echo dt_translate('submit'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/global/js/jquery-3.4.1.min.js');?>"></script>
<script src="<?php echo base_url('assets/global/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?php echo base_url('assets/global/js/jquery.validate.min.js');?>"></script>
<script src="<?php echo base_url('assets/global/js/additional-methods.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/functions.js');?>"></script>
</body>
</html>
