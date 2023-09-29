<?php
include VIEWPATH . 'admin/header.php';
$folder_name = 'admin';
?>
<input type="hidden" id="record_update_hidden" value="<?php echo dt_translate('record_update'); ?>">
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home mr-1"></i> <?php echo dt_translate('dashboard'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('admin/language'); ?>"><?php echo dt_translate('manage') . " " . dt_translate('language') ?></a></li>
            </ol>
            <div class="ml-auto">
                <a href="<?php echo base_url('admin/add-language'); ?>" class="btn btn-primary btn-icon btn-sm text-white mr-2"> <span> <i class="fa fa-plus"></i> </span> <?php echo dt_translate('add') . " " . dt_translate('language'); ?> </a>
                <a href="<?php echo base_url('admin/add-language'); ?>" class="btn btn-info btn-icon btn-sm text-white mr-2"><i class="fa fa-arrow-left"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo dt_translate('dt_translate') . " " . ($language_data['title']) . " " . dt_translate('words'); ?>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="text-center font-bold dark-grey-text">#</th>
                                <th class="text-center font-bold dark-grey-text"><?php echo dt_translate('title'); ?></th>
                                <th width="100" class="text-center font-bold dark-grey-text"><?php echo dt_translate('action'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            if (isset($words) && count($words) > 0) {

                                foreach ($words as $key => $row) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $key + 1; ?></td>
                                        <td class="text-left">
                                            <?php echo ($row['english']); ?><br/><br/>
                                            <input autocomplete="off" id="db_field_<?php echo $row['id']; ?>" value="<?php echo isset($row[$language_data['db_field']]) ? stripslashes($row[$language_data['db_field']]) : ""; ?>" name="dt_translated_word[]" class="form-control"/>
                                        </td>

                                        <td class="td-actions text-center" w>
                                            <a href="javascript:void(0)" data-id="<?php echo trim($row['id']); ?>" data-field="<?php echo trim($language_data['db_field']); ?>" class="btn btn-primary btn-sm" onclick="save_translated_lang(this)" title="<?php echo dt_translate('dt_translate_word'); ?>"><?php echo dt_translate('save'); ?></a>
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
<?php
include VIEWPATH . 'admin/footer.php';
?>
<script src="<?php echo base_url('assets/admin/js/language.js') ?>"></script>
