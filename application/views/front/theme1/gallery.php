<?php
include VIEWPATH . 'front/theme1/header.php';

$app_gallery=dt_get_gallery();
//Banner Content
$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('gallery_background');
$banner_image_path = base_url() . img_path . "/gallery.jpg";

if (isset($banner_content) && $banner_content!= "") {
    if (file_exists(FCPATH .uploads_path.'/'.$banner_content)) {
        $banner_image_path = base_url() . uploads_path . '/' .$banner_content;
    }
}
?>
<?php if(isset($is_breadcrumb_enabled) && $is_breadcrumb_enabled=="N"): ?>
    <div class="hero-wrap" style="background-image: url('<?php echo $banner_image_path; ?>');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><?php echo dt_translate('gallery') ?></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo dt_translate('gallery') ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('gallery') ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>

    <section class="ftco-section ftco-gallery">
        <div class="container">
            <?php if(isset($app_gallery) && count($app_gallery)>0): ?>
                <div class="d-md-flex">
                    <?php
                    $i=0;
                    foreach ($app_gallery as $val):
                        if (isset($val['image']) && $val['image']!= "") {
                            if (file_exists(FCPATH .uploads_path.'/'. $val['image'])) {
                                $image_path = base_url() . uploads_path . '/' . $val['image'];
                            } else {
                                $image_path = base_url() . img_path . "/no-image.png";
                            }
                        } else {
                            $image_path = base_url() . img_path . "/no-image.png";
                        }
                        ?>
                        <a href="<?php echo $image_path; ?>" class="gallery image-popup d-flex justify-content-center align-items-center img ftco-animate" style="background-image: url(<?php echo $image_path; ?>);">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-search"></span>
                            </div>
                        </a>
                    <?php
                        $i++;
                        if($i%4==0){
                            echo "</div><div class='d-md-flex'>";
                        }
                    endforeach; ?>
                </div>
            <?php else: ?>
            <?php endif; ?>
            </div>
        </div>
    </section>
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>