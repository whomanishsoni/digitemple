<?php
include VIEWPATH . 'admin/header.php';
?>

    <div class="container  content-area">
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/language'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('language') ?></a></li>
                </ol>
                <div class="ml-auto">
                    <a href="<?php echo base_url('admin/add-language'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('language'); ?> </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <?php echo dt_translate('language') ?>
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('message'); ?>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center font-bold dark-grey-text">#</th>
                                        <th class="text-center font-bold dark-grey-text"><?php echo dt_translate('title'); ?></th>
                                        <th class="text-center font-bold dark-grey-text"><?php echo dt_translate('status'); ?></th>
                                        <th width="350" class="text-center font-bold dark-grey-text"><?php echo dt_translate('action'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($language_data) && count($language_data) > 0) {

                                        foreach ($language_data as $key => $row) {

                                            $update_url = 'admin/update-language/' . $row['id'];
                                            $translate_url = 'admin/language-translate/' . $row['id'];
                                            if ($row['status'] == "A") {
                                                $status_string = '<span class="badge badge-success">' . dt_translate('active') . '</span>';
                                            } else {
                                                $status_string = '<span class="badge badge-danger">' . dt_translate('inactive') . '</span>';
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $key + 1; ?></td>
                                                <td class="text-center"><?php echo escape_data($row['title']); ?></td>
                                                <td class="text-center"><?php echo $status_string; ?></td>
                                                <td class="td-actions text-center" >
                                                    <a href="<?php echo base_url($update_url); ?>" class="btn btn-primary btn-sm" title="<?php echo dt_translate('edit'); ?>"><?php echo dt_translate('edit'); ?></a>
                                                    <a href="<?php echo base_url($translate_url); ?>" class="btn btn-info btn-sm" title="<?php echo dt_translate('translate_word'); ?>">Add Translation</a>
                                                    <a href="javascript:void(0)" data-action="delete-language" data-toggle="modal" onclick='DeleteConfirm(this)' data-target="#delete-record" data-id="<?php echo (int) $row['id']; ?>"  class="btn btn-danger btn-sm"><?php echo dt_translate('delete') ?></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
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

            <div class="container">

            </div>
        </div>
    </div>
</div>
<?php
include VIEWPATH . 'admin/footer.php';
?>