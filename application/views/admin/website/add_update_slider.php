<?php
include VIEWPATH . 'admin/header.php';
$id = isset($app_slider['id']) ? $app_slider['id'] : set_value('id');
$status = isset($app_slider['status']) ? $app_slider['status'] : 'A';
$slider_title = isset($app_slider['title']) ? $app_slider['title'] : '';
$sub_title = isset($app_slider['sub_title']) ? $app_slider['sub_title'] : '';

$logo_check=false;
if (isset($app_slider['image']) && $app_slider['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_slider['image'])) {
        $logo_check = true;
        $image_path = base_url() . uploads_path . '/' . $app_slider['image'];
    } else {
        $image_path = base_url() . img_path . "/no-image.png";
    }
} else {
    $image_path = base_url() . img_path . "/no-image.png";
}

?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/manage-home-content'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('website') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-slider'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('slider') ?></a></li>
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
                        echo form_open_multipart('admin/save-slider', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <input type="hidden" name="old_image" value="<?php echo isset($app_slider['image']) ? $app_slider['image'] : ""; ?>"/>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="title"><?php echo dt_translate('title') ?></label>
                                    <div>
                                        <input autofocus type="text" tabindex="1"  autocomplete="off" value="<?php echo isset($slider_title) ? $slider_title : ""; ?>" class="form-control" id="title" name="title" placeholder="<?php echo dt_translate('title') ?>">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="sub_title"><?php echo dt_translate('sub_title') ?></label>
                                    <div>
                                        <input autofocus type="text" tabindex="1" autocomplete="off" value="<?php echo isset($sub_title) ? $sub_title : ""; ?>" class="form-control" id="sub_title" name="sub_title" placeholder="<?php echo dt_translate('sub_title') ?>">
                                        <?php echo form_error('sub_title'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo dt_translate('image'); ?><small class="required">*</small></label>
                                    <div class="file-field">
                                        <input class="form-control" onchange="readURL(this)" id="imageurl" <?php if ($logo_check == false) echo "required"; ?>  type="file" name="slider_image" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                    </div>
                                    <br/>
                                    <div class="col-md-6">
                                        <img id="imageurl" class="img-fluid height_100" src="<?php echo $image_path; ?>" alt="Image">
                                    </div>
                                    <?php echo form_error('slider_image'); ?>
                                </div>
                            </div>

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
                                    <a tabindex="10" href="<?php echo base_url('admin/manage-slider'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
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