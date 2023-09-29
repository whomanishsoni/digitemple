<?php
include VIEWPATH . 'admin/header.php';

$logo_check=false;
if (isset($app_content['image']) && $app_content['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_content['image'])) {
        $logo_check = true;
        $image_path = base_url() . uploads_path . '/' . $app_content['image'];
    } else {
        $image_path = base_url() . img_path . "/about_us.jpg";
    }
} else {
    $image_path = base_url() . img_path . "/about_us.jpg";
}

if(isset($app_content['details']) && $app_content['details']!=""){
    $details=json_decode($app_content['details']);
}else{
    $details=array();
}

$title_one=isset($details[0])?$details[0]:"";
$title_two=isset($details[1])?$details[1]:"";
$title_three=isset($details[2])?$details[2]:"";

?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-home-content'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('website') ?></a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <?php include VIEWPATH . 'admin/website/topbar.php';?>
                <div class="card">
                    <div class="card-header">
                        <?php echo dt_translate('update'); ?> <?php echo dt_translate('about_us')." ".dt_translate('content'); ?>
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <?php echo form_open_multipart('admin/manage-about-us-action', array('name' => 'Save_Form', 'id' => 'Save_Form')); ?>
                        <input  type="hidden" name="old_image" value="<?php echo isset($app_content['image'])?$app_content['image']:""; ?>"/>
                        <div class="row setup-content-2" id="step-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('image'); ?> (<?php echo dt_translate('about_image_size'); ?>)</strong></label>
                                            <div class="col-md-6">
                                                <img id="imageurl" class="img-fluid height_100"  src="<?php echo $image_path; ?>" alt="Image" >
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <input onchange="readURL(this)" class="form-control" id="imageurl" type="file" name="about_image" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                            </div>
                                            <?php echo form_error('about_image'); ?>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('title') . ' 1 ', 'title_two', array('class' => 'control-label')); ?>
                                            <textarea required="" name="title[]" id='title_one' placeholder="<?php echo dt_translate('title')." 1"; ?>" class="form-control"><?php echo $title_one; ?></textarea>
                                            <?php echo form_error('title'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('title') . ' 2 ', 'title_two', array('class' => 'control-label')); ?>
                                            <textarea required="" name="title[]" id='title_two' placeholder="<?php echo dt_translate('title')." 2"; ?>" class="form-control"><?php echo $title_two; ?></textarea>
                                            <?php echo form_error('title'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('title') . ' 3 ', 'title_three', array('class' => 'control-label')); ?>
                                            <textarea required="" name="title[]" id='title_three' placeholder="<?php echo dt_translate('title')." 3"; ?>" class="form-control"><?php echo $title_three; ?></textarea>
                                            <?php echo form_error('title'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a tabindex="10" href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                                            <button tabindex="9" type="submit" class="btn btn-primary" name="Save" value="Save">
                                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                <?php echo dt_translate('save') ?></button>
                                        </div>
                                    </div>

                                </div>
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