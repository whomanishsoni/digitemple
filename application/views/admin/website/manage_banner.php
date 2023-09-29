<?php
include VIEWPATH . 'admin/header.php';

$logo_check=false;

$home_background_path = base_url() . img_path . "/home_banner.jpg";
$about_us_background_path = base_url() . img_path . "/about_us.jpg";
$team_background_path = base_url() . img_path . "/team.jpg";
$causes_background_path = base_url() . img_path . "/causes.jpg";
$news_background_path = base_url() . img_path . "/news.jpg";
$gallery_background_path = base_url() . img_path . "/gallery.jpg";
$contact_us_background_path = base_url() . img_path . "/contact_us.jpg";
$donation_background_path = base_url() . img_path . "/donation.jpg";
$event_background_path = base_url() . img_path . "/event.jpg";
$project_background_path = base_url() . img_path . "/project.jpg";


if (isset($event_background['image']) && $event_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $event_background['image'])) {
        $logo_check = true;
        $event_background_path = base_url() . uploads_path . '/' . $event_background['image'];
    }
}

if (isset($project_background['image']) && $project_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $project_background['image'])) {
        $logo_check = true;
        $project_background_path = base_url() . uploads_path . '/' . $project_background['image'];
    }
}

if (isset($home_background['image']) && $home_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $home_background['image'])) {
        $logo_check = true;
        $home_background_path = base_url() . uploads_path . '/' . $home_background['image'];
    }
}

if (isset($about_us_background['image']) && $about_us_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $about_us_background['image'])) {
        $logo_check = true;
        $about_us_background_path = base_url() . uploads_path . '/' . $about_us_background['image'];
    }
}

if (isset($team_background['image']) && $team_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $team_background['image'])) {
        $logo_check = true;
        $team_background_path = base_url() . uploads_path . '/' . $team_background['image'];
    }
}

if (isset($causes_background['image']) && $causes_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $causes_background['image'])) {
        $logo_check = true;
        $causes_background_path = base_url() . uploads_path . '/' . $causes_background['image'];
    }
}

if (isset($news_background['image']) && $news_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $news_background['image'])) {
        $logo_check = true;
        $news_background_path = base_url() . uploads_path . '/' . $news_background['image'];
    }
}

if (isset($gallery_background['image']) && $gallery_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $gallery_background['image'])) {
        $logo_check = true;
        $gallery_background_path = base_url() . uploads_path . '/' . $gallery_background['image'];
    }
}

if (isset($contact_us_background['image']) && $contact_us_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $contact_us_background['image'])) {
        $logo_check = true;
        $contact_us_background_path = base_url() . uploads_path . '/' . $contact_us_background['image'];
    }
}

if (isset($donation_background['image']) && $donation_background['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $donation_background['image'])) {
        $logo_check = true;
        $donation_background_path = base_url() . uploads_path . '/' . $donation_background['image'];
    }
}

$is_banner_enabled = isset($is_banner_enabled['details']) ? $is_banner_enabled['details'] : 'N';
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
                        <?php echo dt_translate('update'); ?> <?php echo dt_translate('banner_image'); ?>
                    </div>
                    <div class="card-body">

                        <?php $this->load->view('message'); ?>
                        <?php echo form_open_multipart('admin/save-banner', array('name' => 'Save_Form', 'id' => 'Save_Form')); ?>
                        <input  type="hidden" name="old_home_background" value="<?php echo isset($home_background['image'])?$home_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_about_us_background" value="<?php echo isset($about_us_background['image'])?$about_us_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_team_background" value="<?php echo isset($team_background['image'])?$team_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_causes_background" value="<?php echo isset($causes_background['image'])?$causes_background['image']:""; ?>"/>

                        <input  type="hidden" name="old_news_background" value="<?php echo isset($news_background['image'])?$news_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_gallery_background" value="<?php echo isset($gallery_background['image'])?$gallery_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_contact_us_background" value="<?php echo isset($contact_us_background['image'])?$contact_us_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_donation_background" value="<?php echo isset($donation_background['image'])?$donation_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_event_background" value="<?php echo isset($event_background['image'])?$event_background['image']:""; ?>"/>
                        <input  type="hidden" name="old_project_background" value="<?php echo isset($project_background['image'])?$project_background['image']:""; ?>"/>

                        <div class="row setup-content-2" id="step-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group form-inline">
                                            <?php
                                            $active = $inactive = '';
                                            if ($is_banner_enabled == "N") {
                                                $inactive = "checked";
                                            } else {
                                                $active = "checked";
                                            }
                                            ?>
                                            <label class="mr-3">Do you want to show breadcrumb instead of banner on pages?</label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input  class="custom-control-input" name='is_banner_enabled' value="Y" type='radio'  id='is_banner_enabled_yes' <?php echo $active; ?>>
                                                <label class="custom-control-label" for="is_banner_enabled_yes"><?php echo dt_translate('yes'); ?></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" name='is_banner_enabled' type='radio' value='N' id='is_banner_enabled_no'  <?php echo $inactive; ?>>
                                                <label class="custom-control-label" for='is_banner_enabled_no'><?php echo dt_translate('no'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="banner_div_id">
                                    <div class="col-12 mb-4">
                                        <div class="alert alert-info">
                                            <?php echo dt_translate('banner_size'); ?>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('home')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $home_background_path; ?>" target="_blank">
                                                    <img id="home_background" height="178" class="width_100"  src="<?php echo $home_background_path; ?>" alt="Image">
                                                </a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control" onchange="preview_banner_image(this)"  data-nm="home_background"   type="file" name="home_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('home_background'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('about_us')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $about_us_background_path; ?>" target="_blank"><img id="about_us_background"  height="178"  class="width_100"  src="<?php echo $about_us_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"  data-nm="about_us_background"   type="file" name="about_us_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('about_us_background'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('causes')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $causes_background_path; ?>" target="_blank"><img id="causes_background"  height="178"  class="width_100"  src="<?php echo $causes_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"  data-nm="causes_background"   type="file" name="causes_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('causes_background'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('news')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $news_background_path; ?>" target="_blank"><img id="news_background" height="178"  class="width_100"  src="<?php echo $news_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"  data-nm="news_background"   type="file" name="news_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('news_background'); ?>
                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('gallery')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $gallery_background_path; ?>" target="_blank"><img id="gallery_background" height="178"  class="width_100"  src="<?php echo $gallery_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)" data-nm="gallery_background"   type="file" name="gallery_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('gallery_background'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('team')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $team_background_path; ?>" target="_blank"><img id="team_background" height="178"  class="width_100"  src="<?php echo $team_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"  data-nm="team_background"   type="file" name="team_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('team_background'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('contact_us')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $contact_us_background_path; ?>" target="_blank"><img id="contact_us_background" height="178"  class="width_100"  src="<?php echo $contact_us_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"   data-nm="contact_us_background"   type="file" name="contact_us_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('contact_us_background'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('event')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $event_background_path; ?>" target="_blank"><img id="event_background" height="178"  class="width_100"  src="<?php echo $event_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"   data-nm="event_background" type="file" name="event_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('event_background'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('project')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $project_background_path; ?>" target="_blank"><img id="project_background" height="178"  class="width_100"  src="<?php echo $project_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"   data-nm="project_background" type="file" name="project_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('project_background'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong><?php echo dt_translate('donation')." ".dt_translate('banner_image'); ?></strong></label>
                                            <div class="col-md-12">
                                                <a href="<?php echo $donation_background_path; ?>" target="_blank"><img id="donation_background" height="178"  class="width_100"  src="<?php echo $donation_background_path; ?>" alt="Image"></a>
                                            </div>
                                            <br/>
                                            <div class="file-field">
                                                <div class="">
                                                    <input class="form-control"  onchange="preview_banner_image(this)"  data-nm="donation_background"   type="file" name="donation_background" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                            </div>
                                            <?php echo form_error('donation_background'); ?>
                                            <small>(<?php echo dt_translate('about_image_size'); ?>)</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
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
