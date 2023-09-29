<?php
include VIEWPATH . 'admin/header.php';
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/currency'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('currency') ?></a></li>
                </ol>
                <div class="ml-auto">
                    <a href="<?php echo base_url('admin/add-currency'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('currency'); ?> </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <?php echo dt_translate('currency') ?>
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center font-bold dark-grey-text">#</th>
                                        <th class="text-center font-bold dark-grey-text"><?php echo dt_translate('title'); ?></th>
                                        <th class="text-center font-bold dark-grey-text"><?php echo dt_translate('code'); ?></th>
                                        <th class="text-center font-bold dark-grey-text">Currency Code</th>
                                        <th class="text-center font-bold dark-grey-text">Stripe Supported</th>
                                        <th class="text-center font-bold dark-grey-text">PayPal Supported</th>
                                        <th class="text-center font-bold dark-grey-text"><?php echo dt_translate('action'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($currency_data) && count($currency_data) > 0): ?>
                                        <?php $i=1; foreach ($currency_data as $row):

                                            if ($row['stripe_supported'] == "Y") {
                                                $stripe_supported = '<span class="badge badge-success">' . dt_translate('yes') . '</span>';
                                            } else {
                                                $stripe_supported = '<span class="badge badge-danger">' . dt_translate('no') . '</span>';
                                            }

                                            if ($row['paypal_supported'] == "Y") {
                                                $paypal_supported = '<span class="badge badge-success">' . dt_translate('yes') . '</span>';
                                            } else {
                                                $paypal_supported = '<span class="badge badge-danger">' . dt_translate('no') . '</span>';
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td class="text-center"><?php echo escape_data($row['title']); ?></td>
                                                <td class="text-center"><?php echo escape_data($row['code']); ?></td>
                                                <td class="text-center"><?php echo escape_data($row['currency_code']); ?></td>
                                                <td class="text-center"><?php echo ($stripe_supported); ?></td>
                                                <td class="text-center"><?php echo $paypal_supported; ?></td>

                                                <td class="text-center">
                                                    <a href="<?php echo base_url('admin/update-currency/' . $row['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                    <a href="javascript:void(0)" data-action="delete-currency" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $row['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
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