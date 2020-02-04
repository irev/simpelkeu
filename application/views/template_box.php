<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$uri = $this->uri->segment(1);
$isTouch1 = (!empty($segment1)? $segment1 :'');
$isTouch2 = (!empty($segment2)? $segment2 :'');
$isTouch3 = (!empty($segment3)? $segment3 :'');

?>
<!-- Content Header (Page header) -->
<?php 
//$this->load->view($uri.'/inc_header'); 
?>
<!-- Main content -->
<section class="content-header">
    <h1>
    <?php 
      echo lang('index_heading'); 
      echo (isset($title)? strtoupper(str_replace('_' ,' ', $title)) : '' );
    ?>
        <small> <?php echo lang('index_subheading');?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= $isTouch1 ?></a></li>
        <li><a href="#"><?= $isTouch2 ?></a></li>
        <li class="active"><?= $isTouch3 ?></li>
    </ol>
</section>

<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
            <?php    
            if(isset($headerBox)){
                echo $headerBox;
            }
            ?>
                <?php echo lang('index_heading');?>
            </h3>

            <div class="box-tools pull-right">
            <?php    
            if(isset($headButton)){
                echo $headButton;
            }
            ?>
            </div>
        </div>
        <div class="box-body">
            <!-- PAGE contents -->
                <?php
                    echo $contents;
                ?>
            <!-- END PAGE contents -->  
            </div><!-- /.box-body -->
        <div class="box-footer">
            <?php
            if(isset($footer)){
                echo $footer;
            }
            ?>
        </div><!-- /.box-footer-->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->          

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


