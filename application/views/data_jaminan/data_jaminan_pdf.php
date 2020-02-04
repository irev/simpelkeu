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
        <h2>Data_jaminan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Penjamin</th>
		<th>Nilai</th>
		<th>Tgl</th>
		<th>Type</th>
		<th>Kdpaket</th>
		
            </tr><?php
            foreach ($data_jaminan_data as $data_jaminan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_jaminan->penjamin ?></td>
		      <td><?php echo $data_jaminan->nilai ?></td>
		      <td><?php echo $data_jaminan->tgl ?></td>
		      <td><?php echo $data_jaminan->Type ?></td>
		      <td><?php echo $data_jaminan->kdpaket ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>




<?php
/* End of file data_jaminan/data_jaminan_pdf */
/* Location: ./application/views/data_jaminan/data_jaminan_pdf */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:46:14 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>