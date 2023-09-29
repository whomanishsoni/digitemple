<?php
include VIEWPATH . 'admin/header.php';

$seo_keyword=$seo_keyword['details'];
$google_analytics=$google_analytics['details'];
$seo_description=$seo_description['details'];

?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/seo'); ?>"><?php echo dt_translate('seo'); ?></a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <?php include VIEWPATH . 'admin/setting/nav.php';?>

                    <div class="card">

                        <div class="card-header">
                            <?php echo dt_translate('seo'); ?>
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <?php echo form_open_multipart('admin/save-seo', array('name' => 'site_form', 'id' => 'site_form')); ?>
                            <div class="row setup-content-2" id="step-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('seo_keyword'), 'seo_keyword', array('class' => 'control-label', 'data-error' => 'wrong', 'data-success' => 'right')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'seo_keyword', 'class' => 'form-control validate', 'name' => 'seo_keyword', 'value' => $seo_keyword, 'required' => 'required', 'placeholder' => dt_translate('seo_keyword'))); ?>
                                                <?php echo form_error('seo_keyword'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('seo_description') . '', 'seo_description', array('class' => 'control-label')); ?>
                                                <?php echo form_textarea(array('id' => 'seo_description', 'class' => 'form-control validate', 'name' => 'seo_description', 'type' => 'text', 'rows' => 3, 'value' => $seo_description, 'placeholder' => dt_translate('seo_description'))); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('google_analytics') . '', 'google_analytics', array('class' => 'control-label')); ?>
                                                <?php echo form_textarea(array('id' => 'google_analytics', 'class' => 'form-control validate', 'name' => 'google_analytics', 'type' => 'text', 'rows' => 3, 'value' => $google_analytics, 'placeholder' => dt_translate('google_analytics'))); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a tabindex="5" class="btn btn-warning" href="<?php echo base_url('admin/dashboard'); ?>"><?php echo dt_translate('cancel'); ?></a>
                                    <button tabindex="4" class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <?php echo dt_translate('submit'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include VIEWPATH . 'admin/footer.php';
?>