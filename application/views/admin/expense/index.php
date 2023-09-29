<?php
include VIEWPATH . 'admin/header.php';

$root_dir = FCPATH.uploads_path . '/expense/';

?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/expense'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('expense') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/expense-export'); ?>" class="btn btn-warning btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-file-excel-o"></i></span> <?php echo dt_translate('export'); ?></a>
                <a href="<?php echo base_url('admin/add-expense'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('expense'); ?> </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo dt_translate('expense'); ?>
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <div class="table-responsive">
                            <!-- <table id="example" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo dt_translate('date') ?></th>
                                    <th><?php echo dt_translate('party_name');?></th>
                                    <th><?php echo dt_translate('party_phone');?></th>
                                    <th><?php echo dt_translate('ref_no');?></th>
                                    <th><?php echo dt_translate('create_by');?></th>
                                    <th><?php echo dt_translate('expense_category') ?></th>
                                    <th><?php echo dt_translate('account') ?></th>
                                    <th><?php echo dt_translate('amount') ?></th>
                                    <th><?php echo dt_translate('details') ?></th>
                                    <th>Bill</th>
                                    <th class="text-center"><?php echo dt_translate('action')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($expense_data) && count($expense_data) > 0): ?>
                                    <?php
                                    $display_count=1;
                                    foreach ($expense_data as $val):
                                        ?>
                                        <tr>
                                            <td><?php echo $display_count; ?></td>
                                            <td><?php echo get_formated_date($val['expense_date'],"N"); ?></td>
                                            <td><?php echo $val['party_name'];?></td>
                                            <td><?php echo $val['party_phone'];?></td>
                                            <td><?php echo $val['ref_no'];?></td>
                                            <td><?php echo $val['created_by_name'];?></td>
                                            <td><span class="badge badge-info"><?php echo escape_data($val['category_title']); ?></span></td>
                                            <td><?php echo $val['account_name'];?></td>
                                            <td><?php echo dt_price_format($val['amount']); ?></td>
                                            <td><?php echo nl2br($val['details']); ?></td>
                                            <td>
                                                <?php
                                                if (!empty($val['image']) && file_exists($root_dir . $val['image'] )) {
                                                    $image = base_url() . uploads_path . '/expense/' . $val['image'];
                                                    ?>
                                                        <a href="<?php echo $image;?>" target="_blank">View Bill</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('admin/update-expense/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                <a href="javascript:void(0)" data-action="delete-expense" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $display_count++;
                                    endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table> -->

                            <span id="totalAmount">Total Amount: ₹0.00</span>

                            <table id="expenseTableID" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <input type="text" id="dateFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Date') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="nameFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Name') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="phoneFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Phone') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="ref_noFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Receipt') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="createFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Created By') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="expenseFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Expense') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="accountFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Account') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="amountFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Amount') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="detailsFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Details') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="billFilter" class="form-control form-control-sm" placeholder="Bill">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo dt_translate('date') ?></th>
                                        <th><?php echo dt_translate('party_name');?></th>
                                        <th><?php echo dt_translate('party_phone');?></th>
                                        <th><?php echo dt_translate('ref_no');?></th>
                                        <th><?php echo dt_translate('create_by');?></th>
                                        <th><?php echo dt_translate('expense_category') ?></th>
                                        <th><?php echo dt_translate('account') ?></th>
                                        <th><?php echo dt_translate('amount') ?></th>
                                        <th><?php echo dt_translate('details') ?></th>
                                        <th>Bill</th>
                                        <th class="text-center"><?php echo dt_translate('action')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
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

<script type="text/javascript">

// $(document).ready(function() {

    var dataTable = $('#expenseTableID').DataTable({ 

        "processing": true,
        "serverSide": true,
        "searching": true,
        "order": [],
        "searchDelay": 1000,

        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var columnToSum = 8;
            var columnVisible = api.column(columnToSum).visible();

            if (columnVisible) {
                var sum = api
                    .column(columnToSum, { filter: 'applied' })
                    .data()
                    .reduce(function(a, b) {

                    var amountA = parseFloat(String(a).replace(/&#8377;/g, '').replace(/[^\d.]/g, '').trim());
                    var amountB = parseFloat(String(b).replace(/&#8377;/g, '').replace(/[^\d.]/g, '').trim());

                    return amountA + amountB;

                    }, 0);
                var formattedSum = 'Total: ₹' + sum.toFixed(2);
                $(api.column(columnToSum).footer()).html(formattedSum);
            }
        },

        "ajax": {
            "url": "<?php echo base_url('admin/expense/getExpenseData')?>",
            "type": "POST",
            "data": function ( data ) {
                data.date = $('#dateFilter').val();
                data.name = $('#nameFilter').val();
                data.phone = $('#phoneFilter').val();
                data.ref_no = $('#ref_noFilter').val();
                data.create = $('#createFilter').val();
                data.expense = $('#expenseFilter').val();
                data.account = $('#accountFilter').val();
                data.amount = $('#amountFilter').val();
                data.details = $('#detailsFilter').val();
            },

            "dataSrc": function(json) {
            var filters = [
                $('#expenseTableID_filter input').val(),
                $('#dateFilter').val(),
                $('#nameFilter').val(),
                $('#phoneFilter').val(),
                $('#ref_noFilter').val(),
                $('#createFilter').val(),
                $('#expenseFilter').val(),
                $('#accountFilter').val(),
                $('#amountFilter').val(),
                $('#detailsFilter').val(),
            ];

                var searchValue = filters.join('');

                if (searchValue.trim() !== '') {
                    var totalFilteredAmount = json.totalFilteredAmount;
                    $('#totalAmount').text('Total Filtered  Amount: ₹' + totalFilteredAmount.toFixed(2));
                    $('#totalAmount').show();
                } else {
                    $('#totalAmount').hide();
                }

            return json.data;
        }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
        "columns": [
            { "data": "0", "name": "" },
            { "data": "1", "name": "app_expense.expense_date" },
            { "data": "2", "name": "app_expense.party_name" },
            { "data": "3", "name": "app_expense.party_phone" },
            { "data": "4", "name": "app_expense.ref_no" },
            { "data": "5", "name": "name" },
            { "data": "6", "name": "app_expense_category.title" },
            { "data": "7", "name": "app_accounts.name" },
            { "data": "8", "name": "app_expense.amount" },
            { "data": "9", "name": "app_expense.details" },
            { "data": "10", "name": "" },
            { "data": "11", "name": "" },
        ],
        "lengthMenu": [[10, 25, 50,100,200,300, -1], [10, 25, 50,100,200,300, "All"]],

    });

    $('#dateFilter, #nameFilter, #phoneFilter, #ref_noFilter, #createFilter, #expenseFilter, #accountFilter, #amountFilter, #detailsFilter').on('input', function () {
    dataTable.ajax.reload();
    });

// });

</script>