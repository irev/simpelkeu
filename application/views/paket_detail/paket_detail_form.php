<!doctype html>
<html>
    <head>
        <title> <?= _APLIKASI_ ?> | PAKET_DETAIL > <?php echo $button ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Paket_detail <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">KdPaket <?php echo form_error('kdPaket') ?></label>
            <input type="text" class="form-control" name="kdPaket" id="kdPaket" placeholder="KdPaket" value="<?php echo $kdPaket; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">KdPekerjaan <?php echo form_error('kdPekerjaan') ?></label>
            <input type="text" class="form-control" name="kdPekerjaan" id="kdPekerjaan" placeholder="KdPekerjaan" value="<?php echo $kdPekerjaan; ?>" />
        </div>
	    <input type="hidden" name="detailpaket" value="<?php echo $detailpaket; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('paket_detail') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>




<?php
/* End of file paket_detail/paket_detail_form */
/* Location: ./application/view/paket_detail/paket_detail_form */
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