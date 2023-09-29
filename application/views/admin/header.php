<?php
$login_data = dt_get_CustomerDetails();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Language" content="en"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <!--favicon -->
    <link rel="icon" href="<?php echo dt_get_fevicon(); ?>" type="image/x-icon">
    <!-- TITLE -->
    <title><?php echo isset($title) ? $title : ""; ?></title>
    <!-- CSS -->
    <link href="<?php echo base_url('assets/global/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo base_url('assets/global/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/fade-down.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/p-scroll.css');?>" rel="stylesheet" type="text/css">
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets/admin/css/color.css');?>">
    <!-- CSS End -->
    <script>
        var base_url="<?php echo base_url(); ?>";
    </script>
</head>
<body class="app" cz-shortcut-listen="true">
<div class="donately_menu_container">

    <div class="page">
        <div class="page-main">
            <!-- HEADER -->
            <div class="header top-header">
                <div class="container">
                    <div class="d-flex header-nav">
                        <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
                        <div class="color-headerlogo">
                            <a class="header-desktop" href="<?php echo base_url('admin/dashboard');?>"><img class="application_logo_image thumbnail rounded-circle" src="<?php echo dt_get_CompanyLogo(); ?>" style="max-height:55px;max-width:70px;padding:1px" />
								
							</a>
                            <a class="header-mobile" href="<?php echo base_url('admin/dashboard');?>"></a> </div>
                        <!-- Color LOGO -->
                        
                        <div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
                            <!--
                            <div class="dropdown"> 
                                <a href="<?php echo base_url(); ?>" target="_blank" class="nav-link nav-link-lg d-md-none navsearch"> <i class="fa fa-laptop"></i> </a> 
                            </div>
                            -->
                            <div class="dropdown header-user">
                                <a href="index.html#" class="nav-link icon" data-toggle="dropdown"> <span><img src="<?php echo base_url('assets/images/default_user.png'); ?>" alt="profile-user" class="avatar brround cover-image mb-0 ml-0"></span> </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <div class=" dropdown-header noti-title text-center border-bottom p-3">
                                        <div class="header-usertext">
                                            <h5 class="mb-1"><?php echo $login_data['first_name'] . " " . $login_data['last_name']; ?></h5>
                                            <?php if(isset($login_data['type']) && $login_data['type']=="A"): ?>
                                            <p class="mb-0"><?php echo dt_translate('administrator') ?></p>
                                            <?php else: ?>
                                            <p class="mb-0"><?php echo dt_translate('staff') ?></p>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="<?php echo base_url('admin/profile'); ?>"> <i class="fa fa-user mr-2"></i> <span><?php echo dt_translate('profile');?></span> </a>
                                    <a class="dropdown-item" href="<?php echo base_url('admin/change-password'); ?>"> <i class="fa fa-lock mr-2"></i> <span><?php echo dt_translate('Change_password');?></span></span> </a>
                                    <a class="dropdown-item" href="<?php echo base_url('admin/logout'); ?>"> <i class="fa fa-power-off mr-2"></i> <span><?php echo dt_translate('logout');?></span> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HEADER END -->
            <!-- HORIZONTAL-MENU -->
            <div class="sticky">
                <div class="donately-main hor-menu clearfix ">
                    <div class="donately-mainwrapper container clearfix">
                        <nav class="donately_menu clearfix">
                            <div class="overlapblackbg"></div>
                            <ul class="donately_menu-list">
                                <li>
                                    <a href="<?php echo base_url('admin/dashboard'); ?>" class="sub-icon active"><i class="fa fa-home"></i></a>
                                </li>
                                <?php if($this->login_type=='A' && false ): ?>
                                    <li aria-haspopup="true"><a href="<?php echo base_url('admin/manage-home-content'); ?>" class=""><i class="fa fa-laptop"></i> <?php echo dt_translate('website'); ?></a></li>
                                <?php endif; ?>

                                <li>
                                    <a href="<?php echo base_url('admin/donation'); ?>" class="sub-icon"><i class="fa fa-address-card"></i> <?php echo dt_translate('donation'); ?></a>
                                </li>

                                <?php if(is_module_enabled('item')==true): ?>
                                    <li>
                                        <a href="<?php echo base_url('admin/item-donation'); ?>" class="sub-icon"><i class="fa fa-gift"></i> <?php echo dt_translate('item')." ".dt_translate('donation'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(is_module_enabled('causes')==true && $this->login_type=='A'): ?>
                                    <li>
                                        <a href="<?php echo base_url('admin/manage-causes'); ?>" class="sub-icon"><i class="fa fa-address-card"></i> <?php echo dt_translate('causes'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(is_module_enabled('expense')==true): ?>
                                    <li>
                                        <a href="<?php echo base_url('admin/expense'); ?>" class="sub-icon"><i class="fa fa-credit-card"></i> <?php echo dt_translate('expense'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if($this->login_type=='A'): ?>
                                <li>
                                    <a href="<?php echo base_url('admin/transfer'); ?>" class="sub-icon"><i class="fa fa-paper-plane"></i> <?php echo dt_translate('transfer'); ?></a>
                                </li>
                                <?php endif; ?>

                                <?php if(is_module_enabled('report')==true && $this->login_type=='A'): ?>
                                <li>
                                    <a href="<?php echo base_url('admin/report'); ?>" class="sub-icon"><i class="fa fa-bar-chart-o"></i> <?php echo dt_translate('report'); ?></a>
                                </li>
                                <?php endif; ?>

                                <?php if(is_module_enabled('staff')==true && $this->login_type=='A'): ?>
                                    <li><a href="<?php echo base_url('admin/staff'); ?>"  class="sub-icon"><i class="fa fa-user"></i> <?php echo dt_translate('staff');?></a></li>
                                <?php endif; ?>

                                <?php if($this->login_type=='A'): ?>
                                    <li><a href="<?php echo base_url('admin/account'); ?>"  class="sub-icon"><i class="fa fa-money"></i> <?php echo dt_translate('account');?></a></li>
                                <?php endif; ?>

                                <?php if($this->login_type=='A'): ?>
                                <li aria-haspopup="true">
                                    <span class="donately_menu-click"><i class="donately_menu-arrow fa fa-angle-down"></i></span>
                                    <a href="javascript:void(0)" class="sub-icon"><i class="fa fa-file-text"></i> <?php echo dt_translate('category');?> <i class="fa fa-angle-down horizontal-icon"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('admin/donation-category'); ?>"><i class="fa fa-arrow-right"></i> <?php echo dt_translate('department'); ?> </a></li>

                                        <?php if(is_module_enabled('item')==true): ?>
                                        <li><a href="<?php echo base_url('admin/items'); ?>"><i class="fa fa-arrow-right"></i> <?php echo dt_translate('items'); ?> </a></li>
                                        <?php endif; ?>

                                        <?php if(is_module_enabled('expense')==true): ?>
                                        <li><a href="<?php echo base_url('admin/expense-category'); ?>"><i class="fa fa-arrow-right"></i> <?php echo dt_translate('expense_category'); ?></a></li>
                                        <?php endif; ?>

                                        <?php if(is_module_enabled('news')==true): ?>
                                        <li><a href="<?php echo base_url('admin/manage-news'); ?>"><i class="fa fa-arrow-right"></i> <?php echo dt_translate('news'); ?></a></li>
                                        <?php endif; ?>


                                        <?php if(is_module_enabled('events')==true): ?>
                                        <li><a href="<?php echo base_url('admin/manage-events'); ?>"><i class="fa fa-arrow-right"></i> <?php echo dt_translate('events'); ?></a></li>
                                        <?php endif; ?>


                                        <?php if(is_module_enabled('projects')==true): ?>
                                        <li><a href="<?php echo base_url('admin/manage-projects'); ?>"><i class="fa fa-arrow-right"></i> <?php echo dt_translate('projects '); ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>

                                <!--
                                <li aria-haspopup="true">
                                    <span class="donately_menu-click"><i class="donately_menu-arrow fa fa-angle-down"></i></span>
                                    <a href="javascript:void(0)" class="sub-icon"><i class="fa fa-gears"></i> <?php echo dt_translate('setting');?> <i class="fa fa-angle-down horizontal-icon"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('admin/setting'); ?>"><i class="fa fa-gears"></i> <?php echo dt_translate('site_setting');?></a></li>
                                        <li><a href="<?php echo base_url('admin/email-setting'); ?>"><i class="fa fa-mail-reply"></i> <?php echo dt_translate('email_setting');?></a></li>
                                        <li><a href="<?php echo base_url('admin/payment-setting'); ?>"><i class="fa fa-credit-card"></i> <?php echo dt_translate('payment_setting');?></a></li>
                                        <li><a href="<?php echo base_url('admin/module-setting'); ?>"><i class="fa fa-building"></i> <?php echo dt_translate('module')." ".dt_translate('setting'); ?></a></li>
                                        <li><a href="<?php echo base_url('admin/seo'); ?>"><i class="fa fa-laptop"></i> <?php echo dt_translate('seo');?></a></li>
                                        <li><a href="<?php echo base_url('admin/currency'); ?>"><i class="fa fa-dollar"></i> <?php echo dt_translate('currency'); ?></a></li>
                                        <li><a href="<?php echo base_url('admin/language'); ?>"><i class="fa fa-language"></i> <?php echo dt_translate('language'); ?></a></li>
                                    </ul>
                                </li>
                                -->
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <!-- NAV END -->
                    </div>
                </div>
            </div>
            <!-- HORIZONTAL-MENU END -->







