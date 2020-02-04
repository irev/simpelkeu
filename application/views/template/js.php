</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b><?= _APLIKASI_ ?> </b>ver 2.0 <b>Framework CI</b> <?php echo CI_VERSION; ?> 
    </div>
    <strong>Copyright &copy; 2018-<?=date('Y')?> <?= _AUTHOR_ ?>. </strong> All rights reserved.
    <p><?php 
    $ses = $this->session->all_userdata();
    $user_id = $this->session->userdata('user_id');
    $user_groups = $this->ion_auth->get_users_groups($user_id)->result();
    foreach ($user_groups as $value){ 
        $array[] = $value->name;
    }
    if(in_array('admin', $array)){
      echo 'admin access-control-allow-admin '; 
      var_dump($ses); 
    }
    ?></p>
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>"></script>
<!--js-yaml https://nodeca.github.io/js-yaml/ -->
<script src="<?php echo base_url('assets/js/js-yaml.min.js') ?>"></script>
<!--select2 https://select2.org/ -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.js') ?>"></script>


<!-- InputMask -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.date.extensions.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.extensions.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                //startDate: new Date(),
                todayHighlight: true,
            });

            /////////////////////
            // setting select2 
            /////////////////////
            $('.select2').select2({
                width: 'resolve'
            });
            ///// Get event select2
            $('.select2').on('select2:select', function (e) {
                var data = e.params.data;
                //console.log(data);
                //set text to input 
                $('.select2-setText').val(data.title);
            });

            /// Animated scroll to #anchor / id function with jQuery
            $( "a.scrollLink" ).click(function( event ) {
                event.preventDefault();
                $("html, body").animate({ scrollTop: $($(this).attr("href")).offset().top }, 500);
            });


        });
    </script>            