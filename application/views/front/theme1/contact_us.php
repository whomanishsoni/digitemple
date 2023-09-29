<?php
include VIEWPATH . 'front/theme1/header.php';

$app_site_setting=dt_app_site_setting();
//Banner Content
$is_breadcrumb_enabled=dt_get_content('is_breadcrumb_enabled');
$banner_content=dt_get_content_image('contact_us_background');
$banner_image_path = base_url() . img_path . "/contact_us.jpg";

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
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></span> <span><?php echo dt_translate('contact_us') ?></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo dt_translate('contact_us') ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div id="success"></div>
<?php else: ?>
    <div class="container padding_top_7"  id="success">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_background">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('contact_us') ?></li>
            </ol>
        </nav>
    </div>
<?php endif; ?>


    <section class="ftco-section contact-section ftco-degree-bg">
        <div class="container" >
            <?php $this->load->view('message'); ?>
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-4">
                    <h2 class="h4"><?php echo dt_translate('contact_information'); ?></h2>
                </div>
                <div class="w-100"></div>

                <?php if(isset($app_site_setting['company_address']) && $app_site_setting['company_address']!=""):?>
                    <div class="col-md-3">
                        <p><span><?php echo dt_translate('address'); ?>:</span> <?php echo $app_site_setting['company_address']; ?></p>
                    </div>
                <?php endif; ?>

                <?php if(isset($app_site_setting['company_phone']) && $app_site_setting['company_phone']!=""):?>
                    <div class="col-md-3">
                        <p><span><?php echo dt_translate('phone'); ?>:</span> <a href="tel:<?php echo $app_site_setting['company_phone']; ?>"><?php echo $app_site_setting['company_phone']; ?></a></p>
                    </div>
                <?php endif; ?>

                <?php if(isset($app_site_setting['company_email']) && $app_site_setting['company_email']!=""):?>
                    <div class="col-md-3">
                        <p><span><?php echo dt_translate('email'); ?>:</span> <a href="mailto:<?php echo $app_site_setting['company_email']; ?>"><?php echo $app_site_setting['company_email']; ?></a></p>
                    </div>
                <?php endif; ?>

            </div>
            <div class="row block-9">
                <div class="col-md-12 pr-md-5">
                    <h4 class="mb-4"><?php echo dt_translate('contact_us_title'); ?></h4>
                    <?php
                    $attributes = array('id' => 'contact_us_form', 'name' => 'contact_us_form', 'method' => "post");
                    echo form_open_multipart('save-contact-us', $attributes);
                    ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input autocomplete="off" type="text" required class="form-control" name="name" placeholder="<?php echo dt_translate('name'); ?>">
                                    <?php echo form_error('name'); ?>
                                </div>
                                <div class="form-group">
                                    <input autocomplete="off" type="email" required class="form-control" name="email" placeholder="<?php echo dt_translate('email'); ?>">
                                    <?php echo form_error('email'); ?>
                                </div>
                                <div class="form-group">
                                    <input autocomplete="off" type="text" required class="form-control" name="subject" placeholder="<?php echo dt_translate('subject'); ?>">
                                    <?php echo form_error('subject'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="message" id="message" required cols="5" rows="7" class="form-control" placeholder="<?php echo dt_translate('message'); ?>"></textarea>
                                    <?php echo form_error('message'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="button" onclick="submit_contact_form()" value="<?php echo dt_translate('submit'); ?>" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>
<?php
include VIEWPATH . 'validation_js_message.php';
?>
<script src="<?php echo base_url('assets/global/js/front_custom.js'); ?>"></script>
