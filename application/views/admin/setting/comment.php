<?php
include VIEWPATH . 'admin/header.php';
$project_id=$comment_project_id['details'];
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/comment'); ?>">CommentBox</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <?php include VIEWPATH . 'admin/setting/nav.php';?>

                    <div class="card">

                        <div class="card-header">
                            Enable CommentBox
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <?php echo form_open_multipart('admin/save-comment', array('name' => 'site_form', 'id' => 'site_form')); ?>
                            <div class="row setup-content-2" id="step-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo form_label('CommentBox Project ID', 'comment_project_id', array('class' => 'control-label', 'data-error' => 'wrong', 'data-success' => 'right')); ?>
                                                <?php echo form_input(array('autocomplete'=>'off','id' => 'comment_project_id', 'class' => 'form-control validate', 'name' => 'comment_project_id', 'value' => $project_id, 'required' => 'required', 'placeholder' =>'CommentBox Project ID')); ?>
                                                <?php echo form_error('comment_project_id'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="alert alert-dark">
                                        To enable comment on News, Projects, Causes, Events. You need to have <a class="" href="https://commentbox.io/" target="_blank">https://commentbox.io/</a> Account. Once you register there it will ask you to create project. Once you fill project details and create project. You will get project ID.
                                        That need to added here to enable comment.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a tabindex="5" class="btn btn-warning" href="<?php echo base_url('admin/dashboard'); ?>"><?php echo dt_translate('cancel'); ?></a>
                                    <button tabindex="4" class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <?php echo dt_translate('submit'); ?></button>
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