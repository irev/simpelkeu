<!doctype html>
<html>
    <head>
        <title> <?= _APLIKASI_ ?> | MASTER_KEGIATAN > <?php echo $button ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Master_kegiatan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NmKegiatan <?php echo form_error('nmKegiatan') ?></label>
            <input type="text" class="form-control" name="nmKegiatan" id="nmKegiatan" placeholder="NmKegiatan" value="<?php echo $nmKegiatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kd Program <?php echo form_error('kd_program') ?></label>
            <input type="text" class="form-control" name="kd_program" id="kd_program" placeholder="Kd Program" value="<?php echo $kd_program; ?>" />
        </div>
	    <input type="hidden" name="kdKegiatan" value="<?php echo $kdKegiatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_kegiatan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>




<?php
/* End of file master_kegiatan/master_kegiatan_form */
/* Location: ./application/view/master_kegiatan/master_kegiatan_form */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-17 00:58:02 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 17 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
