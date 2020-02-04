<table class="table table-hover">
    <thead>
        <tr>
            <th>Nomor Kontrak</th>
            <th>Tanggal Kontrak</th>
            <th>Tanggal akhir</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo  $kdKontrak; ?></td>
            <td><?php echo  $TglKontrak; ?></td>
            <td><?php echo  $tglakhir; ?></td>
            <td><?php echo  $nilaiKontrak; ?></td>
            <td><a href="#">Edit</a>  | <a href="#">Hapus</a></td>
        </tr>
    </tbody>
    <a href="<?php echo site_url('paket/read/'.$kdpaket) ?>" class="btn btn-xs btn-default">KEMBALI</a>
</table>
<?php
$qAddendum = $this->Data_kontrak_model->get_addendum_by_idkontrak($kdKontrak);

?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nomor ADDENDUM Kontrak</th>
            <th>Tanggal Kontrak</th>
            <th>Tanggal akhir</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <p><b>DATA ADDENDUM KONTRAK</b></p>
    <?php 
    //print_r($qAddendum);
    foreach ($qAddendum as $add) {
        # code...
    ?>
        <tr>
            <td><?php echo  $add['kdAddendum']; ?></td>
            <td><?php echo  $add['Tgl']; ?></td>
            <td><?php echo  $add['tglakhir']; ?></td>
            <td><?php echo  $add['nilai']; ?></td>
            <td><a href="#">Edit</a>  | <a href="#">Hapus</a></td>
        </tr>
    <?php } ?>    
    </tbody>
    <a href="<?php echo site_url('paket/read/'.$kdpaket) ?>" class="btn btn-xs btn-default btn-danger">+ Addendum</a>
</table>