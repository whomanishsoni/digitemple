<?php
include VIEWPATH . 'admin/header.php';

$title_one=$title_two=$title_three="";
$desc_one=$desc_two=$desc_three="";
if(isset($home_content_title['details']) && $home_content_title['details']!=""){
    $apps_title=json_decode($home_content_title['details']);
    $title_one=isset($apps_title[0])?$apps_title[0]:"";
    $title_two=isset($apps_title[1])?$apps_title[1]:"";
    $title_three=isset($apps_title[2])?$apps_title[2]:"";
}

if(isset($home_content_description['details']) && $home_content_description['details']!=""){
    $desc_title=json_decode($home_content_description['details']);
    $desc_one=isset($desc_title[0])?$desc_title[0]:"";
    $desc_two=isset($desc_title[1])?$desc_title[1]:"";
    $desc_three=isset($desc_title[2])?$desc_title[2]:"";
}
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
                        <?php echo dt_translate('update'); ?> <?php echo dt_translate('home')." ".dt_translate('content'); ?>
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <?php echo form_open('admin/save-home-content', array('name' => 'Save_Form', 'id' => 'Save_Form')); ?>
                        <div class="row setup-content-2" id="step-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('title') . ' 1 ', 'title_two', array('class' => 'control-label')); ?>

                                            <input type="text" tabindex="1" required autocomplete="off" name="title[]" class="form-control" placeholder="<?php echo dt_translate('title')." 1"; ?>" value="<?php echo $title_one; ?>" />
                                            <br/>
                                            <?php echo form_label(dt_translate('description') . ' 1 ', 'title_two', array('class' => 'control-label')); ?>

                                            <textarea required="" tabindex="4" name="description[]" placeholder="<?php echo dt_translate('description')." 1"; ?>" class="form-control"><?php echo $desc_one; ?></textarea>
                                            <?php echo form_error('description'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('title') . ' 2 ', 'title_two', array('class' => 'control-label')); ?>

                                            <input type="text" tabindex="2" required autocomplete="off" name="title[]" class="form-control" placeholder="<?php echo dt_translate('title')." 2"; ?>" value="<?php echo $title_two; ?>" />
                                            <br/>
                                            <?php echo form_label(dt_translate('description') . ' 2 ', 'title_two', array('class' => 'control-label')); ?>

                                            <textarea required="" tabindex="5" name="description[]" placeholder="<?php echo dt_translate('description')." 2"; ?>" class="form-control"><?php echo $desc_two; ?></textarea>
                                            <?php echo form_error('description'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('title') . ' 3 ', 'title_two', array('class' => 'control-label')); ?>

                                            <input type="text" tabindex="3" required autocomplete="off" name="title[]" class="form-control" placeholder="<?php echo dt_translate('title')." 3"; ?>" value="<?php echo $title_three; ?>" />
                                            <br/>
                                            <?php echo form_label(dt_translate('description') . ' 3 ', 'title_two', array('class' => 'control-label')); ?>

                                            <textarea required="" tabindex="6" name="description[]" placeholder="<?php echo dt_translate('description')." 3"; ?>" class="form-control"><?php echo $desc_three; ?></textarea>
                                            <?php echo form_error('description'); ?>
                                        </div>
                                    </div>


                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('video_link_title'), 'video_link_title', array('class' => 'control-label')); ?>
                                            <input type="url" tabindex="7"  autocomplete="off" name="video_link_title" class="form-control" placeholder="<?php echo dt_translate('video_link_title'); ?>" value="<?php echo isset($video_link_title)?$video_link_title:""; ?>" />
                                            <?php echo form_error('video_link_title'); ?>
                                            <small><?php echo dt_translate('leave_blank_if_not_needed'); ?> </small>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo form_label(dt_translate('home_slogan'), 'home_slogan', array('class' => 'control-label')); ?>
                                            <input type="text" tabindex="8"  autocomplete="off" name="home_slogan" class="form-control" placeholder="<?php echo dt_translate('home_slogan'); ?>" value="<?php echo isset($home_slogan)?$home_slogan:""; ?>" />
                                            <?php echo form_error('home_slogan'); ?>
                                            <small><?php echo dt_translate('leave_blank_if_not_needed'); ?> </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
