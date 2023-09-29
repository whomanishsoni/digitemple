<?php
include VIEWPATH . 'admin/header.php';
$name = isset($app_team['name']) ? $app_team['name'] : set_value('name');
$designation = isset($app_team['designation']) ? $app_team['designation'] : set_value('designation');
$facebook = isset($app_team['facebook']) ? $app_team['facebook'] : set_value('facebook');
$linkdin = isset($app_team['linkdin']) ? $app_team['linkdin'] : set_value('linkdin');
$instagram = isset($app_team['instagram']) ? $app_team['instagram'] : set_value('instagram');
$twitter = isset($app_team['twitter']) ? $app_team['twitter'] : set_value('twitter');

$image = isset($app_team['image']) ? $app_team['image'] : set_value('image');
$id = isset($app_team['id']) ? $app_team['id'] : set_value('id');

$status = isset($app_team['status']) ? $app_team['status'] : 'A';
$logo_check=false;
if (isset($app_team['image']) && $app_team['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_team['image'])) {
        $logo_check = true;
        $image_path = base_url() . uploads_path . '/' . $app_team['image'];
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
                        echo form_open_multipart('admin/save-team', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <input type="hidden" name="old_image" value="<?php echo isset($app_team['image']) ? $app_team['image'] : ""; ?>"/>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('name') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="text" tabindex="1" required="" autocomplete="off" value="<?php echo isset($name) ? $name : ""; ?>" class="form-control" id="name" name="name" placeholder="<?php echo dt_translate('name') ?>">
                                        <?php echo form_error('name'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('designation') ?><small class="required">*</small></label>
                                    <div>
                                        <input type="text" tabindex="2" required="" autocomplete="off" value="<?php echo isset($designation) ? $designation : ""; ?>" class="form-control" id="designation" name="designation" placeholder="<?php echo dt_translate('designation') ?>">
                                        <?php echo form_error('designation'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h5><?php echo dt_translate('social_link'); ?></h5>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Facebook</label>
                                    <div>
                                        <input type="url" tabindex="3"  autocomplete="off" value="<?php echo isset($facebook) ? $facebook : ""; ?>" class="form-control" id="facebook" name="facebook" placeholder="Facebook">
                                        <?php echo form_error('facebook'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Twitter</label>
                                    <div>
                                        <input type="url" tabindex="4" autocomplete="off" value="<?php echo isset($twitter) ? $twitter : ""; ?>" class="form-control" id="twitter" name="twitter" placeholder="Twitter">
                                        <?php echo form_error('twitter'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">LinkedIn</label>
                                    <div>
                                        <input type="url" tabindex="5" autocomplete="off" value="<?php echo isset($linkdin) ? $linkdin : ""; ?>" class="form-control" id="linkdin" name="linkdin" placeholder="Linkdin">
                                        <?php echo form_error('linkdin'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Instagram</label>
                                    <div>
                                        <input type="url" tabindex="6" autocomplete="off" value="<?php echo isset($instagram) ? $instagram : ""; ?>" class="form-control" id="instagram" name="instagram" placeholder="Instagram">
                                        <?php echo form_error('instagram'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-3">
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
                                        &nbsp;
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" name='status' type='radio'  value='I' id='inactive'  <?php echo $inactive; ?>>
                                            <label class="custom-control-label"  for='inactive'><?php echo dt_translate('inactive'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo dt_translate('image'); ?><small class="required">*</small></label>

                                    <div class="file-field mb-3">
                                        <input onchange="readURL(this)" id="imageurl" <?php if ($logo_check == false) echo "required"; ?>  type="file" name="team_image" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                    </div>
                                    <img id="imageurl" height="100"  src="<?php echo $image_path; ?>" alt="Image">
                                    <?php echo form_error('about_image'); ?>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a tabindex="10" href="<?php echo base_url('admin/manage-team'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
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