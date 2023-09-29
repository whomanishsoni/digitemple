<?php
include VIEWPATH . 'admin/header.php';
?>
<div class="container  content-area">
    <div class="section">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <a href="<?php echo base_url('admin/add-donation'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('donation'); ?> </a>

                <?php if(is_module_enabled('expense')==true): ?>
                    <a href="<?php echo base_url('admin/add-expense'); ?>" class="btn btn-secondary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('expense'); ?> </a>
                <?php endif; ?>

                <?php if(is_module_enabled('item')==true): ?>
                    <a href="<?php echo base_url('admin/add-item-donation'); ?>" class="btn btn-info btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('item'). " " . dt_translate('donation'); ?> </a>
                <?php endif; ?>
            </div>
        </div>
        <!-- PAGE-HEADER END --> <!-- ROW-1 -->
        <div class="row">
            <div class="col-md-12">
                <?php if($this->login_type=='A' && ($total_donation_category['total_donation_category']==0 || count($payment)==0)): ?>
                    <div class="card">
                        <div class="card-header">
                            Mandatory Update
                        </div>
                        <div class="card-body">

                            <?php if(isset($total_donation_category['total_donation_category']) && $total_donation_category['total_donation_category']==0): ?>
                                <div class="alert alert-info">
                                    Please add at least one donation category to start accepting donation. <a  href="<?php echo base_url('admin/donation-category'); ?>">Click Here</a>
                                </div>

                            <?php endif; ?>

                            <?php if(isset($payment) && count($payment)==0): ?>
                                <div class="alert alert-info">
                                    Please add at least one payment method to start accepting donation. <a href="<?php echo base_url('admin/payment-setting'); ?>">Click Here</a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">



                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="">
                                <p class="mb-1"><?php echo dt_translate('donator'); ?></p>
                                <h4 class="mb-1"><span class="number-font "><?php echo $total_donator; ?></span></h4>
                            </div>
                            <div class="ml-auto">
                                <div class="feature">
                                    <div class="fa fa-gift fa-lg fa-2x icon bg-purple-gradient icon-service"> <i class="mdi mdi-arrange-bring-forward fa-stack-1x text-white"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url('admin/donation'); ?>">
                            <div class="d-flex">
                                <div class="">
                                    <p class="mb-1"><?php echo dt_translate('total')." ".dt_translate('donation'); ?></p>
                                    <h4 class="mb-1"><span class="number-font "><?php echo dt_price_format($total_donation); ?></span></h4>
                                </div>
                                <div class="ml-auto">
                                    <div class="feature">
                                        <div class="fa fa-credit-card fa-lg fa-2x icon bg-purple-gradient icon-service"> <i class="mdi mdi-cube fa-stack-1x text-white"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </a>


                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url('admin/expense'); ?>">
                            <div class="d-flex">
                                <div class="">
                                    <p class="mb-1"><?php echo dt_translate('total')." ".dt_translate('expense'); ?></p>
                                    <h4 class="mb-1"><span class="number-font "><?php echo dt_price_format($total_expense); ?></span></h4>
                                </div>
                                <div class="ml-auto">
                                    <div class="feature">
                                        <div class="fa fa-credit-card-alt fa-lg fa-2x icon bg-purple-gradient icon-service"> <i class="mdi mdi-poll-box fa-stack-1x text-white"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
            <?php if($this->login_type=='A'): ?>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                         <a href="<?php echo base_url('admin/account'); ?>">
                            <div class="d-flex">
                                <div class="">
                                    <?php 
                                        $balance = $total_donation - $total_expense;
                                        $bg = "bg-purple-gradient";
                                        $color = "";
                                        if($balance < 0) {
                                            $bg = "bg-red";
                                            $color = "text-red font-weight-bold";
                                        }
                                    ?>
                                    
                                    <p class="mb-1 <?php echo $color;?>"><?php echo dt_translate('balance'); ?></p>
                                    <h4 class="mb-1 <?php echo $color;?>"><span class="number-font "><?php echo $balance; ?></span></h4>
                                </div>
                                <div class="ml-auto">
                                    <div class="feature">
                                        <div class="fa fa-reply-all fa-lg fa-2x icon <?php echo $bg;?> icon-service"> <i class="mdi mdi-auto-fix fa-stack-1x text-white"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>



        

    </div>
    <!-- CONTAINER END -->
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>
