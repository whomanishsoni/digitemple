<?php
$from_account = isset($transfer_data['from_account']) ? $transfer_data['from_account'] : set_value('from_account');
$to_account = isset($transfer_data['to_account']) ? $transfer_data['to_account'] : set_value('to_account');
$amount = isset($transfer_data['amount']) ? $transfer_data['amount'] : set_value('amount');
$id = isset($transfer_data['id']) ? (int) $transfer_data['id'] : 0;
$date = isset($transfer_data['date']) ? $transfer_data['date'] : set_value('date',date("Y-m-d"));

include VIEWPATH . 'admin/header.php';

?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/account'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('account') ?></a></li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header">
                <?php echo ($id > 0) ? dt_translate('update') : dt_translate('add'); ?> <?php echo dt_translate('account'); ?>
            </div>
            <div class="card-body">
                <?php
                $attributes = array('class' => 'col-md-12 mx-auto', 'id' => 'Login', 'name' => 'Login', 'method' => "post");
                echo form_open('admin/save-transfer', $attributes);
                ?>
                <?php $this->load->view('message'); ?>
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="from_account"><?php echo dt_translate('from_account') ?><small class="required">*</small></label>
                            <div>
                                <select name="from_account" id="from_account" class="form-control" required>
                                    <option value=""></option>
                                    <?php
                                    foreach($accounts as $account) {
                                    ?>
                                        <option value="<?php echo $account['id'];?>" <?php if($account['id']==$from_account){echo "selected";}?>  ><?php echo $account['name']." = ".$account['balance'];?></option>
                                    <?php    
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('from_account'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="to_account"><?php echo dt_translate('to_account') ?><small class="required">*</small></label>
                            <div>
                                <select name="to_account" id="to_account" class="form-control" required>
                                    <option value=""></option>
                                    <?php
                                    foreach($accounts as $account) {
                                    ?>
                                        <option value="<?php echo $account['id'];?>" <?php if($account['id']==$to_account){echo "selected";}?>  ><?php echo $account['name']." = ".$account['balance'];?></option>
                                    <?php    
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('to_account'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="amount"><?php echo dt_translate('amount');?> <small class="required">*</small></label>
                            <div>
                                <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $amount;?>">
                                <?php echo form_error('amount'); ?>
                                <span id="after_amount" class="text-red" style="font-size:20px"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title"><?php echo dt_translate('date') ?><small class="required">*</small></label>
                            <div>
                                <input type="text"  required="" autocomplete="off" value="<?php echo $date; ?>" class="form-control datepicker" id="date" name="date" placeholder="<?php echo dt_translate('date') ?>">
                                <?php echo form_error('date'); ?>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="<?php echo base_url('admin/transfer'); ?>" class="btn btn-warning"><?php echo dt_translate('cancel') ?></a>
                            <button type="submit" class="btn btn-primary" >
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <?php echo dt_translate('save') ?>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include VIEWPATH . 'admin/footer.php';
?>
<script>
    $(function(){
        $("#amount").keyup(function(){
            let amount = parseInt($(this).val());
            let to_account = $("#to_account option:selected").text();
            let account = to_account.split("=");
            let to_amount = parseInt(account[account.length-1]);
            let total = amount + to_amount;
            //console.log(total);
            $("#after_amount").html(total);
        });
    })
</script>