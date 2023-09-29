<?php
include VIEWPATH . 'front/theme1/header.php';
//Banner Content
$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('event_background');
$banner_image_path = base_url() . img_path . "/event.jpg";

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
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><?php echo dt_translate('events') ?></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo dt_translate('events') ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('events') ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>

    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                <?php if(isset($app_events) && count($app_events)>0):?>
                    <?php foreach ($app_events as $val):

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
                        <div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated">
                            <div class="blog-entry align-self-stretch">
                                <a href="<?php echo base_url('event-details/'.$val['event_id']); ?>" class="block-20" style="background-image: url('<?php echo $image_path; ?>');">
                                </a>
                                <div class="text p-4 d-block">
                                    <div class="meta mb-3">
                                        <div>
                                            <a href="<?php echo base_url('event-details/'.$val['event_id']); ?>"> <?php echo date('d M, Y',strtotime($val['event_time'])); ?></a>
                                        </div>
                                    </div>
                                    <h3 class="heading mb-4"><a href="<?php echo base_url('event-details/'.$val['event_id']); ?>"><?php echo $val['title']; ?></a></h3>
                                    <p class="time-loc"><span class="mr-2"><i class="icon-clock-o"></i> <?php echo date('H:i A',strtotime($val['event_time'])); ?></span></p>
                                    <p class="time-loc"><span class="mr-2"><span><i class="icon-map-o"></i> <?php echo $val['event_venue']; ?></span></p>
                                    <p><a href="<?php echo base_url('event-details/'.$val['event_id']); ?>"><?php echo dt_translate('view_more'); ?> <i class="ion-ios-arrow-forward"></i></a></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>

                <?php endif;?>
            </div>
        </div>
    </section>
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>