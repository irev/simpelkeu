<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Master_pegawai List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Nip</th>
		<th>Jabatan</th>
		<th>Pendidikan</th>
		<th>Jurusan</th>
		<th>Pangkat</th>
		<th>Golongan</th>
		<th>Ruang</th>
		<th>Tempat</th>
		<th>Tanggal Lahir</th>
		<th>Tgl Aktif</th>
		<th>Status</th>
		<th>Date Update</th>
		
            </tr><?php
            foreach ($master_pegawai_data as $master_pegawai)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $master_pegawai->nama ?></td>
		      <td><?php echo $master_pegawai->nip ?></td>
		      <td><?php echo $master_pegawai->jabatan ?></td>
		      <td><?php echo $master_pegawai->pendidikan ?></td>
		      <td><?php echo $master_pegawai->jurusan ?></td>
		      <td><?php echo $master_pegawai->pangkat ?></td>
		      <td><?php echo $master_pegawai->golongan ?></td>
		      <td><?php echo $master_pegawai->ruang ?></td>
		      <td><?php echo $master_pegawai->tempat ?></td>
		      <td><?php echo $master_pegawai->tanggal_lahir ?></td>
		      <td><?php echo $master_pegawai->tgl_aktif ?></td>
		      <td><?php echo $master_pegawai->status ?></td>
		      <td><?php echo $master_pegawai->date_update ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>




<?php
/* End of file master_pegawai/master_pegawai_pdf */
/* Location: ./application/views/master_pegawai/master_pegawai_pdf */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 21:38:38 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 20 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
