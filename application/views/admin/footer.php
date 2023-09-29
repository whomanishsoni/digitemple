</div>
<div class="modal fade" id="delete-record">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $attributes = array('id' => 'DeleteRecordForm', 'name' => 'DeleteRecordForm', 'method' => "post");
            echo form_open('', $attributes);
            ?>
            <input type="hidden" id="record_id"/>
            <input type="hidden" id="form_action"/>
            <div class="modal-header">
                <h4 id='some_name' class="modal-title font_size_18"><?php echo dt_translate('delete'); ?></h4>
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center font-size-lg"><?php echo dt_translate('delete_confirm'); ?></h5>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary font_size_12" onclick="DeleteRecord()" href="javascript:void(0)" id="RecordDelete" ><?php echo dt_translate('confirm'); ?></a>
                <button data-dismiss="modal" class="btn btn-danger font_size_12" type="button"><?php echo dt_translate('close'); ?></button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">&COPY; <?php echo date('Y') . " " . dt_get_CompanyName(); ?>. <?php echo dt_translate('rights_reserved_message') ?></div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
</div>
<!-- BACK-TO-TOP -->
<a href="index.html#top" id="back-to-top" style="display: none;">
    <i class="fa fa-angle-double-up"></i>
</a> <!-- JQUERY SCRIPTS JS-->

<script src="<?php echo base_url('assets/global/js/jquery-3.4.1.min.js');?>"></script>
<script src="<?php echo base_url('assets/global/js/bootstrap.bundle.min.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo base_url('assets/global/js/jquery.validate.min.js');?>"></script>
<?php
include VIEWPATH . 'validation_js_message.php';
?>
<script src="<?php echo base_url('assets/global/js/additional-methods.min.js');?>"></script>

<script src="<?php echo base_url('assets/admin/js/jquery.sparkline.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/circle-progress.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/utils.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/jquery.peity.min.js');?>"></script>

<script src="<?php echo base_url('assets/plugin/datatable/js/jquery.dataTables.js');?>"></script>
<script src="<?php echo base_url('assets/plugin/datatable/js/dataTables.bootstrap4.min.js');?>"></script>

<script src="<?php echo base_url('assets/admin/js/horizontal-menu.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/irregular-data-series.js');?>"></script>

<script src="<?php echo base_url('assets/admin/js/p-scroll.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/right-sidebar.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/waypoints.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/stiky.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/switcher.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/custom.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/functions.js');?>"></script>
</div>
</body>
</html>