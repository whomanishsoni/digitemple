<?php
include VIEWPATH . 'admin/header.php';
$cause_title = isset($app_causes['title']) ? $app_causes['title'] : set_value('title');
$description = isset($app_causes['description']) ? $app_causes['description'] : set_value('description');
$target_amount = isset($app_causes['target_amount']) ? $app_causes['target_amount'] : set_value('target_amount');
$id = isset($app_causes['id']) ? $app_causes['id'] : set_value('id');

$status = isset($app_causes['status']) ? $app_causes['status'] : 'A';
$logo_check=false;
if (isset($app_causes['image']) && $app_causes['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_causes['image'])) {
        $logo_check = true;
        $image_path = base_url() . uploads_path . '/' . $app_causes['image'];
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
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-causes'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('causes') ?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header"><?php echo $title; ?></div>
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post");
                        echo form_open_multipart('admin/save-causes', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <input type="hidden" name="old_image" value="<?php echo isset($app_causes['image']) ? $app_causes['image'] : ""; ?>"/>
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
                                    <label for="title"><?php echo dt_translate('target')." ".dt_translate('amount'); ?><small class="required">*</small></label>
                                    <div>
                                        <input type="number" min="1" maxlength="10" tabindex="3" required="" autocomplete="off" value="<?php echo isset($target_amount) ? $target_amount : ""; ?>" class="form-control" id="target_amount" name="target_amount" placeholder="<?php echo dt_translate('target')." ".dt_translate('amount'); ?>">
                                        <?php echo form_error('target_amount'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo dt_translate('status'); ?><small class="required">*</small></label>
                                    <div class="form-inline">
                                        <?php
                                        $active = $inactive = $completed='';
                                        if ($status == "I") {
                                            $inactive = "checked";
                                        }elseif ($status == "C") {
                                            $completed = "checked";
                                        } else {
                                            $active = "checked";
                                        }

                                        ?>

                                        <?php if($status=='C'): ?>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input name='status' value="C" class="custom-control-input" type='radio' id='completed' <?php echo $completed; ?>>
                                                <label class="custom-control-label" for="customRadioInline1"><?php echo dt_translate('completed'); ?></label>
                                            </div>
                                        <?php else: ?>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input name='status' class="custom-control-input" value="A" type='radio' id='active' <?php echo $active; ?>>
                                                <label class="custom-control-label" for="active"><?php echo dt_translate('active'); ?></label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" name='status' type='radio'  value='I' id='inactive' <?php echo $inactive; ?>>
                                                <label class="custom-control-label" for="inactive"><?php echo dt_translate('inactive'); ?></label>
                                            </div>
                                        <?php endif;?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo dt_translate('image'); ?><small class="required">*</small></label>
                                    <div class="file-field mb-2">
                                        <input class="form-control" onchange="readURL(this)" id="imageurl" <?php if ($logo_check == false) echo "required"; ?>  type="file" name="cause_image" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                    </div>
                                    <img id="imageurl" height="100"  src="<?php echo $image_path; ?>" alt="Image" >
                                    <?php echo form_error('about_image'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>


                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a tabindex="10" href="<?php echo base_url('admin/manage-causes'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                                    <button tabindex="9" type="submit" class="btn btn-primary" name="Save" value="Save">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <?php echo dt_translate('save') ?>
                                    </button>
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
<link href="<?php echo base_url('assets/plugin/summernote/summernote.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/plugin/summernote/summernote.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/summernote_custom.js'); ?>" type="application/javascript"></script>
