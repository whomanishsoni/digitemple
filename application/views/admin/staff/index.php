<?php
include VIEWPATH . 'admin/header.php';
?>

<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/staff'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('staff') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/add-staff'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('staff'); ?> </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">



                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="">
                                <p class="mb-1"><?php echo dt_translate('staff'); ?></p>
                                <h4 class="mb-1"><span class="number-font "><?php echo $total_staff; ?></span></h4>
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
                        <a href="#">
                            <div class="d-flex">
                                <div class="">
                                    <p class="mb-1"><?php echo dt_translate('total') . " " . dt_translate('amount'); ?></p>
                                    <h4 class="mb-1"><span class="number-font "><?php echo dt_price_format($total_amount); ?></span></h4>
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
                        <a href="3">
                            <div class="d-flex">
                                <div class="">
                                    <p class="mb-1"><?php echo dt_translate('total') . " " . dt_translate('paid'); ?></p>
                                    <h4 class="mb-1"><span class="number-font "><?php echo dt_price_format($total_paid); ?></span></h4>
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
            <?php if ($this->login_type == 'A') : ?>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="#">
                                <div class="d-flex">
                                    <div class="">
                                        <?php
                                        $due = $total_amount - $total_paid;
                                        $bg = "bg-red";
                                        $color = "text-red font-weight-bold";
                                        ?>

                                        <p class="mb-1 <?php echo $color; ?>"><?php echo dt_translate('total_due'); ?></p>
                                        <h4 class="mb-1 <?php echo $color; ?>"><span class="number-font "><?php echo $due; ?></span></h4>
                                    </div>
                                    <div class="ml-auto">
                                        <div class="feature">
                                            <div class="fa fa-reply-all fa-lg fa-2x icon <?php echo $bg; ?> icon-service"> <i class="mdi mdi-auto-fix fa-stack-1x text-white"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php $this->load->view('message'); ?>
                        <div class="table-responsive">
                            <!-- <table id="example" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th><?php echo dt_translate('name') ?></th>
                                        <th class="text-center"><?php echo dt_translate('phone') ?></th>
                                        <th class="text-center"><?php echo dt_translate('city') ?></th>
                                        <th class="text-center"><?php echo dt_translate('status') ?></th>
                                        <th class="text-center"><?php echo dt_translate('amount') ?></th>
                                        <th class="text-center"><?php echo dt_translate('total_donate') ?></th>
                                        <th class="text-center"> <?php echo date("Y"); ?> </th>
                                        <th class="text-center"><?php echo dt_translate('due_amount') ?></th>
                                        <th class="text-center"><?php echo dt_translate('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($admin_data) && count($admin_data) > 0) : ?>
                                        <?php foreach ($admin_data as $key => $val) :
                                            $key++;
                                        ?>
                                            <tr>
                                                <td><?php echo $key; ?></td>
                                                <td><?php echo escape_data($val['first_name']) . " " . escape_data($val['last_name']) ?></td>
                                                <td class="text-center"> <a href="tel:<?php echo escape_data($val['phone']); ?>"> <?php echo escape_data($val['phone']); ?> </a></td>
                                                <td class="text-center"><?php echo escape_data($val['city']); ?></td>
                                                <td class="text-center">
                                                    <?php echo dt_get_status_badge($val['status']) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $val['amount'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $val['total_donate']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $val['year_donate']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($val['amount']) {
                                                        $due_amount = $val['amount'] - $val['total_donate'];
                                                        echo "<span style='font-weight:bold;color:red'>$due_amount</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('admin/add-donation?id=' . $val['id']); ?>" class="btn btn-success btn-sm"><?php echo dt_translate('add_donation') ?></a>
                                                    <a href="<?php echo base_url('admin/donator-donation/' . $val['id']); ?>" class="btn btn-info btn-sm"><?php echo dt_translate('donation') ?></a>
                                                    <?php
                                                    if ($val['id'] != 1) {
                                                    ?>
                                                        <a href="<?php echo base_url('admin/update-staff/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                        <a href="javascript:void(0)" data-action="delete-staff" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>" class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table> -->

                            <?php
                            $cityList = array();
                            foreach ($admin_data as $val) {
                                $cityList[] = $val['city'];
                            }

                            $uniqueCityList = array_unique($cityList);
                            ?>

                            <span id="totalAmount">Total Amount: ₹0.00</span>

                            <table id="staffTableID" class="table table-bordered text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">
                                            <input type="text" id="nameFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Name') ?>">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" id="phoneFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Phone') ?>">
                                        </th>
                                        <th class="text-center">
                                            <select id="cityFilter" class="form-control form-control-sm">
                                                <option value="">Select City</option>
                                                <?php
                                                foreach ($uniqueCityList as $city) {
                                                    echo '<option value="' . htmlspecialchars($city) . '">' . htmlspecialchars($city) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </th>
                                        <th class="text-center">
                                            <input type="text" id="statusFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Status') ?>">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" id="amountFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Amount') ?>">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" id="totalDonateFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Total Donate') ?>">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" id="yearFilter" class="form-control form-control-sm" placeholder="<?php echo date("Y"); ?>">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" id="dueAmountFilter" class="form-control form-control-sm" placeholder="<?php echo dt_translate('Due Amount') ?>">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo dt_translate('name') ?></th>
                                        <th class="text-center"><?php echo dt_translate('phone') ?></th>
                                        <th class="text-center"><?php echo dt_translate('city') ?></th>
                                        <th class="text-center"><?php echo dt_translate('status') ?></th>
                                        <th class="text-center"><?php echo dt_translate('amount') ?></th>
                                        <th class="text-center"><?php echo dt_translate('total_donate') ?></th>
                                        <th class="text-center"> <?php echo date("Y"); ?> </th>
                                        <th class="text-center"><?php echo dt_translate('due_amount') ?></th>
                                        <th class="text-center"><?php echo dt_translate('action') ?></th>
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
    var dataTable = $('#staffTableID').DataTable({ 

        "processing": true,
        "serverSide": true,
        "searching": true,
        "order": [],
        "searchDelay": 1000,

        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var columnToSum = 5;
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
            "url": "<?php echo base_url('admin/staff/getStaffData')?>",
            "type": "POST",
            "data": function ( data ) {
                data.name = $('#nameFilter').val();
                data.phone = $('#phoneFilter').val();
                data.city = $('#cityFilter').val();
                data.status = $('#statusFilter').val();
                data.amount = $('#amountFilter').val();
                data.totalDonate = $('#totalDonateFilter').val();
                data.year = $('#yearFilter').val();
                data.dueAmount = $('#dueAmountFilter').val();
            },

            "dataSrc": function(json) {
            var filters = [
                $('#staffTableID_filter input').val(),
                $('#nameFilter').val(),
                $('#phoneFilter').val(),
                $('#cityFilter').val(),
                $('#statusFilter').val(),
                $('#amountFilter').val(),
                $('#totalDonateFilter').val(),
                $('#yearFilter').val(),
                $('#dueAmountFilter').val()
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
            { "data": "1", "name": "name" },
            { "data": "2", "name": "app_admin.phone" },
            { "data": "3", "name": "app_admin.city" },
            { "data": "4", "name": "app_admin.status" },
            { "data": "5", "name": "app_admin.amount" },
            { "data": "6", "name": "" },
            { "data": "7", "name": "" },
            { "data": "8", "name": "" },
            { "data": "9", "name": "" },
        ],

        "lengthMenu": [[10, 25, 50,100,200,300, -1], [10, 25, 50,100,200,300, "All"]],

    });

    $('#nameFilter, #phoneFilter, #cityFilter, #statusFilter, #amountFilter, #totalDonateFilter, #yearFilter, #dueAmountFilter').on('input', function () {
    dataTable.ajax.reload();
    });

// });

</script>