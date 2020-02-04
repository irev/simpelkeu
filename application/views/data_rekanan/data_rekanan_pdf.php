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
        <h2>Data_rekanan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Type</th>
		<th>Perusahaan</th>
		<th>Alamat</th>
		<th>Npwp</th>
		<th>Bank</th>
		<th>Rekening</th>
		<th>Direktur</th>
		<th>Bentuk</th>
		<th>Kdpaket</th>
		
            </tr><?php
            foreach ($data_rekanan_data as $data_rekanan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_rekanan->Type ?></td>
		      <td><?php echo $data_rekanan->perusahaan ?></td>
		      <td><?php echo $data_rekanan->alamat ?></td>
		      <td><?php echo $data_rekanan->npwp ?></td>
		      <td><?php echo $data_rekanan->bank ?></td>
		      <td><?php echo $data_rekanan->rekening ?></td>
		      <td><?php echo $data_rekanan->direktur ?></td>
		      <td><?php echo $data_rekanan->bentuk ?></td>
		      <td><?php echo $data_rekanan->kdpaket ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>




<?php
/* End of file data_rekanan/data_rekanan_pdf */
/* Location: ./application/views/data_rekanan/data_rekanan_pdf */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 05:02:21 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>