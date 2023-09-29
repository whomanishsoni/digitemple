<?php
include VIEWPATH . 'front/theme1/header.php';
?>
<div class="container padding_top_7">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb_background">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo dt_translate('home') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo dt_translate('terms_and_conditions') ?></li>
        </ol>
    </nav>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-12 ftco-animate">
                <h2 class="mb-4"><?php echo dt_translate('terms_and_conditions') ?></h2>
                <?php echo isset($terms['description'])?$terms['description']:""; ?>
            </div>
        </div>
    </div>
</section>
<?php
include VIEWPATH . 'front/theme1/footer.php';
?>
