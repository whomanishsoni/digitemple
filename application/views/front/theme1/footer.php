<?php
$app_site_setting=dt_app_site_setting();
?>
<footer class="ftco-footer img">
    <div class="overlay"></div>
    <div class="container">
        <div class="row mb-0">
            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <div class="block-23 mb-3">
                        <ul>
                            <?php if(isset($app_site_setting['company_address']) && $app_site_setting['company_address']!=""): ?>
                                <li><span class="icon icon-map-marker"></span><span class="text"><?php echo $app_site_setting['company_address']; ?></span></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="ftco-footer-widget mb-4">
                    <div class="block-23 mb-3">
                        <ul>
                            <?php if(isset($app_site_setting['company_phone']) && $app_site_setting['company_phone']!=""): ?>
                                <li><a href="tel:<?php echo $app_site_setting['company_phone']; ?>"><span class="icon icon-phone"></span><span class="text"><?php echo $app_site_setting['company_phone']; ?></span></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <div class="block-23 mb-3">
                        <ul>
                            <?php if(isset($app_site_setting['company_email']) && $app_site_setting['company_email']!=""): ?>
                            <li><a href="mailto:<?php echo $app_site_setting['company_email']; ?>"><span class="icon icon-envelope"></span><span class="text"><?php echo $app_site_setting['company_email']; ?></span></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <div class="ftco-footer-widget mb-4">
                        <ul class="ftco-footer-social list-unstyled mt-1">
                            <?php if(isset($app_site_setting['fb_link']) && $app_site_setting['fb_link']!=""): ?>
                                <li class="ftco-animate"><a href="<?php echo $app_site_setting['fb_link']; ?>" target="_blank"><span class="icon-facebook"></span></a></li>
                            <?php endif; ?>

                            <?php if(isset($app_site_setting['twitter_link']) && $app_site_setting['twitter_link']!=""): ?>
                                <li class="ftco-animate"><a href="<?php echo $app_site_setting['twitter_link']; ?>" target="_blank"><span class="icon-twitter"></span></a></li>
                            <?php endif; ?>

                            <?php if(isset($app_site_setting['insta_link']) && $app_site_setting['insta_link']!=""): ?>
                                <li class="ftco-animate"><a href="<?php echo $app_site_setting['insta_link']; ?>" target="_blank"><span class="icon-instagram"></span></a></li>
                            <?php endif; ?>

                            <?php if(isset($app_site_setting['linkdin_link']) && $app_site_setting['linkdin_link']!=""): ?>
                                <li class="ftco-animate"><a href="<?php echo $app_site_setting['linkdin_link']; ?>" target="_blank"><span class="icon-linkedin"></span></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr_border"/>
        <div class="row">
            <?php
            $privacy_status=dt_get_cms_page_status('privacy');
            $terms_status=dt_get_cms_page_status('terms');
            ?>
            <div class="col-md-6">
                <p>&COPY; <?php echo date('Y') . " " . dt_get_CompanyName(); ?>. <?php echo dt_translate('rights_reserved_message') ?></p>
            </div>
            <div class="col-md-6">
                <ul class="nav float-right">
                    <?php if(isset($privacy_status['status']) && $privacy_status['status']=='A'): ?>
                    <li class="nav-item mr-3"><a href="<?php echo base_url('privacy-policy'); ?>"><?php echo dt_translate('privacy_policy') ?></a></li>
                    <?php endif; ?>

                    <?php if(isset($terms_status['status']) && $terms_status['status']=='A'): ?>
                    <li class="nav-item"><a href="<?php echo base_url('terms-and-conditions'); ?>"><?php echo dt_translate('terms_and_conditions') ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
    </svg>
</div>
<script type="text/javascript"  src="<?php echo base_url('assets/global/js/jquery-3.4.1.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/global/js/popper.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/global/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/global/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/jquery.easing.1.3.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/jquery.waypoints.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/jquery.stellar.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/jquery.magnific-popup.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/aos.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/jquery.animateNumber.min.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/scrollax.min.js'); ?>"></script>
<?php if(dt_get_content('comment_project_id')!=""): ?>
    <script src="https://unpkg.com/commentbox.io/dist/commentBox.min.js"></script>
<?php endif; ?>
<script type="text/javascript"  src="<?php echo base_url('assets/theme1/js/main.js'); ?>"></script>

</body>
</html>