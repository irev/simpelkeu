    <h2 style="margin-top:0px">Paket Detail</h2>


<div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-file"></i>
                  <h3 class="box-title">DETAIL PAKET</h3>
                </div><!-- /.box-header -->
            <div class="box-body">
<div class="box-header with-border">
    <table class="table">
        <tr><td width="15%">Nama Paket</td><td><b><?php echo $nmPaket; ?></b></td></tr>
        <tr><td>DPA / DPPA</td><td><b class="text-danger"><?php echo $dpa->noDPA; ?> </b>Tanggal: <?= $dpa->tglDPA; ?></td></tr>
       
        <tr><td>Program </td><td><?php print_r($dpa->COL23.' - '.$dpa->COL24); ?></td></tr>
	    <tr><td>Kegiatan </td><td><?php print_r($dpa->COL23.'.'.$dpa->COL25.' - '.$dpa->COL26); ?></td></tr>
	    <tr><td>Belanaja </td><td><?php  print_r($dpa->COL5.'.'.$dpa->COL7.'.'.$dpa->COL9.'.'.$dpa->COL11.'.'.$dpa->COL13.' - '.$dpa->COL14); ?></td></tr>
        
        <tr><td>Tahun Anggaran</td><td><?php echo $tahun; ?></td></tr>
	    <!--tr><td>Md5namatahun</td><td><?php echo $md5namatahun; ?></td></tr-->
	    <tr><td>Bidang</td><td><?php echo $bidang; ?></td></tr>
	    <tr><td>- Ruas</td><td>
            <ul>
            <?php
            if(count($ruas->result_array())>0){
                foreach ($ruas->result_array() as $r ) {
                    echo '<li>'.$this->db->get_where('simda', ['id'=>$r['kdPekerjaan']])->row('COL30').' Pagu '.$this->db->get_where('simda', ['id'=>$r['kdPekerjaan']])->row('COL40').'</li>';
                }
            }
              // echo $last_querys;
            ?>
        </td></tr>
        <!--tr><td>Kontrak</td><td><a href="<?php echo base_url(); ?>data_kontrak/paket/<?php echo $kdPaket; ?>" class="btn btn-sm btn-success">+ Kontrak</a> </td></tr>
        <tr><td>Jaminan</td><td><a href="<?php echo base_url(); ?>data_jaminan/create/<?php echo $kdPaket; ?>" class="btn btn-sm btn-success">+ Jaminan</a> </td></tr-->
	    <tr><td><a href="<?php echo site_url('paket') ?>" class="btn btn-sm btn-danger"><i class='fa  fa-arrow-left'></i>   Kembali</a></td><td></td></tr>
	</table>
</div>
</div>
</div>
<div class="col-md-12">
<!-- I. KONTRAK -->
<div class="box box-danger" id="box-kontrak">
                <div class="box-header with-border">
                  <i class="fa fa-tag"></i>
                  <h3 class="box-title">KONTRAK</h3>
                  <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>data_kontrak/paket/<?php echo $kdPaket; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>   Kontrak</a>
                  </div> 
                </div><!-- /.box-header -->
                <div class="box-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nomor Kontrak</th>
            <th>Tgl Kontrak</th>
            <th>Tgl Akhir</th>
            <th>Nilai Kontrak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $qKontrak = $this->db->get_where('data_kontrak',['kdpaket'=>$kdPaket])->row(); ?>
    <?php
    if($qKontrak){
    //print_r($qKontrak);
        echo "<tr>
                <td>".$qKontrak->nomorKontrak."</td>
                <td>".$qKontrak->TglKontrak."</td>
                <td>".$qKontrak->tglakhir."</td>
                <td>".$qKontrak->nilaiKontrak."</td>
                <td><a href='".base_url('data_kontrak/delete/'.$qKontrak->kdKontrak)."' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</a></td>
             </tr>";
    }else{
        echo "<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
             </tr>";
    }           
    ?>
    </tbody>
</table>
</div>
</div>
<!-- end kontrak-->
</div>
<div class="col-md-12">
<!-- Ia. KONTRAK ADDENDUM -->
<?php if($qKontrak){ ?>
<div class="box box-warning" id="box-addendum">
                <div class="box-header with-border">
                  <i class="fa fa-tags"></i>
                  <h3 class="box-title">ADDENDUM</h3>
                  <div class="box-tools pull-right">
                  <?php if($qKontrak){ ?>
                    <a href="<?php echo base_url(); ?>data_kontrak/read/<?php echo htmlentities($qKontrak->kdKontrak); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>    Addendum</a>
                  <?php } ?>
                  </div> 
                </div><!-- /.box-header -->
                <div class="box-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nomor Addendum</th>
            <th>Tgl Kontrak</th>
            <th>Tgl Akhir</th>
            <th>Nilai Kontrak</th>
            <!--th>Aksi</th-->
        </tr>
    </thead>
    <?php if($qKontrak){ ?>
      
    <tbody>
    <?php $qAddendum = $this->db->get_where('data_kontrak_addendum',['kdKontrak'=>$qKontrak->kdKontrak])->result_array(); ?>
    <?php
    //echo $this->db->last_query();
    //print_r($qAddendum);
    if($qAddendum){
        foreach ($qAddendum as $add) {
            echo "<tr>
                    <td>".$add['nomorAddendum']."</td>
                    <td>".$add['Tgl']."</td>
                    <td>".$add['tglakhir']."</td>
                    <td>".$add['nilai']."</td>
                    <!--td><a href='".base_url('paket/deleteAddendum/'.$add['kdAddendum'].'/'.$kdPaket)."' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</a></td-->
                </tr>";
        }
    }else{
        echo "<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
             </tr>";
    }              
    ?>
    </tbody>
    <?php } ?> 
</table>
</div>
<!-- end kontrak addendum-->
</div>
<?php } ?> 


<!--II. PEJABAT-->
<div class="box box-success" id="box-pejabat">
                <div class="box-header with-border">
                  <i class="fa fa-users"></i>
                  <h3 class="box-title">PEJABAT</h3>
                  <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>data_pejabat/paket/<?php echo $kdPaket; ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>   Jabatan</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th width="10%">Jabatan</th>
            <th width="30%">Nama</th>
            <th width="60%">Nip</th>
        </tr>
    </thead>
    <tbody>
    <?php $qpejabat = $this->db->get_where('data_pejabat',['kdpaket'=>$kdPaket])->row(); ?>
    <?php
    if($qpejabat){
    //print_r($qKontrak);
        echo "<tr>
                <td>KPA</td>
                <td>".$this->Data_pejabat_model->get_nama_by_id($qpejabat->kpa)."</td>
                <td>".$this->Data_pejabat_model->get_nip_by_id($qpejabat->kpa)."</td>
            </tr>
            <tr>
                <td>PPTK</td>
                <td>".$this->Data_pejabat_model->get_nama_by_id($qpejabat->pptk)."</td>
                <td>".$this->Data_pejabat_model->get_nip_by_id($qpejabat->pptk)."</td>
            </tr>
            <tr>
                <td>Pengawas</td>
                <td>".$this->Data_pejabat_model->get_nama_by_id($qpejabat->pengawas)."</td>
                <td>".$this->Data_pejabat_model->get_nip_by_id($qpejabat->pengawas)."</td>
                </tr>
             ";
      
    }          
    ?>
    </tbody>
</table>
</div>
</div>


<!--II. PEJABAT-->
<div class="box box-danger" id="box-rekanan">
                <div class="box-header with-border">
                  <i class="fa fa-legal "></i>
                  <h3 class="box-title">PELAKSANA</h3>
                  <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>data_rekanan/paket/<?php echo $kdPaket; ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>   Jabatan</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th colspan="4">DATA PELAKSANA KONTRAK</th>
        </tr>
    </thead>
    <tbody>
    <?php $qRekanan = $this->db->get_where('data_rekanan',['kdpaket'=>$kdPaket])->row(); ?>
    <?php
    if($qRekanan){
    //print_r($qKontrak);
        echo "
                <tr>
                    <th width='25%'> Perusahaan </th><td>".$qRekanan->perusahaan."</td>  
                    <th width='25%'> NPWP </th><td>".$qRekanan->npwp."</td>
                </tr>
                <tr>
                    <th> Alamat </th><td>".$qRekanan->alamat."</td>
                    <th> Rekening Bank </th><td>".$qRekanan->rekening."</td>
                </tr>
                <tr>
                    <th> Pimpinan </th><td>".$qRekanan->direktur."</td>
                    <th> Pada Bank </th><td>".$qRekanan->bank."</td>
                </tr>
                <tr>
                    <th> Jabatan </th><td>".$qRekanan->jabatan."</td>
                    <th> Klasifikasi Perusahaan </th><td>".$qRekanan->Type."</td>
                </tr>               
          ";  
    }          
    ?>
    </tbody>
</table>
</div>
</div>

<!--III. JAMINAN-->
<div class="box box-primary" id="box-jaminan">
                <div class="box-header with-border">
                  <i class="fa fa-warning"></i>
                  <h3 class="box-title">JAMINAN</h3>
                  <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>data_jaminan/paket/<?php echo $kdPaket; ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>   Jaminan</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nomor Jaminan</th>
            <th>Type</th>
            <th>Penjamin</th>
            <th>Nilai</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $qjaminan = $this->db->get_where('data_jaminan',['kdpaket'=>$kdPaket]); ?>
    <?php
    if($qjaminan->row()){
    //print_r($qjaminan);
    foreach ($qjaminan->result_array() as $qjam) {
        echo "<tr>
                <td>".$qjam['kdJaminan']."</td>
                <td>".$qjam['Type']."</td>
                <td>".$qjam['penjamin']."</td>
                <td>".$qjam['nilai']."</td>
                <td>".$qjam['tgl']."</td>
                <td><a href='".base_url('paket/delete_jaminan/'.$qjam['kdJaminan'])."' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</a></td>
             </tr>"; 
        } 
    }          
    ?>
    </tbody>
</table>
</div>
</div>





<!--IV. Realisasi-->
<div class="box box-primary" id="box-realisasi">
                <div class="box-header with-border">
                  <i class="fa fa-money"></i>
                  <h3 class="box-title">Realisasi</h3>
                  <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>data_realisasi/create/<?php echo $kdPaket; ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>  Realisasi</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Realisasi / Termyn</th>
            <th>Type</th>
            <th>Progres</th>
            <th>Fisik</th>
            <th>Nilai</th>
            <th>Tanggal</th>
            <th>SPP</th>
            <th>Tanggal</th>
            <th>SPM</th>
            <th>Tanggal</th>
            <th>Tagihan</th>
        </tr>
    </thead>
    <tbody>
        <!--tr>
            <td>I</td>
            <td>Uang Muka Kerja</td>
            <td><b>30%</b></td>
            <td>45.600.900</td>
            <td>2020-04-02</td>
            <td>023/SPP/LS-BM/DPUPR/2019</td>
            <td>2020-04-02</td>
            <td>023/SPM/LS-BM/DPUPR/2019</td>
            <td>023/SPM/LS-BM/DPUPR/2019</td>
            <td>023/SPM/LS-BM/DPUPR/2019</td>
            <td>023/SPM/LS-BM/DPUPR/2019</td>
            <td><a class="btn btn-xs btn-success"><i class="fa fa-search"></i> Detail</a></td>
        </tr-->
    <?php $qrealisasi = $this->db->get_where('data_realisasi',['kdpaket'=>$kdPaket]); ?>
    <?php
    //echo print_r($qrealisasi->result_array());
    if($qrealisasi->row()){
    //print_r($qrealisasi);
    $no =1;
    foreach ($qrealisasi->result_array() as $qrea) {
        echo "<tr>
                <td>".$qrea['JenisTagihan']."</td>
                <td>".$qrea['ke']."</td>
                <td>".$qrea['progres']."</td>
                <td>".$qrea['fisik']."</td>
                <td>".$qrea['nilaiBAP']."</td>
                <td>".$qrea['tglSPP']."</td>
                <td>".$qrea['noSPP']."</td>
                <td>".$qrea['tglSPM']."</td>
                <td>".$qrea['noSPM']."</td>
                <td>".$qrea['tglTAGIHAN']."</td>
                <td>".$qrea['noTAGIHAN']."</td>";
            if($qrealisasi->num_rows()==$no){
                echo "<td><a href='".base_url('data_realisasi/update/'.$qrea['kdRealisasi'])."' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i>   Ubah</a></td>";
            }else{
                echo "<td><a href='".base_url('data_realisasi/read/'.$qrea['kdRealisasi'])."' class='btn btn-xs btn-primary'><i class='fa fa-pencil'></i>   Detail</a></td>";
            }
                echo "</tr>";
            $no++;    
        }  
    }          
    ?>
    </tbody>
</table>
</div>
</div>


<!--GO TO OPTIONS-->
<style>
#fixed-menu{
    position: fixed; top: 50px; right: -200px; background: #ff9800; border-radius: 5px 0px 0px 5px; padding: 10px 15px; font-size: 16px; z-index: 99999; cursor: pointer; color: rgb(60, 141, 188); box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px;
    transition: 0.4s;
}
#fixed-menu:hover{
    position: fixed; top: 50px; right: 0px; background: #ff6207; border-radius: 5px 0px 0px 5px; padding: 10px 15px; font-size: 16px; z-index: 99999; cursor: pointer; color: rgb(60, 141, 188); box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px;
    transition: 0.4s;
}
#fixed-menu > #fixed-menu-gear{
    position: fixed; top: 50px; right: -2px; background: #000000; border-radius: 5px 0px 0px 5px; padding: 10px 15px; font-size: 16px; z-index: 99999; cursor: pointer; color: rgb(60, 141, 188); box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px;
    transition: 0.4s;
}
#fixed-menu:hover > #fixed-menu-gear{
    position: fixed; top: 50px; right: -50px; background: #000000; border-radius: 5px 0px 0px 5px; padding: 10px 15px; font-size: 16px; z-index: 99999; cursor: pointer; color: rgb(60, 141, 188); box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px;
    transition: 0.4s;
}
</style>

<div class="btn-group-vertical"  id="fixed-menu">
<div class="no-print" id="fixed-menu-gear"><i class="fa fa-gear"></i></div>
    <a class="btn btn-default" href="#box-kontrak" class="scrollLink" > Kontrak</a>
    <a class="btn btn-default" href="#box-addendum" class="scrollLink" > Addendum</a>
    <a class="btn btn-default" href="#box-pejabat" class="scrollLink" > Pejabat</a>
    <a class="btn btn-default" href="#box-jaminan" class="scrollLink" > Jaminan</a>
    <a class="btn btn-default" href="#box-realisasi" class="scrollLink" >  Realisasi</a>
    <a class="btn btn-default" href="#" class="scrollLink" ><i class="fa fa-arrow-up"></i> Keatas</a>
</div>


<?php
/* End of file tbpaket/tbpaket_read */
/* Location: ./application/views/tbpaket/tbpaket_read */
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
