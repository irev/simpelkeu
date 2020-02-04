<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$uri = $this->uri->segment(1);

?>
<!-- Content Header (Page header) -->
<?php 
$this->load->view($uri.'/inc_header'); 
?>
<!-- Main content -->
        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-md-12">
            <!-- PAGE contents -->
                <?php
                echo $contents;
                ?>
            <!-- END PAGE contents --> 

          </div>
          </div>
        </section>  

        

<?php 
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<?php 
$file = $this->uri->segment(1);
$this->load->view($file.'/custom_js');
?>
<?php
$this->load->view('template/foot');
?>


