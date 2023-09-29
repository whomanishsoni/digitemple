<?php
$url_segment = trim($this->uri->segment(1));
$app_gallery_count=dt_get_gallery(1);
$app_news_count=dt_get_news(1);
$app_causes_count=dt_get_causes(1);
$app_project_count=dt_get_project(1);
$app_event_count=dt_get_event(1);
$app_team_count=dt_get_team(1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo dt_get_CompanyName(); ?> <?php echo (isset($title) && $title!="")?"| ".$title:""; ?></title>
    <meta charset="utf-8">

    <link rel="icon" type="image/x-icon" href="<?php echo dt_get_fevicon(); ?>"/>
    <meta name="description" content="<?php echo dt_get_content('seo_description'); ?>">
    <meta name="keywords" content="<?php echo dt_get_content('seo_keyword'); ?>">
    <meta name="author" content="<?php echo dt_get_CompanyName(); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,400i,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/open-iconic-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/aos.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/theme1/css/style.css'); ?>">

    <!-- Google Analytics Code -->
    <?php echo dt_get_content('google_analytics'); ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light scrolled awake" id="ftco-navbar">
    <input id="comment_project_id" type="hidden" value="<?php echo dt_get_content('comment_project_id'); ?>"/>
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <img class="app_logo" src="<?php echo dt_get_CompanyLogo(); ?>" alt="<?php echo dt_get_CompanyName(); ?>"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span>
            </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo ($url_segment=="")?"active":""; ?>"><a href="<?php echo base_url(); ?>" class="nav-link"><?php echo dt_translate('home')?></a></li>
                <li class="nav-item <?php echo ($url_segment=="about-us")?"active":""; ?>"><a href="<?php echo base_url('about-us'); ?>" class="nav-link"><?php echo dt_translate('about_us')?></a></li>

                <?php if(is_module_enabled('causes')==true && isset($app_causes_count)&& count($app_causes_count)>0): ?>
                <li class="nav-item <?php echo ($url_segment=="causes" || $url_segment=="cause-details")?"active":""; ?>"><a href="<?php echo base_url('causes'); ?>" class="nav-link"><?php echo dt_translate('causes')?></a></a></li>
                <?php endif; ?>

                <?php if(is_module_enabled('news')==true && isset($app_news_count)&& count($app_news_count)>0): ?>
                <li class="nav-item <?php echo ($url_segment=="news" || $url_segment=="news-details")?"active":""; ?>"><a href="<?php echo base_url('news'); ?>" class="nav-link"><?php echo dt_translate('news')?></a></li>
                <?php endif; ?>

                <?php if(is_module_enabled('projects')==true && isset($app_project_count)&& count($app_project_count)>0): ?>
                    <li class="nav-item <?php echo ($url_segment=="projects" || $url_segment=="project-details")?"active":""; ?>"><a href="<?php echo base_url('projects'); ?>" class="nav-link"><?php echo dt_translate('projects')?></a></li>
                <?php endif; ?>

                <?php if(is_module_enabled('events')==true && isset($app_event_count)&& count($app_event_count)>0): ?>
                    <li class="nav-item <?php echo ($url_segment=="events" || $url_segment=="event-details")?"active":""; ?>"><a href="<?php echo base_url('events'); ?>" class="nav-link"><?php echo dt_translate('events')?></a></li>
                <?php endif; ?>

                <?php if(is_module_enabled('gallery')==true && isset($app_gallery_count)&& count($app_gallery_count)>0): ?>
                <li class="nav-item <?php echo ($url_segment=="gallery")?"active":""; ?>"><a href="<?php echo base_url('gallery'); ?>" class="nav-link"><?php echo dt_translate('gallery')?></a></li>
                <?php endif; ?>

                <?php if(is_module_enabled('team')==true && isset($app_team_count)&& count($app_team_count)>0): ?>
                    <li class="nav-item <?php echo ($url_segment=="our-team")?"active":""; ?>"><a href="<?php echo base_url('our-team'); ?>" class="nav-link"><?php echo dt_translate('our')." ".dt_translate('team')?></a></li>
                <?php endif; ?>

                <li class="nav-item <?php echo ($url_segment=="contact-us")?"active":""; ?>"><a href="<?php echo base_url('contact-us'); ?>" class="nav-link"><?php echo dt_translate('contact_us')?></a></li>
                <li class="nav-item"><a href="<?php echo base_url('donate'); ?>" id="donation_button_style" class="text_white nav-link donation_button_style"><?php echo dt_translate('donate')?></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->