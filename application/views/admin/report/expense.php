<?php
include VIEWPATH . 'admin/header.php';
$from_date=$this->input->get('from_date');
$to_date=$this->input->get('to_date');
$category=$this->input->get('category');
$save=$this->input->get('Save');
?>

<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/expense-report'); ?>"><?php echo dt_translate('expense')." ".dt_translate('report'); ?></a></li>
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
                                    <label for="title"><?php echo dt_translate('category') ?></label>
                                    <select class="form-control" name="category">
                                        <option value="">All</option>
                                        <?php foreach ($app_expense_category as $val): ?>
                                            <option <?php echo ($category==$val['id'])?"selected='selected'":""; ?> value="<?php echo $val['id']; ?>"><?php echo $val['title'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br/>
                                <div class="form-group">
                                    <button tabindex="3" type="submit" class="btn btn-primary mt-2" name="Save" value="Save"><?php echo dt_translate('search') ?></button>
                                    <a href="<?php echo base_url('admin/expense-report'); ?>" class="btn btn-warning mt-2"><?php echo dt_translate('cancel') ?></a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($save) && $save=="Save"): ?>
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th><?php echo dt_translate('expense_category') ?></th>
                                        <th><?php echo dt_translate('details') ?></th>
                                        <th><?php echo dt_translate('amount') ?></th>
                                        <th><?php echo dt_translate('date') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($expense_data) && count($expense_data) > 0): ?>
                                        <a target="_blank" href="<?php echo base_url("admin/expense-print?".$this->input->server('QUERY_STRING')); ?>" class="btn btn-primary mb-3 text-white pull-right">Print</a>
                                        <?php
                                        $total_exp=0;
                                        foreach ($expense_data as $val):
                                            ?>
                                            <tr>
                                                <td class="text-center text-muted">#<?php echo $val['id']; ?></td>
                                                <td><span class="badge badge-info"><?php echo $val['category_title']; ?></span></td>
                                                <td><?php echo nl2br($val['details']); ?></td>
                                                <td><?php echo dt_price_format($val['amount']); ?></td>
                                                <td><?php echo get_formated_date($val['expense_date'],'N'); ?></td>
                                            </tr>
                                            <?php
                                            $total_exp=$total_exp+$val['amount'];
                                        endforeach; ?>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-center"><?php echo dt_translate('total'); ?></td>
                                            <td><?php echo dt_price_format($total_exp,2); ?></td>
                                            <td></td>

                                        </tr>
                                    <?php else: ?>
                                        <tr><td colspan="5" class="text-center">No record found</td></tr>
                                    <?php endif; ?>

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