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
        <title><?php echo dt_translate('login'); ?></title>

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
									<?php
									$company_name = dt_get_CompanyName();

									?>
                                    <h3><?php echo $company_name;?></h3>
                                    <img class="application_logo_image rounded-circle" alt="<?php echo $company_name; ?>" src="<?php echo dt_get_CompanyLogo(); ?>"/>
                                </a>
                            </div>
                            <div class="modal-dialog w-100 mx-auto">
                                <div class="modal-content">
                                    <?php
                                    $attributes = array('id' => 'Login', 'name' => 'Login', 'method' => "post");
                                    echo form_open('admin/login-action', $attributes);
                                    ?>
                                    <div class="modal-body">
                                        <div class="h5 modal-title text-center">
                                            <h4 class="mt-2">
                                                <span><?php echo dt_translate('login') ?></span>
                                            </h4>
                                        </div>
                                        <?php $this->load->view('message'); ?>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input required  data-msg-email="<?php echo dt_translate('enter_valid_mobile'); ?>"  data-msg-required="<?php echo dt_translate('required_message'); ?>" autocomplete="off" name="username" id="username"  placeholder="<?php echo dt_translate('mobile') ?>" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input required  data-msg-required="<?php echo dt_translate('required_message'); ?>" autocomplete="off" name="password" id="password" placeholder="<?php echo dt_translate('password') ?>" type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                    </div>
                                    <div class="modal-footer clearfix">
                                        
                                        <div class="float-right">
                                            <button class="btn btn-primary btn-lg" type="submit">
                                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                <?php echo dt_translate('login'); ?></button>
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
