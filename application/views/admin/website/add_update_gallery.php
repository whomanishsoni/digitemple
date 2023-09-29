<?php
include VIEWPATH . 'admin/header.php';
$id = isset($app_gallery['id']) ? $app_gallery['id'] : set_value('id');
$status = isset($app_gallery['status']) ? $app_gallery['status'] : 'A';
$logo_check=false;
if (isset($app_gallery['image']) && $app_gallery['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_gallery['image'])) {
        $logo_check = true;
        $image_path = base_url() . uploads_path . '/' . $app_gallery['image'];
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
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-gallery'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('gallery') ?></a></li>
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
                        echo form_open_multipart('admin/save-gallery', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <input type="hidden" name="old_image" value="<?php echo isset($app_gallery['image']) ? $app_gallery['image'] : ""; ?>"/>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo dt_translate('image'); ?><small class="required">*</small></label>
                                    <div class="col-md-6">
                                        <img id="imageurl" class="img-fluid height_100" src="<?php echo $image_path; ?>" alt="Image">
                                    </div>
                                    <br/>
                                    <div class="file-field">
                                        <input class="form-control" onchange="readURL(this)" id="imageurl" <?php if ($logo_check == false) echo "required"; ?>  type="file" name="gallery_image" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                    </div>
                                    <?php echo form_error('gallery_image'); ?>
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
                                            <label class="custom-control-label" for="active"><?php echo dt_translate('active'); ?></label>
                                        </div>
                                        &nbsp;
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" name='status' type='radio'  value='I' id='inactive'  <?php echo $inactive; ?>>
                                            <label class="custom-control-label" for='inactive'><?php echo dt_translate('inactive'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a tabindex="10" href="<?php echo base_url('admin/manage-gallery'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
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