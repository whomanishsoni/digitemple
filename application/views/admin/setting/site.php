<?php
include VIEWPATH . 'admin/header.php';

$company_name = isset($company_data->company_name) ? $company_data->company_name : set_value('company_name');
$reg_no = isset($company_data->trust_registration_no) ? $company_data->trust_registration_no : set_value('reg_no');
$company_email1 = isset($company_data->company_email) ? $company_data->company_email : set_value('company_email1');
$company_phone1 = isset($company_data->company_phone) ? $company_data->company_phone : set_value('company_phone1');
$company_address1 = isset($company_data->company_address) ? $company_data->company_address : set_value('company_address1');
$language = isset($company_data->language) ? $company_data->language : set_value('language');
$time_zone = isset($company_data->time_zone) ? $company_data->time_zone : set_value('time_zone');
$company_logo = isset($company_data->company_logo) ? $company_data->company_logo : set_value('company_logo');
$time_format = isset($company_data->time_format) ? $company_data->time_format : set_value('time_format');
$fb_link = isset($company_data->fb_link) ? $company_data->fb_link : set_value('fb_link');
$google_link = isset($company_data->google_link) ? $company_data->google_link : set_value('google_link');
$twitter_link = isset($company_data->twitter_link) ? $company_data->twitter_link : set_value('twitter_link');
$insta_link = isset($company_data->insta_link) ? $company_data->insta_link : set_value('insta_link');
$linkdin_link = isset($company_data->linkdin_link) ? $company_data->linkdin_link : set_value('linkdin_link');
$root_dir = FCPATH.uploads_path . '/';

$currency_id = isset($company_data->currency_id) ? $company_data->currency_id : 1;
$currency_position = isset($company_data->currency_position) ? $company_data->currency_position : set_value('currency_position');

$logo_check = false;
$icon_check = false;

if (isset($company_data->company_logo) && $company_data->company_logo != "") {
    if (file_exists($root_dir . $company_data->company_logo)) {
        $logo_check = true;
        $logo_image = base_url() . uploads_path . '/' . $company_data->company_logo;
    } else {
        $logo_image = base_url() . img_path . "/no-image.png";
    }
} else {
    $logo_image = base_url() . img_path . "/no-image.png";
}

if (isset($company_data->fevicon_icon) && $company_data->fevicon_icon != "") {
    if (file_exists($root_dir . $company_data->fevicon_icon)) {
        $icon_check = true;
        $icon_image = base_url() . uploads_path . '/' . $company_data->fevicon_icon;
    } else {
        $icon_image = base_url() . img_path . "/no-image.png";
    }
} else {
    $icon_image = base_url() . img_path . "/no-image.png";
}
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/setting'); ?>"><?php echo dt_translate('site_setting'); ?></a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <?php include VIEWPATH . 'admin/setting/nav.php';?>
                    <div class="card">

                        <div class="card-header">
                            <?php echo dt_translate('site_setting'); ?>
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <?php echo form_open_multipart('admin/save-sitesetting', array('name' => 'site_form', 'id' => 'site_form')); ?>
                            <input  type="hidden" name="old_logo_image" value="<?php echo isset($company_data->company_logo)?$company_data->company_logo:""; ?>"/>
                            <input  type="hidden" name="old_favicon_image" value="<?php echo isset($company_data->fevicon_icon)?$company_data->fevicon_icon:"" ; ?>"/>
                            <div class="row setup-content-2" id="step-4">
                                <div class="col-md-12">
                                    <h5 class="font-bold pl-0 my-4"><?php echo dt_translate('company'); ?> <?php echo dt_translate('information'); ?></h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('site_name') . '<small class ="required">*</small>', 'company_name', array('class' => 'control-label', 'data-error' => 'wrong', 'data-success' => 'right')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'company_name', 'class' => 'form-control validate', 'name' => 'company_name', 'value' => $company_name, 'required' => 'required', 'placeholder' => dt_translate('site_name'))); ?>
                                                <?php echo form_error('company_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('site_email') . '<small class ="required">*</small>', 'company_email1', array('class' => 'control-label')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'company_email1', 'class' => 'form-control validate', 'name' => 'company_email1', 'value' => $company_email1, 'required' => 'required', 'type' => 'email', 'placeholder' => dt_translate('site_email'))); ?>
                                                <?php echo form_error('company_email1'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('reg_no'), 'reg_no', array('class' => 'control-label')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'reg_no', 'class' => 'form-control validate', 'name' => 'reg_no', 'value' => $reg_no, 'type' => 'text', 'placeholder' => dt_translate('reg_no'))); ?>
                                                <?php echo form_error('reg_no'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('site_phone') . '', 'company_phone1', array('class' => 'control-label')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'company_phone1', 'class' => 'form-control validate', 'name' => 'company_phone1', 'value' => $company_phone1, 'placeholder' => dt_translate('site_phone'))); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('address') . '', 'company_address1', array('class' => 'control-label')); ?>
                                                <?php echo form_textarea(array('id' => 'company_address1', 'class' => 'form-control validate', 'name' => 'company_address1', 'type' => 'text', 'rows' => 3, 'value' => $company_address1, 'placeholder' => dt_translate('address'))); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="black-text"><?php echo dt_translate('select'); ?> <?php echo dt_translate('language'); ?><small class="required">*</small></label>
                                                <?php
                                                $options = array();
                                                $options[''] = dt_translate('select') . " " . dt_translate('language');
                                                if (isset($language_data) && !empty($language_data)) {

                                                    foreach ($language_data as $row) {
                                                        $options[$row['db_field']] = $row['title'];
                                                    }
                                                }

                                                $attributes = array('class' => 'form-control', 'id' => 'language', 'required' => 'required');
                                                echo form_dropdown('language', $options, $language, $attributes);
                                                echo form_error('language');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="black-text"><?php echo dt_translate('select'); ?> <?php echo dt_translate('time_zone'); ?></label>
                                                <select class="form-control" id="time_zone" name="time_zone">
                                                    <option value=""><?php echo dt_translate('select') . " " . dt_translate('time_zone'); ?></option>
                                                    <?php foreach (dt_tz_list() as $t) { ?>
                                                        <option value="<?php echo $t['zone']; ?>" <?php echo $time_zone == $t['zone'] ? 'selected' : ''; ?>><?php echo $t['diff_from_GMT'] . ' - ' . $t['zone']; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <?php
                                                echo form_error('time_zone');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row setup-content-2" id="step-5">
                                <div class="col-md-12">
                                    <h5 class="font-bold pl-0 my-4"><?php echo dt_translate('social'); ?> <?php echo dt_translate('media'); ?></h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('facebook'), 'fb_link', array('class' => 'control-label')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'fb_link', 'class' => 'form-control', 'name' => 'fb_link', 'value' => $fb_link, 'type' => 'url', 'placeholder' => dt_translate('facebook') . ' ' . dt_translate('link'))); ?>
                                                <?php echo form_error('fb_link'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('twitter'), 'twitter_link', array('class' => 'control-label')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'twitter_link', 'class' => 'form-control', 'name' => 'twitter_link', 'value' => $twitter_link, 'type' => 'url', 'placeholder' => dt_translate('twitter') . ' ' . dt_translate('link'))); ?>
                                                <?php echo form_error('twitter_link'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('instagram'), 'insta_link', array('class' => 'control-label')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'insta_link', 'class' => 'form-control', 'name' => 'insta_link', 'value' => $insta_link, 'type' => 'url', 'placeholder' => dt_translate('instagram') . ' ' . dt_translate('link'))); ?>
                                                <?php echo form_error('insta_link'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label(dt_translate('linkedin'), 'linkdin_link', array('class' => 'control-label')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'linkdin_link', 'class' => 'form-control', 'name' => 'linkdin_link', 'value' => $linkdin_link, 'type' => 'url', 'placeholder' => dt_translate('linkdin') . ' ' . dt_translate('link'))); ?>
                                                <?php echo form_error('linkdin_link'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo form_label(dt_translate('currency'), 'currency', array('class' => 'control-label')); ?>
                                        <select  class="form-control" id="currency_id" name="currency_id">
                                            <?php foreach($app_currency as $val): ?>
                                                <option <?php echo ($currency_id==$val['id'])?'selected="selected"':"";?> value="<?php echo $val['id']; ?>"><?php echo $val['title']." (".$val['currency_code'].")"; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="error" id="commission_percentage"></div>
                                </div>
                                <div class="col-md-4">
                                    <?php echo form_label(dt_translate('currency_display_position'), 'currency', array('class' => 'control-label')); ?>
                                    <select class="form-control" id="currency_position" name="currency_position">
                                        <option <?php echo ($currency_position=='L')?'selected="selected"':"";?> value="L">Left</option>
                                        <option <?php echo ($currency_position=='R')?'selected="selected"':"";?> value="R">Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 ">
                                    <?php echo form_label(dt_translate('display_datetime_form') . ' : ', 'display_record_per_page', array('class' => 'control-label')); ?>
                                    <select name="time_format" id="time_format" class="form-control" >

                                        <optgroup label="12hr format">
                                            <option <?php echo ($time_format == "d/m/y h:i") ? "selected='selected'" : ""; ?> value="d/m/Y h:i"><?php echo date('d/m/Y h:i'); ?></option>
                                            <option <?php echo ($time_format == "d-m-Y h:i") ? "selected='selected'" : ""; ?> value="d-m-Y h:i"><?php echo date('d-m-Y h:i'); ?></option>
                                            <option <?php echo ($time_format == "m-d-Y h:i") ? "selected='selected'" : ""; ?>  value="m-d-Y h:i"><?php echo date('m-d-Y h:i'); ?></option>
                                            <option <?php echo ($time_format == "m/d/Y h:i") ? "selected='selected'" : ""; ?>  value="m/d/Y h:i"><?php echo date('m/d/Y h:i'); ?></option>
                                            <option <?php echo ($time_format == "Y/m/d h:i") ? "selected='selected'" : ""; ?>  value="Y/m/d h:i"><?php echo date('Y/m/d h:i'); ?></option>
                                            <option <?php echo ($time_format == "Y-m-d h:i") ? "selected='selected'" : ""; ?>  value="Y-m-d h:i"><?php echo date('Y-m-d h:i'); ?></option>
                                        </optgroup>

                                        <optgroup label="24hr format">
                                            <option <?php echo ($time_format == "d-m-Y H:i") ? "selected='selected'" : ""; ?> value="d-m-Y H:i"><?php echo date('d-m-Y H:i'); ?></option>
                                            <option <?php echo ($time_format == "d/m/Y H:i") ? "selected='selected'" : ""; ?> value="d/m/Y H:i"><?php echo date('d/m/Y H:i'); ?></option>
                                            <option <?php echo ($time_format == "m-d-Y H:i") ? "selected='selected'" : ""; ?> value="m-d-Y H:i"><?php echo date('m-d-Y H:i'); ?></option>
                                            <option <?php echo ($time_format == "m/d/Y H:i") ? "selected='selected'" : ""; ?> value="m/d/Y H:i"><?php echo date('m/d/Y H:i'); ?></option>
                                            <option <?php echo ($time_format == "Y/m/d H:i") ? "selected='selected'" : ""; ?>  value="Y/m/d H:i"><?php echo date('Y/m/d H:i'); ?></option>
                                            <option <?php echo ($time_format == "Y-m-d H:i") ? "selected='selected'" : ""; ?>  value="Y-m-d H:i"><?php echo date('Y-m-d H:i'); ?></option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <hr/>
                            <div class="row setup-content-2" id="step-6">
                                <div class="col-md-12">
                                    <h5 class="font-bold pl-0 my-4"><?php echo dt_translate('media'); ?></h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo dt_translate('company'); ?> <?php echo dt_translate('logo'); ?><small class="required">*</small></label>
                                                <div class="file-field mb-2">
                                                    <input class="form-control" onchange="company_logo_change(this)" id="imageurl" <?php if ($logo_check == false) echo "required"; ?>  type="file" name="company_logo" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                                </div>
                                                <img id="imageurl" src="<?php echo $logo_image; ?>" alt="Image" height="61">
                                                <div class="w-100"></div>
                                                <strong>(<?php echo dt_translate('valid_logo_size'); ?>)</strong>
                                                <?php echo form_error('company_logo'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo dt_translate('favicon_icon'); ?><small class="required">*</small> </label>
                                                <div class="file-field mb-2">
                                                    <input class="form-control" onchange="company_favicon_change(this)" id="imageurl2" <?php if ($icon_check == false) echo "required"; ?>  type="file" name="fevicon_icon" accept="image/x-png,image/gif,image/jpeg,image/png"/>
                                                </div>
                                                <img id="image_fav_icon" src="<?php echo $icon_image; ?>" alt="Image" height="100">
                                                <div class="w-100"></div>
                                                <?php echo form_error('favicon_icon'); ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-warning" href="<?php echo base_url('admin/dashboard'); ?>"><?php echo dt_translate('cancel'); ?></a>
                                    <button class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> <?php echo dt_translate('submit'); ?></button>
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