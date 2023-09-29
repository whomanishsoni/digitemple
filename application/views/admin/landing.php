<?php
$company_name = dt_get_CompanyName();
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="<?php echo dt_get_fevicon(); ?>" />
    <title><?php echo $company_name; ?></title>

    <link href="<?php echo base_url('assets/global/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets/admin/css/color.css'); ?>">
</head>

<body>

    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="text-center  p-3" style="background-color:#8D2424;color:white">
                    <h2><?php echo $company_name; ?> द्वारा आपका हार्दिक स्वागत है |</h2>
                </div>
                <div class="text-center" style="max-width:100%;">
                    <img class="" alt="<?php echo $company_name; ?>" src="<?php echo dt_get_CompanyLogo(); ?>" style="max-width:100%;background-size:cover" />
                </div>
                <audio id="my_audio" src="<?php echo base_url("assets/uploads/Sanwariyo_He _Seth.mp3") ?>" loop="loop"></audio>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/global/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/js/bootstrap.bundle.min.js'); ?>"></script>

</body>
<script>
    window.onload = function() {
        document.getElementById("my_audio").play();
    }
    const myTimeout = setTimeout(function() {
        window.location.href = "dashboard";
    }, 10000);
</script>

</html>