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
        <h2>Paket_detail List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>KdPaket</th>
		<th>KdPekerjaan</th>
		
            </tr><?php
            foreach ($paket_detail_data as $paket_detail)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $paket_detail->kdPaket ?></td>
		      <td><?php echo $paket_detail->kdPekerjaan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>




<?php
/* End of file paket_detail/paket_detail_pdf */
/* Location: ./application/views/paket_detail/paket_detail_pdf */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:22:32 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
