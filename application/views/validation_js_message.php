<script>
    jQuery.extend(jQuery.validator.messages, {
        required:"<?php echo dt_translate('required_message'); ?>",
        remote: "<?php echo dt_translate('already_exist'); ?>",
        email: "<?php echo dt_translate('enter_valid_email'); ?>",
        equalTo: "<?php echo dt_translate('password_equal'); ?>",
        maxlength: "<?php echo dt_translate('maxlength_msg'); ?>",
        minlength: "<?php echo dt_translate('minlength_msg'); ?>",
        max: "<?php echo dt_translate('max_msg'); ?>",
        min: "<?php echo dt_translate('min_msg'); ?>",
        url:"<?php echo dt_translate('valid_url'); ?>"
    });
</script>