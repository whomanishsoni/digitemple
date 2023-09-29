<?php
include VIEWPATH . 'admin/header.php';
$raised_per=($app_causes['received_amount']/($app_causes['target_amount']))*100;
?>


<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/manage-causes'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('causes') ?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo $app_causes['title']." - ".dt_translate('donation'); ?>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="progress custom-progress-success">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $raised_per; ?>%" aria-valuenow="<?php echo $raised_per; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fund-raised d-block"><?php echo dt_price_format($app_causes['received_amount']); ?> <?php echo dt_translate('raised_of');?> <?php echo dt_price_format($app_causes['target_amount']); ?></span>
                                <br/>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-primary pull-right text-white" onclick="window.history.back();"><i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                        <?php $this->load->view('message'); ?>
                        <div class="table-responsive">

                            <table class="table table-bordered text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th><?php echo dt_translate('name') ?></th>
                                    <th><?php echo dt_translate('email') ?></th>
                                    <th><?php echo dt_translate('phone') ?></th>
                                    <th><?php echo dt_translate('city') ?></th>
                                    <th><?php echo dt_translate('amount') ?></th>
                                    <th><?php echo dt_translate('payment_by');?></th>
                                    <th><?php echo dt_translate('date') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($app_cause_donation) && count($app_cause_donation) > 0): ?>
                                    <?php
                                    $display_count=1;
                                    $total_payment=0;
                                    foreach ($app_cause_donation as $val):
                                        $payment_type="";
                                        if($val['type']=='CQ'){
                                            $payment_type="<span class='badge badge-warning'>".dt_translate('cheque')."-".$val['cheque_no']."</span>";
                                        }else if($val['type']=='S'){
                                            $payment_type="<span class='badge badge-info'>Stripe</span>";
                                        }else if($val['type']=='P'){
                                            $payment_type="<span class='badge badge-success'>PayPal</span>";
                                        }else{
                                            $payment_type="<span class='badge badge-secondary'>".dt_translate('cash')."</span>";

                                        }
                                        ?>
                                        <tr>
                                            <td class="text-center text-muted"><?php echo $display_count; ?></td>
                                            <td><?php echo $val['first_name']." ".$val['last_name']; ?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['phone']; ?></td>
                                            <td><?php echo $val['city']; ?></td>
                                            <td><?php echo dt_price_format($val['amount']); ?></td>
                                            <td><?php echo $payment_type; ?></td>
                                            <td><?php echo get_formated_date($val['created_on']); ?></td>
                                        </tr>
                                        <?php
                                        $total_payment=$total_payment+$val['amount'];
                                        $display_count++; endforeach; ?>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><?php echo dt_translate('total'); ?></td>
                                        <td><?php echo dt_price_format($total_payment); ?></td>
                                        <td colspan="2"></td>
                                    </tr>
                                <?php else: ?>
                                    <tr><td colspan="<?php echo ($this->login_type=='A')?9:8; ?>" class="text-center"><?php echo dt_translate('no_record_found') ?></td></tr>
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
