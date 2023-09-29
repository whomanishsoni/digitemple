<?php
$url_segment = trim($this->uri->segment(1));

$search_allowed = array('category-details', 'team-listing', 'team-category', 'search', 'services', 'team');
$about_us_active=$cause_active=$news_active=$gallery_active=$slider_active=$team_active=$page_active=$contact_active=$home_content_active="";

$about_array=array("manage-about-us","manage-about-us-action");
$cause_array=array("manage-causes","add-cause","save-causes","delete-causes","update-cause","cause-donation");
$news_array=array("manage-news","add-news","save-news","delete-news","update-news");
$gallery_array=array("manage-gallery","add-gallery","save-gallery","delete-gallery","update-gallery");
$slider_array=array("manage-slider","add-slider","save-slider","delete-slider","update-slider");
$team_array=array("manage-team","add-team","save-team","delete-team","update-team");
$contact_array=array("manage-contact-us");
$banner_array=array("manage-banner");
$home_content_array=array("manage-home-content","save-home-content");


if(in_array($url_segment,$about_array)){
    $about_us_active="active";
}elseif (in_array($url_segment,$cause_array)){
    $cause_active="active";
}elseif (in_array($url_segment,$news_array)){
    $news_active="active";
}elseif (in_array($url_segment,$gallery_array)){
    $gallery_active="active";
}elseif (in_array($url_segment,$team_array)){
    $team_active="active";
}elseif (in_array($url_segment,$contact_array)){
    $contact_active="active";
}elseif (in_array($url_segment,$home_content_array)){
    $home_content_active="active";
}elseif (in_array($url_segment,$banner_array)){
    $banner_image_active="active";
}elseif (in_array($url_segment,$banner_array)){
    $banner_image_active="active";
}

?>

<ul class="nav text-left" id="website_topbar">

    <li class="nav-item">
        <a role="tab" class="nav-link <?php echo $home_content_active; ?> show" href="<?php echo base_url('admin/manage-home-content'); ?>" aria-selected="true">
            <span><?php echo dt_translate('home')." ".dt_translate('content'); ?></span>
        </a>
    </li>

    <li class="nav-item">
        <a role="tab" class="nav-link <?php echo $banner_image_active; ?> show" href="<?php echo base_url('admin/manage-banner'); ?>" aria-selected="true">
            <span><?php echo dt_translate('banner_image'); ?></span>
        </a>
    </li>

    <li class="nav-item">
        <a role="tab" class="nav-link <?php echo $about_us_active; ?> show" href="<?php echo base_url('admin/manage-about-us'); ?>" aria-selected="true">
            <span><?php echo dt_translate('about_us'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link <?php echo $page_active; ?> show" href="<?php echo base_url('admin/manage-pages'); ?>" aria-selected="true">
            <span><?php echo dt_translate('pages'); ?></span>
        </a>
    </li>

    <?php if(is_module_enabled('report')==true): ?>
    <li class="nav-item">
        <a role="tab" class="nav-link <?php echo $gallery_active; ?> show" href="<?php echo base_url('admin/manage-gallery'); ?>" aria-selected="false">
            <span><?php echo dt_translate('gallery'); ?></span>
        </a>
    </li>
    <?php endif; ?>

    <!--<li class="nav-item">
        <a role="tab" class="nav-link <?php echo $slider_active; ?> show" href="<?php echo base_url('admin/manage-slider'); ?>" aria-selected="false">
            <span><?php echo dt_translate('slider'); ?></span>
        </a>
    </li>-->

    <?php if(is_module_enabled('team')==true): ?>
    <li class="nav-item">
        <a role="tab" class="nav-link <?php echo $team_active; ?> show" href="<?php echo base_url('admin/manage-team'); ?>" aria-selected="false">
            <span><?php echo dt_translate('team'); ?></span>
        </a>
    </li>
    <?php endif; ?>

    <li class="nav-item">
        <a role="tab" class="nav-link <?php echo $contact_active; ?> show" href="<?php echo base_url('admin/manage-contact-us'); ?>" aria-selected="false">
            <span><?php echo dt_translate('contact_us'); ?></span>
        </a>
    </li>
</ul>