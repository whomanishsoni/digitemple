<?php
include VIEWPATH . 'admin/header.php';
?>
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/donation'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('donation') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/donation-export'); ?>" class="btn btn-warning btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-file-excel-o"></i></span> <?php echo dt_translate('export'); ?></a>
                <a href="<?php echo base_url('admin/add-donation'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('donation'); ?> </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo $title; ?>
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <div class="table-responsive">
                            <!-- <table id="example" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th><?php echo dt_translate('ref_no/receipt_no') ?></th>
                                    <th><?php echo dt_translate('name') ?></th>
                                    <th><?php echo dt_translate('phone') ?></th>
                                    <th><?php echo dt_translate('city') ?></th>
                                    <th><?php echo dt_translate('category') ?></th>
                                    <th><?php echo dt_translate('payment_type') ?></th>
                                    <th><?php echo dt_translate('collected_by') ?></th>
                                    <th><?php echo dt_translate('amount') ?></th>
                                    <th><?php echo dt_translate('date') ?></th>
                                    <th><?php echo dt_translate('details') ?></th>
                                    <?php if($this->login_type=='A'): ?>
                                        <th class="text-center"><?php echo dt_translate('action')?></th>
                                    <?php endif; ?>
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
                                            <td><?php echo $display_count; ?></td>
                                            <td><?php echo $val['ref_no'];?></td>
                                            <td>
                                                <?php echo escape_data($val['first_name'])." ".escape_data($val['last_name']); ?><br/>
                                                <small class="badge badge-default"><?php echo escape_data($val['email']); ?></small>
                                            </td>
                                            <td><?php echo escape_data($val['phone']); ?></td>
                                            <td><?php echo escape_data($val['city']); ?></td>
                                            <td><?php echo escape_data($val['title']); ?></td>
                                            <td><?php echo $payment_type; ?></td>
                                            <td><?php echo $val["collected_by"];?></td>
                                            <td><?php echo dt_price_format($val['amount']); ?></td>
                                            <td><?php echo get_formated_date($val['date'],"N"); ?></td>
                                            <td><?php echo $val['details']; ?></td>
                                            <td class="text-center">
                                                <a target="_blank" href="<?php echo base_url('admin/donation-receipt/' . $val['id']); ?>" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
                                                <a href="<?php echo base_url('admin/update-donation/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                <a href="javascript:void(0)" data-action="delete-donation" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
                                            </td>
                                        </tr>
                                        <?php $display_count++; endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table> -->
                                                        
                            <span id="totalAmount">Total Amount: ₹0.00</span>

                            <table id="donationTableID" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <input type="text" id="ref_noFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Receipt') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="nameFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Name') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="phoneFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Phone') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="cityFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('city') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="categoryFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Category') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="paymentFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Payment Type') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="collectionFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Collected By') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="amountFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Amount') ?>">
                                        </th>
                                        <th>
                                            <input type="text" id="dateFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Date') ?>">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th><?php echo dt_translate('ref_no/receipt_no') ?></th>
                                        <th><?php echo dt_translate('name') ?></th>
                                        <th><?php echo dt_translate('phone') ?></th>
                                        <th><?php echo dt_translate('city') ?></th>
                                        <th><?php echo dt_translate('category') ?></th>
                                        <th><?php echo dt_translate('payment_type') ?></th>
                                        <th><?php echo dt_translate('collected_by') ?></th>
                                        <th><?php echo dt_translate('amount') ?></th>
                                        <th><?php echo dt_translate('date') ?></th>
                                        <th><?php echo dt_translate('details') ?></th>
                                        <?php if($this->login_type=='A'): ?>
                                        <th class="text-center"><?php echo dt_translate('action')?></th>
                                        <?php endif; ?>
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

    var dataTable = $('#donationTableID').DataTable({ 

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
            "url": "<?php echo base_url('admin/donation/getDonationData')?>",
            "type": "POST",
            "data": function ( data ) {
                data.ref_no = $('#ref_noFilter').val();
                data.name = $('#nameFilter').val();
                data.phone = $('#phoneFilter').val();
                data.city = $('#cityFilter').val();
                data.category = $('#categoryFilter').val();
                data.payment = $('#paymentFilter').val();
                data.collection = $('#collectionFilter').val();
                data.amount = $('#amountFilter').val();
                data.date = $('#dateFilter').val();
            }, 
            
            "dataSrc": function(json) {
            var filters = [
                $('#donationTableID_filter input').val(),
                $('#ref_noFilter').val(),
                $('#nameFilter').val(),
                $('#phoneFilter').val(),
                $('#cityFilter').val(),
                $('#categoryFilter').val(),
                $('#paymentFilter').val(),
                $('#collectionFilter').val(),
                $('#amountFilter').val(),
                $('#dateFilter').val()
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

        "columnDefs": [
        { 
            "targets": [ 0 ],
            "orderable": false,
        },
        ],

        "columns": [
            { "data": "0", "name": "" },
            { "data": "1", "name": "app_donation.ref_no" },
            { "data": "2", "name": "name" },
            { "data": "3", "name": "app_donation.phone" },
            { "data": "4", "name": "app_donation.city" },
            { "data": "5", "name": "app_donation_category.title" },
            { "data": "6", "name": "app_accounts.name" },
            { "data": "7", "name": "collected_by" },
            { "data": "8", "name": "app_donation.amount" },
            { "data": "9", "name": "app_donation.date" },
            { "data": "10", "name": "app_donation.details" },
            { "data": "11", "name": "" },
        ],

        "lengthMenu": [[10, 25, 50,100,200,300, -1], [10, 25, 50,100,200,300, "All"]],
        
    });

$('#ref_noFilter, #nameFilter, #phoneFilter, #cityFilter, #categoryFilter, #paymentFilter, #collectionFilter, #amountFilter, #dateFilter').on('input', function () {
    dataTable.ajax.reload();
});

// });

</script>
