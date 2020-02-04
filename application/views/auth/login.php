<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= _APLIKASI_ ?> | Log in</title>
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
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url(); ?>"><b>HALAMAN</b> LOGIN</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"><?php echo $message; ?></p>
                <?php echo form_open('auth/login'); ?>
                <div class="form-group has-feedback">
                    <?php echo form_input($identity); ?>

                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?php echo form_input($password); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                <?php
                $options=[];
                for ($i=2020; $i < date('Y')+2; $i++) { 
                    # code...
                   $options[$i] = $i;
                }
                //var_dump($options);
                ?>
                    <?php echo form_dropdown($tahun, $options, date('Y')); ?>
                    <span class="glyphicon  form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?php echo form_checkbox('remember', '1', FALSE, '"id"="remember"');?> INGAT SAYA
                </div>
                <div class="row">

                    <div class="col-xs-12">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> LOGIN</button>
                    </div><!-- /.col -->

                </div>
                </form>



            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->


        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>

        <!-- iCheck -->
        <!--script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js'); ?>"></script-->
        <!--script src="<?php echo base_url(); ?>template/plugins/iCheck/icheck.min.js"></script-->
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
