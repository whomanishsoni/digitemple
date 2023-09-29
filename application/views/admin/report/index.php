<?php
include VIEWPATH . 'admin/header.php';
$from_date=$this->input->get('from_date');
$to_date=$this->input->get('to_date');
$type=$this->input->get('type');
$save=$this->input->get('Save');
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/report'); ?>"><?php echo dt_translate('donation')." ".dt_translate('report'); ?></a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                <ul class="nav text-left" id="website_topbar">
                    <li class="nav-item">
                        <a role="tab" class="nav-link  show" href="<?php echo base_url('admin/report'); ?>" aria-selected="true">
                            <span><?php echo dt_translate('donation')." ".dt_translate('report'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a role="tab" class="nav-link show active" href="<?php echo base_url('admin/expense-report'); ?>" aria-selected="false">
                            <span><?php echo dt_translate('expense')." ".dt_translate('report'); ?></span>
                        </a>
                    </li>

                </ul>

                <div class="card">
                    <div class="card-body">
                        <?php
                        $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Login', 'name' => 'Login', 'method' => "GET");
                        echo form_open('', $attributes);
                        ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('from_date') ?><small class="required">*</small></label>
                                    <div>
                                        <input required type="date" value="<?php echo $from_date; ?>" tabindex="1" autocomplete="off"  class="form-control" id="from_date" name="from_date" placeholder="<?php echo dt_translate('date') ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('to_date') ?><small class="required">*</small></label>
                                    <div>
                                        <input required type="date"  value="<?php echo $to_date; ?>" tabindex="2" autocomplete="off"  class="form-control" id="to_date" name="to_date" placeholder="<?php echo dt_translate('date') ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title"><?php echo dt_translate('payment_by') ?></label>
                                    <select class="form-control" name="type">
                                        <option value="">All</option>
                                        <option <?php echo ($type=="CA")?"selected='selected'":""; ?> value="CA"><?php echo dt_translate('cash') ?></option>
                                        <option <?php echo ($type=="CQ")?"selected='selected'":""; ?> value="CQ"><?php echo dt_translate('cheque') ?></option>
                                        <option <?php echo ($type=="S")?"selected='selected'":""; ?> value="S">Stripe</option>
                                        <option <?php echo ($type=="P")?"selected='selected'":""; ?> value="P">PayPal</option>
                                        <option <?php echo ($type=="R")?"selected='selected'":""; ?> value="R">Razorpay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br/>
                                <div class="form-group">
                                    <button tabindex="3" type="submit" class="btn btn-primary mt-2" name="Save" value="Save"><?php echo dt_translate('search') ?></button>
                                    <a href="<?php echo base_url('admin/report'); ?>" class="btn btn-warning mt-2"><?php echo dt_translate('cancel') ?></a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($save) && $save=="Save"): ?>
                    <div class="card mb-3 card mt-4">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th><?php echo dt_translate('name') ?></th>
                                        <th><?php echo dt_translate('phone') ?></th>
                                        <th><?php echo dt_translate('city') ?></th>
                                        <th><?php echo dt_translate('department') ?></th>
                                        <th><?php echo dt_translate('payment_by') ?></th>
                                        <th><?php echo dt_translate('amount') ?></th>
                                        <th><?php echo dt_translate('date') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(isset($donation_data) && count($donation_data)>0): ?>
                                        <a target="_blank" href="<?php echo base_url("admin/donation-print?".$this->input->server('QUERY_STRING')); ?>" class="btn btn-primary mb-3 text-white pull-right">Print</a>
                                        <?php
                                        $total_amount=0;
                                        foreach ($donation_data as $val):
                                            $payment_type="";
                                            if($val['type']=='CQ'){
                                                $payment_type="<span class='badge badge-warning'>".dt_translate('cheque')."-".$val['cheque_no']."</span>";
                                            }else if($val['type']=='S'){
                                                $payment_type="<span class='badge badge-info'>Stripe</span>";
                                            }else if($val['type']=='R'){
                                                $payment_type="<span class='badge badge-warning'>Razorpay</span>";
                                            }else if($val['type']=='P'){
                                                $payment_type="<span class='badge badge-success'>PayPal</span>";
                                            }else{
                                                $payment_type="<span class='badge badge-secondary'>".dt_translate('cash')."</span>";
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-center text-muted">#<?php echo $val['id']; ?></td>
                                                <td><?php echo $val['first_name']." ".$val['last_name']; ?></td>
                                                <td><?php echo $val['phone']; ?></td>
                                                <td><?php echo $val['city']; ?></td>
                                                <td><?php echo $val['title']; ?></td>
                                                <td><?php echo $payment_type; ?></td>
                                                <td><?php echo dt_price_format($val['amount']); ?></td>
                                                <td><?php echo get_formated_date($val['created_on']); ?></td>
                                            </tr>
                                            <?php
                                            $total_amount=$total_amount+$val['amount'];
                                        endforeach; ?>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-left"><?php echo dt_translate('total'); ?></td>
                                            <td><?php echo dt_price_format($total_amount,2); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr><td colspan="8" class="text-center">No record found</td></tr>
                                    <?php endif;?>


                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>