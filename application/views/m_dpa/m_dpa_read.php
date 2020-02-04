<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">M_dpa Read</h2>
        <table class="table">
	    <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $Tanggal; ?></td></tr>
	    <tr><td>Pa</td><td><?php echo $pa; ?></td></tr>
	    <tr><td>Panip</td><td><?php echo $panip; ?></td></tr>
	    <tr><td>Bendahara</td><td><?php echo $bendahara; ?></td></tr>
	    <tr><td>Bendaharanip</td><td><?php echo $bendaharanip; ?></td></tr>
	    <tr><td>Ppk</td><td><?php echo $ppk; ?></td></tr>
	    <tr><td>Ppknip</td><td><?php echo $ppknip; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('m_dpa') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>