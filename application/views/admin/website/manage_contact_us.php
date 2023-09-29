<?php
include VIEWPATH . 'admin/header.php';
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
                        <?php echo dt_translate('contact_us'); ?>
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
                                    <th><?php echo dt_translate('subject') ?></th>
                                    <th><?php echo dt_translate('message') ?></th>
                                    <th><?php echo dt_translate('date') ?></th>
                                    <th class="text-center"><?php echo dt_translate('action')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($app_contact_us) && count($app_contact_us) > 0): ?>
                                    <?php
                                    $display_count=1;
                                    foreach ($app_contact_us as $val):?>
                                        <tr>
                                            <td class="text-center text-muted"><?php echo $display_count; ?></td>
                                            <td><?php echo escape_data($val['name']); ?></td>
                                            <td><?php echo escape_data($val['email']); ?></td>
                                            <td><?php echo escape_data($val['subject']); ?></td>
                                            <td><?php echo escape_data($val['message']); ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($val['created_date'])); ?></td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" data-action="delete-contactus" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
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
