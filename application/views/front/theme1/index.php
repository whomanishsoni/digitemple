<?php
include VIEWPATH . 'front/theme1/header.php';
$app_gallery=dt_get_gallery(4);
$app_news=dt_get_news(4);
$app_causes=dt_get_causes(4);

$title_one=$title_two=$title_three="";
$desc_one=$desc_two=$desc_three="";
if(isset($home_content_title['details']) && $home_content_title['details']!=""){
    $apps_title=json_decode($home_content_title['details']);
    $title_one=isset($apps_title[0])?$apps_title[0]:"";
    $title_two=isset($apps_title[1])?$apps_title[1]:"";
    $title_three=isset($apps_title[2])?$apps_title[2]:"";
}

if(isset($home_content_description['details']) && $home_content_description['details']!=""){
    $desc_title=json_decode($home_content_description['details']);
    $desc_one=isset($desc_title[0])?$desc_title[0]:"";
    $desc_two=isset($desc_title[1])?$desc_title[1]:"";
    $desc_three=isset($desc_title[2])?$desc_title[2]:"";
}

$get_video_link=dt_get_content('video_link');
$get_home_slogan=dt_get_content('home_slogan');


$banner_content=dt_get_content_image('home_background');
$banner_image_path = base_url() . img_path . "/home_banner.jpg";

if (isset($banner_content) && $banner_content!= "") {
    if (file_exists(FCPATH .uploads_path.'/'.$banner_content)) {
        $banner_image_path = base_url() . uploads_path . '/' .$banner_content;
    }
}

?>
<div class="hero-wrap" style="background-image: url('<?php echo $banner_image_path; ?>');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <?php if(isset($get_home_slogan) && $get_home_slogan!=""): ?>
                    <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $get_home_slogan; ?></h1>
                <?php endif; ?>

                <?php if(isset($get_video_link) && $get_video_link!=""): ?>
                    <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="<?php echo $get_video_link; ?>" class="btn btn-white btn-outline-white px-4 py-3 popup-vimeo"><span class="icon-play mr-2"></span><?php echo dt_translate('what_we_do'); ?></a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<section class="ftco-counter ftco-intro" id="section-counter">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 color-2 align-items-stretch">
                    <div class="text">
                        <h3 class="mb-4"><?php echo dt_translate('donate_money'); ?><a href="<?php echo base_url('donate'); ?>" class="btn btn-white float_right px-3 py-2 mt-2"><?php echo dt_translate('donate_now'); ?></a></h3>
                        <p><?php echo dt_translate('donate_money_sub_title');?></p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 d-flex services p-3 py-4 d-block">
                        <div class="icon d-flex mb-3"><span class="flaticon-donation-1"></span></div>
                        <div class="media-body pl-4">
                            <h3 class="heading"><?php echo $title_one; ?></h3>
                            <p><?php echo $desc_one; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 d-flex services p-3 py-4 d-block">
                        <div class="icon d-flex mb-3"><span class="flaticon-charity"></span></div>
                        <div class="media-body pl-4">
                            <h3 class="heading"><?php echo $title_two; ?></h3>
                            <p><?php echo $desc_two; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 d-flex services p-3 py-4 d-block">
                        <div class="icon d-flex mb-3"><span class="flaticon-donation"></span></div>
                        <div class="media-body pl-4">
                            <h3 class="heading"><?php echo $title_three; ?></h3>
                            <p><?php echo $desc_three; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php if(is_module_enabled('causes')==true): ?>
    <?php if(isset($app_causes) && count($app_causes)>0): ?>
        <section class="ftco-section bg-light">
            <div class="container-fluid">
                <div class="row justify-content-center mb-5 pb-3">
                    <div class="col-md-5 heading-section ftco-animate text-center">
                        <h2 class="mb-4"><?php echo dt_translate('our_causes'); ?></h2>
                        <p><?php echo dt_translate('our_causes_title'); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="carousel-cause owl-carousel">
                            <?php foreach ($app_causes as $cval):

                                if (isset($cval['image']) && $cval['image']!= "") {
                                    if (file_exists(FCPATH .uploads_path.'/'. $cval['image'])) {
                                        $caimage_path = base_url() . uploads_path . '/' . $cval['image'];
                                    } else {
                                        $caimage_path = base_url() . img_path . "/no-image.png";
                                    }
                                } else {
                                    $caimage_path = base_url() . img_path . "/no-image.png";
                                }

                                $raised_per=($cval['received_amount']/($cval['target_amount']))*100;

                                ?>
                            <div class="item">
                                <div class="cause-entry">
                                    <a href="<?php echo base_url('cause-details/'.$cval['id']); ?>" class="img" style="background-image: url(<?php echo $caimage_path; ?>);"></a>
                                    <div class="text p-3 p-md-4">
                                        <h3><a href="<?php echo base_url('cause-details/'.$cval['id']); ?>"><?php echo $cval['title']; ?></a></h3>
                                        <div class="progress custom-progress-success">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $raised_per; ?>%" aria-valuenow="<?php echo $raised_per; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="fund-raised d-block"><?php echo dt_price_format($cval['received_amount']); ?> <?php echo dt_translate('raised_of');?> <?php echo dt_price_format($cval['target_amount']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php if(is_module_enabled('gallery')==true): ?>
<?php if(isset($app_gallery) && count($app_gallery)>0): ?>
<section class="ftco-gallery">
    <div class="d-md-flex">
        <?php foreach ($app_gallery as $gval):
            if (isset($gval['image']) && $gval['image']!= "") {
                if (file_exists(FCPATH .uploads_path.'/'. $gval['image'])) {
                    $gimage_path = base_url() . uploads_path . '/' . $gval['image'];
                } else {
                    $gimage_path = base_url() . img_path . "/no-image.png";
                }
            } else {
                $gimage_path = base_url() . img_path . "/no-image.png";
            }
            ?>
        <a href="<?php echo $gimage_path; ?>" class="gallery image-popup d-flex justify-content-center align-items-center img ftco-animate" style="background-image: url(<?php echo $gimage_path; ?>);">
            <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-search"></span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php if(is_module_enabled('news')==true): ?>
<?php if(isset($app_news) && count($app_news)>0): ?>
 <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4"><?php echo dt_translate('recent_news'); ?></h2>
                    <p><?php echo dt_translate('recent_news_title'); ?></p>
                </div>
            </div>
            <div class="row d-flex">
                <?php foreach ($app_news as $nval):
                    if (isset($nval['image']) && $nval['image']!= "") {
                        if (file_exists(FCPATH .uploads_path.'/'. $nval['image'])) {
                            $nimage_path = base_url() . uploads_path . '/' . $nval['image'];
                        } else {
                            $nimage_path = base_url() . img_path . "/no-image.png";
                        }
                    } else {
                        $nimage_path = base_url() . img_path . "/no-image.png";
                    }
                    ?>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="<?php echo base_url('news-details/'.$nval['id']); ?>" class="block-20" style="background-image: url('<?php echo $nimage_path; ?>');"></a>
                            <div class="text p-4 d-block">
                                <div class="meta mb-3">
                                    <div><a href="<?php echo base_url('news-details/'.$nval['id']); ?>"><?php echo date('M d, Y',strtotime($nval['created_on'])); ?></a></div>
                                    <div><a href="<?php echo base_url('news-details/'.$nval['id']); ?>"><?php echo $nval['first_name']." ".$nval['last_name']; ?></a></div>
                                </div>
                                <h3 class="heading mt-3"><a href="<?php echo base_url('news-details/'.$nval['id']); ?>"><?php echo $nval['title']; ?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php endif; ?>

<?php
include VIEWPATH . 'front/theme1/footer.php';
?>