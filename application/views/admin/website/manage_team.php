<?php
include VIEWPATH . 'admin/header.php';
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/manage-home-content'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('website') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-team'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('team') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/add-team'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('team'); ?> </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <?php include VIEWPATH . 'admin/website/topbar.php';?>
                <div class="card">
                    <div class="card-header"><?php echo dt_translate('team'); ?></div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th><?php echo dt_translate('name') ?></th>
                                    <th><?php echo dt_translate('designation') ?></th>
                                    <th><?php echo dt_translate('image') ?></th>
                                    <th><?php echo dt_translate('status') ?></th>
                                    <th><?php echo dt_translate('date') ?></th>
                                    <th class="text-center"><?php echo dt_translate('action')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($app_team) && count($app_team) > 0): ?>
                                    <?php
                                    $display_count=1;
                                    foreach ($app_team as $val):
                                        $payment_type="";

                                        if($val['status']=='A'){
                                            $status="<span class='badge badge-success'>".dt_translate('active')."</span>";
                                        }else{
                                            $status="<span class='badge badge-danger'>".dt_translate('inactive')."</span>";
                                        }

                                        if (isset($val['image']) && $val['image']!= "") {
                                            if (file_exists(FCPATH .uploads_path.'/'. $val['image'])) {
                                                $logo_check = true;
                                                $image_path = base_url() . uploads_path . '/' . $val['image'];
                                            } else {
                                                $image_path = base_url() . img_path . "/no-image.png";
                                            }
                                        } else {
                                            $image_path = base_url() . img_path . "/no-image.png";
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-center text-muted"><?php echo $display_count; ?></td>
                                            <td><?php echo escape_data($val['name']); ?></td>
                                            <td><?php echo escape_data($val['designation']); ?></td>
                                            <td><a href="<?php echo $image_path; ?>" target="_blank"><img src="<?php echo $image_path; ?>" height="100"/></a></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($val['created_on'])); ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('admin/update-team/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                <a href="javascript:void(0)" data-action="delete-team" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
                                            </td>
                                        </tr>
                                        <?php $display_count++; endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>
