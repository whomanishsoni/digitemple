<?php
include VIEWPATH . 'admin/header.php';

$cat_title = isset($expense_category_data['title']) ? escape_data($expense_category_data['title']) : set_value('title');
$status = isset($expense_category_data['status']) ? $expense_category_data['status'] : 'A';
$id = isset($expense_category_data['id']) ? (int) $expense_category_data['id'] : (int) set_value('id');
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/expense-category'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('expense_category') ?></a></li>
            </ol>
            <div class="ml-auto"> <a href="<?php echo base_url('admin/add-expense-category'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('expense_category'); ?> </a></div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('expense_category'); ?>
                    </div>
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post");
                        echo form_open('admin/save-expense-category', $attributes);
                        ?>
                        <?php $this->load->view('message'); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="title"><?php echo dt_translate('title') ?><small class="required">*</small></label>
                                    <div>
                                        <input autofocus type="text" minlength="3" tabindex="1" required="" autocomplete="off" value="<?php echo isset($cat_title) ? $cat_title : ""; ?>" class="form-control" id="title" name="title" placeholder="<?php echo dt_translate('title') ?>">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> <?php echo dt_translate('status'); ?><small class="required">*</small></label>

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
                                    <a href="<?php echo base_url('admin/expense-category'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                                    <button type="submit" class="btn btn-primary" name="Save" value="Save">
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