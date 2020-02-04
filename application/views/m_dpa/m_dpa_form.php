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
        <h2 style="margin-top:0px">M_dpa <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="year">Tahun <?php echo form_error('tahun') ?></label>
            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('Tanggal') ?></label>
            <input type="text" class="form-control" name="Tanggal" id="Tanggal" placeholder="Tanggal" value="<?php echo $Tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pa <?php echo form_error('pa') ?></label>
            <input type="text" class="form-control" name="pa" id="pa" placeholder="Pa" value="<?php echo $pa; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Panip <?php echo form_error('panip') ?></label>
            <input type="text" class="form-control" name="panip" id="panip" placeholder="Panip" value="<?php echo $panip; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Bendahara <?php echo form_error('bendahara') ?></label>
            <input type="text" class="form-control" name="bendahara" id="bendahara" placeholder="Bendahara" value="<?php echo $bendahara; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Bendaharanip <?php echo form_error('bendaharanip') ?></label>
            <input type="text" class="form-control" name="bendaharanip" id="bendaharanip" placeholder="Bendaharanip" value="<?php echo $bendaharanip; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ppk <?php echo form_error('ppk') ?></label>
            <input type="text" class="form-control" name="ppk" id="ppk" placeholder="Ppk" value="<?php echo $ppk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ppknip <?php echo form_error('ppknip') ?></label>
            <input type="text" class="form-control" name="ppknip" id="ppknip" placeholder="Ppknip" value="<?php echo $ppknip; ?>" />
        </div>
	    <input type="hidden" name="kdDPA" value="<?php echo $kdDPA; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('m_dpa') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>