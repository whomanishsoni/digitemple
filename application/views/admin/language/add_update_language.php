<?php
include VIEWPATH . 'admin/header.php';
$title = (set_value("title")) ? set_value("title") : (!empty($language_data) ? escape_data($language_data['title']) : '');
$status = (set_value("status")) ? set_value("status") : (!empty($language_data) ? $language_data['status'] : '');
$id = (set_value("id")) ? set_value("id") : (!empty($language_data) ? $language_data['id'] : 0);
?>

<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/language'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('language') ?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('language'); ?>
                    </div>
                    <div class="card-body">
                        <?php
                        echo form_open_multipart('admin/save-language', array('name' => 'LanguageForm', 'id' => 'LanguageForm'));
                        echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => $id));
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name"> <?php echo dt_translate('title'); ?><small class="required">*</small></label>
                                    <input type="text" autocomplete="off" id="title" name="title" required="" value="<?php echo $title; ?>" class="form-control" placeholder="<?php echo dt_translate('title'); ?>">
                                    <?php echo form_error('title'); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><?php echo dt_translate('status'); ?><small class="required">*</small></label>
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

                        <div class="form-group mb-0">
                            <a href="<?php echo base_url('admin/language'); ?>" class="btn btn-info waves-effect"><?php echo dt_translate('cancel'); ?></a>
                            <button type="submit" class="btn btn-primary waves-effect">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span><?php echo dt_translate('save'); ?></button>
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
