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
        <h2>M_opd List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>NmOPD</th>
		<th>Alamat</th>
		<th>Telpon</th>
		
            </tr><?php
            foreach ($m_opd_data as $m_opd)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $m_opd->nmOPD ?></td>
		      <td><?php echo $m_opd->Alamat ?></td>
		      <td><?php echo $m_opd->Telpon ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>