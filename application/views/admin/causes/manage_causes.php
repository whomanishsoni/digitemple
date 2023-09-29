<?php
include VIEWPATH . 'admin/header.php';
?>


<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-causes'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('causes') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/add-cause'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('cause'); ?> </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo $title; ?>
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th><?php echo dt_translate('title') ?></th>
                                    <th><?php echo dt_translate('target')." ".dt_translate('amount') ?></th>
                                    <th><?php echo dt_translate('donation');?></th>
                                    <th><?php echo dt_translate('status') ?></th>
                                    <th><?php echo dt_translate('date') ?></th>
                                    <th class="text-center"><?php echo dt_translate('action')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($app_causes) && count($app_causes) > 0): ?>
                                    <?php
                                    $display_count=1;
                                    foreach ($app_causes as $val):
                                        $payment_type="";

                                        if($val['status']=='A'){
                                            $status="<span class='badge badge-success'>".dt_translate('active')."</span>";
                                        }elseif($val['status']=='C'){
                                            $status="<span class='badge badge-primary'>".dt_translate('completed')."</span>";
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
                                            <td><?php echo $display_count; ?></td>
                                            <td><?php echo escape_data($val['title']); ?></td>
                                            <td><?php echo dt_price_format($val['target_amount']); ?></td>
                                            <td><?php echo dt_price_format($val['received_amount']); ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo get_formated_date($val['created_on']); ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('admin/cause-donation/' . $val['id']); ?>" class="btn btn-info btn-sm"><?php echo dt_translate('donation') ?></a>
                                                <a href="<?php echo base_url('admin/update-cause/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                <a href="javascript:void(0)" data-action="delete-causes" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
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
