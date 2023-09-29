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
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/module-setting'); ?>"><?php echo dt_translate('module'); ?></a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <?php include VIEWPATH . 'admin/setting/nav.php';?>

                    <div class="card">

                        <div class="card-header">
                            <?php echo dt_translate('module'); ?>
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <?php echo form_open_multipart('admin/save-module', array('name' => 'site_form', 'id' => 'site_form')); ?>
                            <div class="row setup-content-2" id="step-4">
                                <?php foreach ($app_module_setting as $key=>$module): ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="hidden" name="module_name[<?php echo $key; ?>]" value="<?php echo $module['module']; ?>" />
                                            <div class="mb-2"><?php echo dt_translate($module['module']); ?></div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input value="Y" type="radio" <?php echo ($module['is_enable']=="Y")?"checked":""; ?> id="<?php echo $module['module']."yes"; ?>" name="status[<?php echo $key; ?>]" class="custom-control-input">
                                                <label class="custom-control-label" for="<?php echo $module['module']."yes"; ?>"><?php echo dt_translate('yes'); ?></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input value="N" type="radio" <?php echo ($module['is_enable']=="N")?"checked":""; ?>  id="<?php echo $module['module']."no"; ?>" name="status[<?php echo $key; ?>]" class="custom-control-input">
                                                <label class="custom-control-label" for="<?php echo $module['module']."no"; ?>"><?php echo dt_translate('no'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <a tabindex="5" class="btn btn-warning" href="<?php echo base_url('admin/dashboard'); ?>"><?php echo dt_translate('cancel'); ?></a>
                                    <button tabindex="4" class="btn btn-primary" type="submit">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
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