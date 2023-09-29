<?php
include VIEWPATH . 'admin/header.php';
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/item-donation'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('item'). " " . dt_translate('donation') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/item-donation-export'); ?>" class="btn btn-warning btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-file-excel-o"></i></span> <?php echo dt_translate('export'); ?></a>
                <a href="<?php echo base_url('admin/add-item-donation'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('item'). " " . dt_translate('donation'); ?> </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th><?php echo dt_translate('name') ?></th>
                                        <th><?php echo dt_translate('phone') ?></th>
                                        <th><?php echo dt_translate('city') ?></th>
                                        <th><?php echo dt_translate('item') ?></th>
                                        <th><?php echo dt_translate('qty') ?></th>
                                        <th><?php echo dt_translate('date') ?></th>
                                        <?php if($this->login_type=='A'): ?>
                                            <th class="text-center"><?php echo dt_translate('action')?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($item_donation_data) && count($item_donation_data) > 0): ?>
                                        <?php
                                        $display_count=1;
                                        foreach ($item_donation_data as $val):
                                            $status="";
                                            $status_badge="badge-warning";
                                            if($val['status']=='R'){
                                                $status=dt_translate('received');
                                                $status_badge="badge-info";
                                            }else{
                                                $status=dt_translate('not_received');
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $display_count; ?></td>
                                                <td>
                                                    <?php echo escape_data($val['first_name'])." ".escape_data($val['last_name']); ?><br/>
                                                    <small class="badge badge-default"><?php echo escape_data($val['email']); ?></small>
                                                </td>
                                                <td><?php echo escape_data($val['phone']); ?></td>
                                                <td><?php echo escape_data($val['city']); ?></td>
                                                <td><?php echo escape_data($val['title']); ?></td>
                                                <td>
                                                    <?php echo escape_data($val['qty']); ?><br/>
                                                    <small class="badge <?php echo $status_badge; ?> "><?php echo $status; ?></small>
                                                </td>
                                                <td><?php echo get_formated_date($val['created_on']); ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('admin/update-item-donation/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                    <a href="javascript:void(0)" data-action="delete-item-donation" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
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
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>
