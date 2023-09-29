<?php
include VIEWPATH . 'admin/header.php';
$cause_title = isset($app_events['title']) ? escape_data($app_events['title']) : set_value('title');
$description = isset($app_events['description']) ? $app_events['description']: set_value('description');
$event_time = isset($app_events['event_time']) ? $app_events['event_time']: set_value('event_time');
$event_date = isset($app_events['event_date']) ? $app_events['event_date']: set_value('event_date');
$event_venue = isset($app_events['event_venue']) ? $app_events['event_venue']: set_value('event_venue');
$id = isset($app_events['event_id']) ? $app_events['event_id'] : set_value('event_id');
$status = isset($app_events['status']) ? $app_events['status'] : 'A';

$logo_check=false;
if (isset($app_events['image']) && $app_events['image']!= "") {
    if (file_exists(FCPATH .uploads_path.'/'. $app_events['image'])) {
        $logo_check = true;
        $image_path = base_url() . uploads_path . '/' . $app_events['image'];
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
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-events'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('events') ?></a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header"><?php echo $title; ?></div>
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post");
                        echo form_open_multipart('admin/save-event', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <input type="hidden" name="old_image" value="<?php echo isset($app_events['image']) ? $app_events['image'] : ""; ?>"/>
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
                                    <label for="title"><?php echo dt_translate('event')." ".dt_translate('date'); ?><small class="required">*</small></label>
                                    <input type="date" min="<?php echo date('Y-m-d'); ?>" tabindex="0" required="" autocomplete="off" value="<?php echo isset($event_date) ? $event_date : ""; ?>" class="form-control" id="event_date" name="event_date" placeholder="<?php echo dt_translate('event')." ".dt_translate('date'); ?>">
                                    <?php echo form_error('event_date'); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('event')." ".dt_translate('time'); ?><small class="required">*</small></label>
                                    <input type="time" tabindex="0" required="" autocomplete="off" value="<?php echo isset($event_time) ? $event_time : ""; ?>" class="form-control" id="event_time" name="event_time" placeholder="<?php echo dt_translate('event')." ".dt_translate('time'); ?>">
                                    <?php echo form_error('event_time'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('event')." ".dt_translate('venue'); ?><small class="required">*</small></label>
                                    <input type="text" tabindex="0" required="" autocomplete="off" value="<?php echo isset($event_venue) ? $event_venue : ""; ?>" class="form-control" id="event_venue" name="event_venue" placeholder="<?php echo dt_translate('event')." ".dt_translate('venue'); ?>">
                                    <?php echo form_error('event_venue'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo dt_translate('image'); ?><small class="required">*</small></label>
                                    <div class="file-field mb-2">
                                        <input class="form-control" onchange="readURL(this)" id="imageurl" <?php if ($logo_check == false) echo "required"; ?>  type="file" name="event_image" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                    </div>
                                    <img id="imageurl" height="100"  src="<?php echo $image_path; ?>" alt="Image">
                                    <?php echo form_error('about_image'); ?>
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
                                    <a tabindex="10" href="<?php echo base_url('admin/manage-events'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
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
?><link href="<?php echo base_url('assets/plugin/summernote/summernote.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/plugin/summernote/summernote.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/summernote_custom.js'); ?>" type="application/javascript"></script>