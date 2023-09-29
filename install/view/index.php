<?php
$domain = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

$domain = preg_replace('/index.php.*/', '', $domain); //remove everything after index.php
if (!empty($_SERVER['HTTPS'])) {
    $domain = 'https://' . $domain;
} else {
    $domain = 'http://' . $domain;
}
$new_domain = str_replace('install/', 'admin/login', $domain);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Donation Manager</title>
        <link rel="icon" href="fevicon.png" type="image/x-icon">

        <link href="../assets/global/css/font-awesome.css" rel="stylesheet" />
        <link href="../assets/global/css/bootstrap.css" rel="stylesheet" />
        <link href="../assets/global/css/donation.css" rel="stylesheet" />

        <link href="install.css" rel="stylesheet">

        <script src="../assets/global/js/jquery-3.4.1.min.js"></script>
        <script src="../assets/global/js/jquery.validate.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="ui/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="jquery.wizard.js"></script>


        <script src="jquery.form.js" type="text/javascript"></script>

        <script src="../assets/global/js/popper.min.js"></script>
        <script src="../assets/global/js/bootstrap.min.js"></script>
        <script src="install.js"></script>

        <style>
            .error{
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="loadingmessage" id="loadingmessage"></div>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo isset($new_domain) ? $new_domain : ""; ?>" />
        <div class="install-box">

            <div class="panel panel-install">
                <div class="panel-heading text-center">                    
                    <h2> Donately - Donation Manager Installation </h2>
                    <div class="alert alert-danger" id="dashboard-error" style="display: none;">
                        <i class="fa fa-warning"></i>
                        Access denied for installation please check.
                    </div>
                </div>

                <div class="panel-body no-padding">
                    <div id="alert-container"></div>
                    <div id="form_wizard" >
                        <form name="config-form" id="config-form" action="do_install.php" method="post" enctype="multipart/form-data">
                            <div class="step">
                                <div class="col-md-12">
                                    <h4 class="font-bold"><strong> System Requirement</strong></h4>
                                </div>

                                <div class="section">
                                    <p>1. Please configure your PHP settings to match following requirements:</p>
                                    <hr />
                                    <table>
                                        <thead>
                                        <tr>
                                            <th width="25%">PHP Settings</th>
                                            <th width="27%">Current Version</th>
                                            <th>Required Version</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PHP Version</td>
                                            <td><?php echo $current_php_version; ?></td>
                                            <td><?php echo $php_version_required; ?>+</td>
                                            <td class="text-center">
                                                <?php if ($php_version_success) { ?>
                                                    <i class="status fa fa-check-circle-o"></i>
                                                <?php } else { ?>
                                                    <i class="status fa fa-times-circle-o"></i>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="section">
                                    <p>2. Please make sure the extensions/settings listed below are installed/enabled:</p>
                                    <hr/>
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th width="25%">Extension/settings</th>
                                                <th width="27%">Current Settings</th>
                                                <th>Required Settings</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>MySQLi</td>
                                                <td> <?php if ($mysql_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($mysql_success) { ?>
                                                        <i class="status fa fa-check-circle-o"></i>
                                                    <?php } else { ?>
                                                        <i class="status fa fa-times-circle-o"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>cURL</td>
                                                <td> <?php if ($curl_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($curl_success) { ?>
                                                        <i class="status fa fa-check-circle-o"></i>
                                                    <?php } else { ?>
                                                        <i class="status fa fa-times-circle-o"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mod Rewrite</td>
                                                <td> <?php if ($isEnabled) { ?>
                                                        Enabled
                                                    <?php } else { ?>
                                                        Disabled
                                                    <?php } ?>
                                                </td>
                                                <td>Enabled</td>
                                                <td class="text-center">
                                                    <?php if ($isEnabled) { ?>
                                                        <i class="status fa fa-check-circle-o"></i>
                                                    <?php } else { ?>
                                                        <i class="status fa fa-times-circle-o"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="section">
                                    <p>3. Please make sure you have set the <strong>writable</strong> permission on the following folders/files:</p>
                                    <hr />
                                    <div class="table-responsive">
                                        <table>
                                            <tbody>
                                            <?php
                                            foreach ($writeable_directories as $value) {
                                                ?>
                                                <tr>
                                                    <td style="width:87%;"><?php echo $value; ?></td>
                                                    <td class="text-center">
                                                        <?php if (is_writeable(".." . $value)) { ?>
                                                            <i class="status fa fa-check-circle-o"></i>
                                                            <?php
                                                        } else {
                                                            $all_requirement_success = false;
                                                            ?>
                                                            <i class="status fa fa-times-circle-o"></i>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr/>
                                    <br/>

                                </div>
                            </div>

                            <div class="step" >
                                <div class="col-md-12">
                                    <h4 class="font-bold"><strong>Configuration</strong></h4>
                                </div>
                                <div class="section clearfix">
                                    <p>1. Please enter your database connection details.</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="host">Database Host</label>
                                                <input autocomplete="off" type="text" required="required" value="" id="host"  name="host" class="form-control validate" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="dbuser">Database User</label>
                                                <input autocomplete="off"  type="text" required="required" value="" name="dbuser" class="form-control validate" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="dbpassword">Password</label>
                                                <input autocomplete="off"  type="text"  value="" name="dbpassword" class="form-control" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="dbname">Database Name</label>
                                                <input autocomplete="off"  type="text" required="required" value="" name="dbname" class="form-control validate"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section clearfix">
                                    <p>2. Please enter your account details for administration.</p>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="first_name">First Name</label>
                                                <input  autocomplete="off" type="text" required="required" value=""  id="first_name"  name="first_name" class="form-control validate" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="last_name">Last Name</label>
                                                <input autocomplete="off"  type="text" required="required"  value="" id="last_name"  name="last_name" class="form-control validate" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group  mt-3">
                                                <label for="email">Email</label>
                                                <input autocomplete="off"  type="email" required="required" value="" name="email" class="form-control validate"  />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="password">Password</label>
                                                <input autocomplete="off"  type="text" required="required" value="" name="password" class="form-control validate" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <br/>
                                </div>
                            </div>

                            <div class="step" >
                                <div class="col-md-12">
                                    <h4 class="font-bold"><strong>Site Setting</strong></h4>
                                </div>
                                <div class="section clearfix">
                                    <p>1. Please enter your site details.</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="sitename">Site Name</label>
                                                <input  autocomplete="off" type="text" required="required" value="" id="sitename"  name="sitename" class="form-control validate" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label for="siteemail">Site Email</label>
                                                <input autocomplete="off"  type="email" required="required" value="" name="siteemail" class="form-control validate" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <label>Logo</label>
                                                <input class="form-control" onchange="readURL(this)" id="imageurl" required="required"  type="file" name="logo" accept="image/x-png,image/gif,image/jpeg,image/png"  extension="jpg|png|gif|jpeg" />
                                            </div>
                                            <div class="error" id="logo_validate"></div>
                                            <small><strong>(Size must be minimum of 241*61)</strong></small>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <img id="imageurl"  class="img-fluid d-none" src="../assets/images/no-image.png" alt="Image">
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <br/>
                                </div>
                            </div>

                            <div class="step" >
                                <div class="col-md-12">
                                    <h4 class="font-bold"><strong>Email Setting</strong></h4>
                                </div>
                                <div class="section clearfix">
                                    <p>1. Please enter your email details.</p>
                                    <hr>
                                    <div class="form-group">
                                        <label>Mail Type</label>
                                        <div class="form-group form-inline">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input  class="custom-control-input"name='mail_type' checked="" type='radio' onclick="func_smtp()" value='S' id='inactive'>
                                                    <label class="custom-control-label"  for='inactive'>SMTP</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" name='mail_type' value="P" type='radio' onclick="func_php()" id='active'>
                                                    <label  class="custom-control-label" for="active">PHP Mailer</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="php_block" style="display: none">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="email_from">From email</label>
                                                    <input  autocomplete="off" type="email" required="required" value="" id="email_from"  name="email_from" class="form-control validate" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="smtp_block">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="smtp_host">SMTP Host</label>
                                                    <input autocomplete="off"  type="text" required="required" value="" id="smtp_host"  name="smtp_host" class="form-control validate" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="smtp_username">SMTP Username</label>
                                                    <input  autocomplete="off" type="text" required="required" value="" name="smtp_username" class="form-control validate"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="smtp_password">SMTP Password</label>
                                                    <input  autocomplete="off" type="password" required="required" value="" name="smtp_password" class="form-control validate" autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="smtp_port">SMTP Port</label>
                                                    <input  autocomplete="off" type="number" required="required" value="" name="smtp_port" class="form-control validate"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="md-form">
                                                    <label>Select SMTP Secure</label>
                                                    <select name="smtp_secure" id="smtp_secure" class="form-control">
                                                        <option value="tls">TLS</option>
                                                        <option value="ssl">SSL</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <div class="form-group">
                                                <button type="submit" id="submit_btn" class="btn btn-primary">Submit & Install Script</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <br/>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col clearfix">
                                    <div class="navigation float-left">
                                        <button type="button" <?php
                                        if (!$all_requirement_success) {
                                            echo "disabled=disabled";
                                        }
                                        ?>  name="backward" class="backward btn btn-info"><i class="fa fa-arrow-left"></i> <b>BACK</b></button>
                                    </div>
                                </div>
                                <div class="col clearfix">
                                    <div class="navigation float-right">
                                        <button type="button" name="forward" class="forward btn btn-primary"><b>NEXT</b> <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </body>
</html>