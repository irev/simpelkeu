

<section class="content-header">
    <h1>
        Paket 
        <small> tbpaket_list </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">PAKET</h3>
            <div class="box-tools pull-right">
            <?php echo anchor('paket/intro/','Create',array('class'=>'btn btn-danger btn-sm'));?>
            <?php echo anchor(site_url('paket/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
            <?php echo anchor(site_url('paket/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?>        
            </div>
        </div>
        <div class="box-body">

        
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <style>
            .dataTables_wrappers {
                min-height: 500px
            }
            
            .dataTables_processing {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100%;
                margin-left: -50%;
                margin-top: -25px;
                padding-top: 20px;
                text-align: center;
                font-size: 1.2em;
                color:grey;
            }

            .box .dataTables_processing .overlay {
                pointer-events: none;
                z-index: 1010;
                background: rgba(255,255,255,0.7);
                border-radius: 3px;
            }
            .box .dataTables_processing>.overlay, .box>.loading-img, .overlay-wrapper>.loading-img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none !important;
            }

        </style>

        <div class="row" style="margin-bottom: 10px">
            <!--div class="col-md-4">
                <h2 style="margin-top:0px">Tbpaket List</h2>
            </div-->
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
	    </div>
        </div>
        <div class="text-center">
            <?php
            if($this->ion_auth->is_admin()){
                
                $color  = array('btn-primary','btn-warning','btn-danger','btn-success');
                $bidang = $this->db->get('groups')->result();
                //print_r($bidang);
                foreach ($bidang as $bid) {
                    $n=rand(0,3);
                    
                    if($bid->name != 'admin' && $bid->name != 'members'){
                        if( current($color) == 'btn-success'){
                            $btn = reset($color);
                        }else{
                            $btn = next($color);
                        }
                        echo ' '.anchor('paket?bidang='.$bid->name, $bid->name,array('class'=>'btn '.$btn.' btn-sm'));
                    
                    }
                }
            }
            ?>
        </div>    
        <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>NmPaket</th>
		    <th>Tahun</th>
		    <th>Md5namatahun</th>
		    <th>Bidang</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>
        </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div><!-- /.box-footer-->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->

 




<?php
/* End of file tbpaket/tbpaket_list */
/* Location: ./application/views/tbpaket/tbpaket_list */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:20:41 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
