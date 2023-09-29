<?php
include VIEWPATH . 'admin/header.php';
?>

<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/donators'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('donator') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/add-donator'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('donator'); ?> </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo dt_translate('donator') ?></a>
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th><?php echo dt_translate('name') ?></th>
                                    <th><?php echo dt_translate('email') ?></th>
                                    <th><?php echo dt_translate('phone') ?></th>
                                    <th><?php echo dt_translate('status') ?></th>
                                    <th class="text-center"><?php echo dt_translate('action')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; if (isset($donator_data) && count($donator_data) > 0): ?>
                                    <?php foreach ($donator_data as $val):
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo escape_data($val['first_name'])." ".escape_data($val['last_name']); ?></td>
                                            <td><?php echo escape_data($val['email']); ?></td>
                                            <td><?php echo escape_data($val['phone']); ?></td>
                                            <td><?php echo dt_get_status_badge($val['status']) ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('admin/donator-donation/' . $val['id']); ?>" class="btn btn-info btn-sm"><?php echo dt_translate('donation') ?></a>
                                                <a href="<?php echo base_url('admin/update-donator/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                <a href="javascript:void(0)" data-action="delete-donator" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
                                            </td>
                                        </tr>
                                        <?php $count++; endforeach; ?>
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