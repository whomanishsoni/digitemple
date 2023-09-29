<?php
include VIEWPATH . 'front/theme1/header.php';
$app_team=dt_get_team();
//Banner Content
$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('team_background');
$banner_image_path = base_url() . img_path . "/team.jpg";

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
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><?php echo dt_translate('team') ?></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo dt_translate('team') ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('team') ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">

                <?php if(isset($app_team) && count($app_team)>0): ?>
                    <?php foreach ($app_team as $val):

                        if (isset($val['image']) && $val['image']!= "") {
                            if (file_exists(FCPATH .uploads_path.'/'. $val['image'])) {
                                $gimage_path = base_url() . uploads_path . '/' . $val['image'];
                            } else {
                                $gimage_path = base_url() . img_path . "/no-image.png";
                            }
                        } else {
                            $gimage_path = base_url() . img_path . "/no-image.png";
                        }
                        ?>
                            <div class="col-lg-4 d-flex mb-sm-4 ftco-animate">
                                <div class="staff">
                                    <div class="d-flex mb-2">
                                        <div class="img" style="background-image: url(<?php echo $gimage_path; ?>);"></div>
                                        <div class="info ml-4">
                                            <h3><a href="javascript:void(0)"><?php echo escape_data($val['name']); ?></a></h3>
                                            <span class="position"><?php echo escape_data($val['designation']); ?></span>
                                            <div class="text">
                                                <ul class="team_ul">
                                                    <?php if(isset($val['facebook']) && $val['facebook']!=""): ?>
                                                        <li><a href="<?php echo $val['facebook']; ?>" target="_blank" ><span class="icon-facebook-square"></span></a></li>
                                                    <?php endif; ?>

                                                    <?php if(isset($val['linkdin']) && $val['linkdin']!=""): ?>
                                                        <li><a href="<?php echo $val['linkdin']; ?>" target="_blank" ><span class="icon-linkedin-square"></span></a></li>
                                                    <?php endif; ?>

                                                    <?php if(isset($val['instagram']) && $val['instagram']!=""): ?>
                                                        <li><a href="<?php echo $val['instagram']; ?>" target="_blank" ><span class="icon-instagram"></span></a></li>
                                                    <?php endif; ?>

                                                    <?php if(isset($val['twitter']) && $val['twitter']!=""): ?>
                                                        <li><a href="<?php echo $val['twitter']; ?>" target="_blank" ><span class="icon-twitter-square"></span></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>