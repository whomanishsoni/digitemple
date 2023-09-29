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
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo dt_translate('donator') . " " .dt_translate('donation'); ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th><?php echo dt_translate('category') ?></th>
                                    <th><?php echo dt_translate('payment_by') ?></th>
                                    <th><?php echo dt_translate('collected_by') ?></th>
                                    <th><?php echo dt_translate('amount') ?></th>
                                    <th><?php echo dt_translate('date') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($donation_data) && count($donation_data) > 0): ?>
                                    <?php
                                    $display_count=1;
                                    foreach ($donation_data as $val):
                                        $payment_type="<span class='badge badge-info'>".$val['account_name']." - ".$val['type']."</span>";
                                        
                                        ?>
                                        <tr>
                                            <td class="text-center text-muted"><?php echo $display_count; ?></td>
                                            <td><?php echo escape_data($val['title']); ?></td>
                                            <td><?php echo $payment_type; ?></td>
                                            <td><?php echo $val["collected_by"];?></td>
                                            <td><?php echo dt_price_format($val['amount']); ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($val['created_on'])); ?></td>
                                        </tr>
                                        <?php $display_count++; endforeach; ?>
                                <?php else: ?>
                                    <tr class="text-center">
                                        <td colspan="5"><?php echo dt_translate('no_record_found') ?></td>
                                    </tr>
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

    <div class="app-main">
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="container">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div><?php echo dt_translate('donator') . " " . dt_translate('donation') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">

                </div>
            </div>
        </div>
    </div>
<?php
include VIEWPATH . 'admin/footer.php';
?>