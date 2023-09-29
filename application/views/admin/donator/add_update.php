<?php
include VIEWPATH . 'admin/header.php';


$first_name = isset($donator_data['first_name']) ? ($donator_data['first_name']) : set_value('first_name');
$last_name = isset($donator_data['last_name']) ? ($donator_data['last_name']) : set_value('last_name');
$email = isset($donator_data['email']) ? ($donator_data['email']) : set_value('email');
$phone = isset($donator_data['phone']) ? ($donator_data['phone']) : set_value('phone');

$status = isset($donator_data['status']) ? $donator_data['status'] : 'A';
$id = isset($donator_data['id']) ? (int) $donator_data['id'] : (int) set_value('id');
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/donators'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('donator') ?></a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('donator'); ?>
                        </div>
                        <div class="card-body">
                            <?php
                            $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Save_Form', 'name' => 'Save_Form', 'method' => "post");
                            echo form_open('admin/save-donator', $attributes);
                            ?>
                            <?php $this->load->view('message'); ?>
                            <input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : 0; ?>"/>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title"><?php echo dt_translate('first_name') ?><small class="required">*</small></label>
                                        <div>
                                            <input autofocus type="text" tabindex="1" required="" autocomplete="off" value="<?php echo isset($first_name) ? $first_name : ""; ?>" class="form-control" id="first_name" name="first_name" placeholder="<?php echo dt_translate('first_name') ?>">
                                            <?php echo form_error('first_name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title"><?php echo dt_translate('last_name') ?><small class="required">*</small></label>
                                        <div>
                                            <input autofocus type="text" tabindex="1" required="" autocomplete="off" value="<?php echo isset($last_name) ? $last_name : ""; ?>" class="form-control" id="last_name" name="last_name" placeholder="<?php echo dt_translate('last_name') ?>">
                                            <?php echo form_error('last_name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title"><?php echo dt_translate('email') ?><small class="required">*</small></label>
                                        <div>
                                            <input autofocus type="email" tabindex="1" required="" autocomplete="off" value="<?php echo isset($email) ? $email : ""; ?>" class="form-control" id="email" name="email" placeholder="<?php echo dt_translate('email') ?>">
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title"><?php echo dt_translate('phone') ?><small class="required">*</small></label>
                                        <div>
                                            <input autofocus type="text" tabindex="1" autocomplete="off" value="<?php echo isset($phone) ? $phone : ""; ?>" class="form-control" id="phone" name="phone" placeholder="<?php echo dt_translate('phone') ?>">
                                            <?php echo form_error('phone'); ?>
                                        </div>
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
                                        <a href="<?php echo base_url('admin/donators'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                                        <button type="submit" class="btn btn-primary" name="Save" value="Save"><?php echo dt_translate('save') ?></button>
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