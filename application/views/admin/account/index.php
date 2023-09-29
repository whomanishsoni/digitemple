<?php
include VIEWPATH . 'admin/header.php';
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/account'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('account') ?></a></li>
                </ol>
                <div class="ml-auto">
                    <a href="<?php echo base_url('admin/add-account'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('account'); ?> </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <div class="table-responsive">
                                <!-- <table class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th><?php echo dt_translate('name')?></th>
                                        <th>Balance</th>
                                        <th class="text-center"><?php echo dt_translate('action')?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($admin_data) && count($admin_data) > 0): ?>
                                        <?php foreach ($admin_data as $key=>$val):
                                            $key++;
                                            ?>
                                            <tr>
                                                <td><?php echo $key; ?></td>
                                                <td><?php echo escape_data($val['name']); ?></td>
                                                <td>
                                                    <?php echo account_balance($val['id']);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if($this->session->userdata('ADMIN_ID')==1) {
                                                    ?>
                                                        <a href="<?php echo base_url('admin/update-account/' . $val['id']); ?>" class="btn btn-primary btn-sm"><?php echo dt_translate('update') ?></a>
                                                        <a href="javascript:void(0)" data-action="delete-account" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $val['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a> 
                                                    <?php 
                                                    }
                                                    ?>
                                                    
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table> -->


                                <table id="accountTableID" class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo dt_translate('name')?></th>
                                            <th>Balance</th>
                                            <th class="text-center"><?php echo dt_translate('action')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

<script type="text/javascript">

// $(document).ready(function() {

    var dataTable = $('#accountTableID').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('admin/account/getAccountData')?>",
            "type": "POST",
            "data": function ( data ) {
            // data.Name = $('#name').val();
            // data.Balance = $('#balance').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
        "lengthMenu": [[10, 25, 50,100,200,300, -1], [10, 25, 50,100,200,300, "All"]],

        });

        $('#accountTableID_filter input').on('input', function () {
            var searchValue = this.value;
            if (searchValue.length >= 3) {
                    dataTable.search(searchValue).draw();
                } else if (searchValue.length === 0) {
                    dataTable.search('').draw(); 
                }
        });

// });

</script>