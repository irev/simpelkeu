<?php
if (!$this->ion_auth->logged_in())
{
    redirect('auth/login');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= _APLIKASI_ ?> <?= _VERSION_ ?> | <?= $title ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="icon" href="<?= base_url(); ?>favicon.ico" type="image/gif" sizes="16x16">
        <style>
        html{
            scroll-behavior: smooth;
        }
      
        .select2-container--default> .select2-results__option--highlighted[aria-selected]:hover {
            background-color: #000000;
            color: white;
        }
        .select2-container--default > .select2-results__option--highlighted[aria-selected]{
            background-color: #000000;
            color: white;
        }
        /*
        .select2-results__option, .select2-container--default .select2-results__option:hover {
            background-color: #000000;
            color: #fff;
        }
        .select2-results__option{
            background-color: #fff;
            color: #000;
        }
        */
        </style>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/ionicons-2.0.1/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet"/>
        <!--select2-->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.css') ?>" rel="stylesheet"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]--> 