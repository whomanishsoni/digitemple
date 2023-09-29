<?php
include VIEWPATH . 'admin/header.php';
$cause_title = isset($app_cms_page['title']) ? escape_data($app_cms_page['title']) : set_value('title');
$description = isset($app_cms_page['description']) ? $app_cms_page['description']: set_value('description');
$id = isset($app_cms_page['id']) ? $app_cms_page['id'] : set_value('id');
$status = isset($app_cms_page['status']) ? $app_cms_page['status'] : 'A';
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/manage-home-content'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('website') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-team'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('team') ?></a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <?php include VIEWPATH . 'admin/website/topbar.php';?>
                <div class="card">
                    <div class="card-header"><?php echo $title; ?></div>
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post");
                        echo form_open_multipart('admin/save-page', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('title') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="text" tabindex="1" required="" autocomplete="off" value="<?php echo isset($cause_title) ? $cause_title : ""; ?>" class="form-control" id="title" name="title" placeholder="<?php echo dt_translate('title') ?>">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('description') ?><small class="required">*</small></label>
                                    <div>
                                        <textarea type="text" tabindex="2" required="" autocomplete="off" class="form-control" id="summornote_div_id" name="description" placeholder="<?php echo dt_translate('description') ?>"><?php echo $description; ?></textarea>
                                        <?php echo form_error('description'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo dt_translate('status'); ?><small class="required">*</small></label>
                                    <div class="form-inline">
                                        <?php
                                        $active = $inactive = '';
                                        if ($status == "I") {
                                            $inactive = "checked";
                                        } else {
                                            $active = "checked";
                                        }
                                        ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" name='status' value="A" type='radio' id='active'   <?php echo $active; ?>>
                                            <label class="custom-control-label"  for="active"><?php echo dt_translate('active'); ?></label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" name='status' type='radio'  value='I' id='inactive'  <?php echo $inactive; ?>>
                                            <label class="custom-control-label"  for='inactive'><?php echo dt_translate('inactive'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a tabindex="10" href="<?php echo base_url('admin/manage-pages'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                                    <button tabindex="9" type="submit" class="btn btn-primary" name="Save" value="Save">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <?php echo dt_translate('save') ?></button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>
?><link href="<?php echo base_url('assets/plugin/summernote/summernote.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/plugin/summernote/summernote.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/summernote_custom.js'); ?>" type="application/javascript"></script>
