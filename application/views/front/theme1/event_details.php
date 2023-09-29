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
$news_image_path="";
if (isset($app_event['image']) && $app_event['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_event['image'])) {
        $news_image_path = base_url() . uploads_path . '/' . $app_event['image'];
    }
}


?>
<?php if(isset($is_breadcrumb_enabled) && $is_breadcrumb_enabled=="N"): ?>
    <div class="hero-wrap" style="background-image: url('<?php echo $banner_image_path; ?>');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><a href="<?php echo base_url('events'); ?>"><?php echo dt_translate('events') ?></a></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $app_event['title']; ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('news'); ?>"><?php echo dt_translate('events') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo escape_data($app_event['title']); ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate">
                    <h2 class="mb-3"><?php echo $app_event['title']; ?></h2>
                    <p><b><?php echo dt_translate('venue'); ?>: </b> <?php echo $app_event['event_venue']; ?></p>
                    <p><b><?php echo dt_translate('date'); ?>: </b> <?php echo date("d M, Y",strtotime($app_event['event_date'])); ?> | <b><?php echo dt_translate('time'); ?>: </b> <?php echo date("H:i A",strtotime($app_event['event_time'])); ?></p>
                    <?php if(isset($news_image_path) && $news_image_path!=""): ?>
                        <img src="<?php echo $news_image_path; ?>" class="img-fluid" />
                    <?php endif; ?>
                    <hr/>
                    <p><?php echo $app_event['description']; ?></p>
                    <div class="commentbox"></div>

                </div> <!-- .col-md-8 -->
                <div class="col-md-4 sidebar ftco-animate">
                    <div class="sidebar-box ftco-animate">
                        <h3><?php echo dt_translate('events'); ?></h3>
                        <?php foreach ($recent_event as $revents):
                            if (isset($revents['image']) && $revents['image']!= "") {
                                if (file_exists(FCPATH .uploads_path.'/'. $revents['image'])) {
                                    $nimage_path = base_url() . uploads_path . '/' . $revents['image'];
                                } else {
                                    $nimage_path = base_url() . img_path . "/no-image.png";
                                }
                            } else {
                                $nimage_path = base_url() . img_path . "/no-image.png";
                            }
                            ?>
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4" style="background-image: url(<?php echo $nimage_path; ?>);"></a>
                                <div class="text">
                                    <h3 class="heading"><a href="<?php echo base_url('event-details/'.$revents['event_id']); ?>"><?php echo escape_data($revents['title']); ?></a></h3>
                                    <div class="meta">
                                        <div>
                                            <a href="<?php echo base_url('event-details/'.$revents['event_id']); ?>"><span class="icon-calendar"></span> <?php echo date('M d, Y',strtotime($revents['event_date'])); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </section> <!-- .section -->
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>