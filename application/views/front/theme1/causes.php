<?php
include VIEWPATH . 'front/theme1/header.php';
$app_causes=dt_get_causes();


//Banner Content
$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('causes_background');
$banner_image_path = base_url() . img_path . "/causes.jpg";

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
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><?php echo dt_translate('causes') ?></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo dt_translate('causes') ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('causes') ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>


    <section class="ftco-section">
        <div class="container">
            <?php $this->load->view('message'); ?>
            <div class="row">
                <?php if(isset($app_causes) && count($app_causes)>0): ?>
                    <?php foreach ($app_causes as $val):
                        if (isset($val['image']) && $val['image']!= "") {
                            if (file_exists(FCPATH .uploads_path.'/'. $val['image'])) {
                                $image_path = base_url() . uploads_path . '/' . $val['image'];
                            } else {
                                $image_path = base_url() . img_path . "/no-image.png";
                            }
                        } else {
                            $image_path = base_url() . img_path . "/no-image.png";
                        }
                        $raised_per=($val['received_amount']/($val['target_amount']))*100;
                        ?>
                        <div class="col-md-4 ftco-animate">
                            <div class="cause-entry">
                                <a href="<?php echo base_url('cause-details/'.$val['id']); ?>" class="img" style="background-image: url(<?php echo $image_path; ?>);"></a>
                                <div class="text p-3 p-md-4">
                                    <h3><a href="<?php echo base_url('cause-details/'.$val['id']); ?>"><?php echo escape_data($val['title']); ?></a></h3>
                                    <div class="progress custom-progress-success">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $raised_per;?>%" aria-valuenow="<?php echo $raised_per;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="fund-raised d-block"><?php echo dt_price_format($val['received_amount']); ?> <?php echo dt_translate('raised_of');?> <?php echo dt_price_format($val['target_amount']); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>