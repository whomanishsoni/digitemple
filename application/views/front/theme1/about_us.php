<?php
include VIEWPATH . 'front/theme1/header.php';
$about_data=dt_get_about_us();

if (isset($about_data['image']) && $about_data['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $about_data['image'])) {
        $image_path = base_url() . uploads_path . '/' . $about_data['image'];
    } else {
        $image_path = base_url() . img_path . "/about_us.jpg";
    }
} else {
    $image_path = base_url() . img_path . "/about_us.jpg";
}

if(isset($about_data['details']) && $about_data['details']!=""){
    $titles=json_decode($about_data['details']);
}else{
    $titles=array();
}

//Banner Content
$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('about_us_background');
$about_us_background = base_url() . img_path . "/about_us.jpg";
if (isset($banner_content) && $banner_content!= "") {
    if (file_exists(FCPATH .uploads_path.'/'.$banner_content)) {
        $about_us_background = base_url() . uploads_path . '/' .$banner_content;
    }
}
?>
<?php if(isset($is_breadcrumb_enabled) && $is_breadcrumb_enabled=="N"): ?>
    <div class="hero-wrap" style="background-image: url('<?php echo $about_us_background; ?>');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><?php echo dt_translate('about_us') ?></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo dt_translate('about_us') ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('about_us') ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>
<section class="ftco-section">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 d-flex ftco-animate">
                <div class="img img-about align-self-stretch width_100pr" style="max-height: 480px;background-image: url(<?php echo $image_path; ?>);"></div>
            </div>
            <div class="col-md-6 pl-md-5 ftco-animate">
                <h2 class="mb-4"><?php echo isset($titles[0])?escape_data($titles[0]):""; ?></h2>
                <p><?php echo isset($titles[1])?escape_data($titles[1]):""; ?></p>
                <p><?php echo isset($titles[2])?escape_data($titles[2]):""; ?></p>
            </div>
        </div>
    </div>
</section>
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>