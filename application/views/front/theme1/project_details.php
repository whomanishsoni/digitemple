<?php
include VIEWPATH . 'front/theme1/header.php';
//Banner Content
$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('project_background');
$banner_image_path = base_url() . img_path . "/project.jpg";

if (isset($banner_content) && $banner_content!= "") {
    if (file_exists(FCPATH .uploads_path.'/'.$banner_content)) {
        $banner_image_path = base_url() . uploads_path . '/' .$banner_content;
    }
}
$news_image_path="";
if (isset($app_project['image']) && $app_project['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_project['image'])) {
        $news_image_path = base_url() . uploads_path . '/' . $app_project['image'];
    }
}


?>
<?php if(isset($is_breadcrumb_enabled) && $is_breadcrumb_enabled=="N"): ?>
    <div class="hero-wrap" style="background-image: url('<?php echo $banner_image_path; ?>');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><a href="<?php echo base_url('projects'); ?>"><?php echo dt_translate('projects') ?></a></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $app_project['title']; ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container padding_top_7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('news'); ?>"><?php echo dt_translate('projects') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo escape_data($app_project['title']); ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate">
                    <h2 class="mb-3"><?php echo $app_project['title']; ?></h2>
                    <?php if(isset($news_image_path) && $news_image_path!=""): ?>
                        <img src="<?php echo $news_image_path; ?>" class="img-fluid" />
                    <?php endif; ?>
                    <hr/>
                    <p><?php echo $app_project['description']; ?></p>
                    <div class="commentbox"></div>
                </div> <!-- .col-md-8 -->
                <div class="col-md-4 sidebar ftco-animate">
                    <div class="sidebar-box ftco-animate">
                        <h3><?php echo dt_translate('project'); ?></h3>
                        <?php foreach ($recent_projects as $rprojects):
                            if (isset($rprojects['image']) && $rprojects['image']!= "") {
                                if (file_exists(FCPATH .uploads_path.'/'. $rprojects['image'])) {
                                    $nimage_path = base_url() . uploads_path . '/' . $rprojects['image'];
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
                                    <h3 class="heading"><a href="<?php echo base_url('project-details/'.$rprojects['id']); ?>"><?php echo escape_data($rprojects['title']); ?></a></h3>
                                    <div class="meta">
                                        <div><a href="<?php echo base_url('project-details/'.$rprojects['id']); ?>"><span class="icon-calendar"></span> <?php echo date('M d, Y',strtotime($rprojects['created_on'])); ?></a></div>
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