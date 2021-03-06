

<section class="content-header">
    <h1>
        Users 
        <small> users_list </small>
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
            <h3 class="box-title">USERS</h3>
            <div class="box-tools pull-right">
            <?php echo anchor('users/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('users/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
		<?php echo anchor(site_url('users/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?>
		<?php echo anchor(site_url('users/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?>        
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

        </style>

        <div class="row" style="margin-bottom: 10px">
            <!--div class="col-md-4">
                <h2 style="margin-top:0px">Users List</h2>
            </div-->
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Ip Address</th>
		    <th>Username</th>
		    <th>Password</th>
		    <th>Email</th>
		    <th>Activation Selector</th>
		    <th>Activation Code</th>
		    <th>Forgotten Password Selector</th>
		    <th>Forgotten Password Code</th>
		    <th>Forgotten Password Time</th>
		    <th>Remember Selector</th>
		    <th>Remember Code</th>
		    <th>Created On</th>
		    <th>Last Login</th>
		    <th>Active</th>
		    <th>First Name</th>
		    <th>Last Name</th>
		    <th>Company</th>
		    <th>Phone</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>

        </div><!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div><!-- /.box-footer-->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->

 




<?php
/* End of file users/users_list */
/* Location: ./application/views/users/users_list */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-15 21:27:31 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 15 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
