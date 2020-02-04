<!--section class="content-header">
    <h1>
        Simda 
        <small> simda_list </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section-->

<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">SIMDA</h3>
            <div class="box-tools pull-right">
                <?php echo anchor('simda/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
                <?php echo anchor(site_url('simda/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
                <?php echo anchor(site_url('simda/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?>
            </div>
        </div>
        <div class="box-body">


            <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
            <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>" />
            <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>" />
            <style>
            .dataTables_wrappers {
                min-height: 500px
            }

            /*
            .dataTables_processing {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100%;
                height: 100%;
                margin-left: -50%;
                margin-top: -25px;
                padding-top: 20px;
                text-align: center;
                font-size: 1.2em;
                background-color: white;
                background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255,255,255,0)), color-stop(25%, rgba(255,255,255,0.9)), color-stop(75%, rgba(255,255,255,0.9)), color-stop(100%, rgba(255,255,255,0)));
                background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
                background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
                background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
                background: -o-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
                background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
            }
*/
            /*
.box .dataTables_processing, .overlay-wrapper .dataTables_processing {
    z-index: 50;
    background: rgba(255,255,255,0.7);
    border-radius: 3px;
}
.box>.dataTables_processing, .overlay-wrapper>.dataTables_processing, .box>.loading-img, .overlay-wrapper>.loading-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}


.box > .dataTables_processing,
.box > .loading-img {
    position: absolute;
    background-color:red;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%
}
.box .dataTables_processing {
    z-index: 1010;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 3px
}
.box .dataTables_processing > .fa {
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -15px;
    margin-top: -15px;
    color: #000;
    font-size: 30px
}
.box .dataTables_processing.dark {
    background: rgba(0, 0, 0, 0.5)
}
*/

            .box .dataTables_processing .overlay {
                pointer-events: none;
                z-index: 1010;
                background: rgba(0, 0, 0, 0.5);
                border-radius: 3px;
            }

            .box .dataTables_processing>.overlay,
            .box>.loading-img,
            .overlay-wrapper>.loading-img {
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
                <h2 style="margin-top:0px">Simda List</h2>
            </div-->
                <div class="col-md-4 text-center">
                    <div style="margin-top: 4px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="5%">id</th>
                            <th>COL1</th>
                            <th>COL2</th>
                            <th>COL3</th>
                            <th>COL4</th>
                            <th>COL5</th>
                            <th>COL6</th>
                            <th>COL7</th>
                            <th>COL8</th>
                            <th>COL9</th>
                            <th width="500px">COL10</th>
                            <th>COL11</th>
                            <th>COL12</th>
                            <th>COL13</th>
                            <th>COL14</th>
                            <th>COL15</th>
                            <th>COL16</th>
                            <th>COL17</th>
                            <th>COL18</th>
                            <th>COL19</th>
                            <th>COL20</th>
                            <th>COL21</th>
                            <th>COL22</th>
                            <th>COL23</th>
                            <th>COL24</th>
                            <th>COL25</th>
                            <th>COL26</th>
                            <th>COL27</th>
                            <th>COL28</th>
                            <th>COL29</th>
                            <th width="80%">COL30</th>
                            <th>COL31</th>
                            <th>COL32</th>
                            <th>COL33</th>
                            <th>COL34</th>
                            <th>COL35</th>
                            <th>COL36</th>
                            <th>COL37</th>
                            <th>COL38</th>
                            <th>COL39</th>
                            <th>COL40</th>
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
/* End of file simda/simda_list */
/* Location: ./application/views/simda/simda_list */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-18 21:02:06 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 18 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>