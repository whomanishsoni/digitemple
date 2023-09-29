<?php
include VIEWPATH . 'admin/header.php';
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/transfer'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('transfer') ?></a></li>
                </ol>
                <div class="ml-auto">
                    <a href="<?php echo base_url('admin/add-transfer'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('transfer'); ?> </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Created By</th>
                                        <th>From Account</th>
                                        <th>To Account</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th class="text-center"><?php echo dt_translate('action')?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($transfers) && count($transfers) > 0): ?>
                                        <?php foreach ($transfers as $key=>$val):
                                            $key++;
                                            ?>
                                            <tr>
                                                <td><?php echo $key; ?></td>
                                                <td><?php echo $val['created_by_name']; ?></td>
                                                <td><?php echo $accounts[$val['from_account']]['name']?></td>
                                                <td><?php echo $accounts[$val['to_account']]['name']?></td>
                                                <td><?php echo $val['amount'];?></td>
                                                <td><?php echo get_formated_date($val['date'],"N"); ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if($this->session->userdata('ADMIN_ID')==1) {
                                                    ?>
                                                        <a href="<?php echo base_url('admin/update-transfer/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                        <a href="javascript:void(0)" data-action="delete-transfer" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a> 
                                                    <?php 
                                                    }
                                                    ?>
                                                    
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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