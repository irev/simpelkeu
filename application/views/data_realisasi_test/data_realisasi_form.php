<!doctype html>
<html>
    <head>
        <title> <?= _APLIKASI_ ?> | DATA_REALISASI_TEST > <?php echo $button ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Data_realisasi <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Ke <?php echo form_error('ke') ?></label>
            <input type="text" class="form-control" name="ke" id="ke" placeholder="Ke" value="<?php echo $ke; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Progres <?php echo form_error('progres') ?></label>
            <input type="text" class="form-control" name="progres" id="progres" placeholder="Progres" value="<?php echo $progres; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Fisik <?php echo form_error('fisik') ?></label>
            <input type="text" class="form-control" name="fisik" id="fisik" placeholder="Fisik" value="<?php echo $fisik; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">PotMCLALU <?php echo form_error('potMCLALU') ?></label>
            <input type="text" class="form-control" name="potMCLALU" id="potMCLALU" placeholder="PotMCLALU" value="<?php echo $potMCLALU; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">PotUMK <?php echo form_error('potUMK') ?></label>
            <input type="text" class="form-control" name="potUMK" id="potUMK" placeholder="PotUMK" value="<?php echo $potUMK; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">PotRETENSI <?php echo form_error('potRETENSI') ?></label>
            <input type="text" class="form-control" name="potRETENSI" id="potRETENSI" placeholder="PotRETENSI" value="<?php echo $potRETENSI; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">NilaiBAP <?php echo form_error('nilaiBAP') ?></label>
            <input type="text" class="form-control" name="nilaiBAP" id="nilaiBAP" placeholder="NilaiBAP" value="<?php echo $nilaiBAP; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">PajakPPH <?php echo form_error('pajakPPH') ?></label>
            <input type="text" class="form-control" name="pajakPPH" id="pajakPPH" placeholder="PajakPPH" value="<?php echo $pajakPPH; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">PajakPPN <?php echo form_error('pajakPPN') ?></label>
            <input type="text" class="form-control" name="pajakPPN" id="pajakPPN" placeholder="PajakPPN" value="<?php echo $pajakPPN; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NoSPP <?php echo form_error('noSPP') ?></label>
            <input type="text" class="form-control" name="noSPP" id="noSPP" placeholder="NoSPP" value="<?php echo $noSPP; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">TglSPP <?php echo form_error('tglSPP') ?></label>
            <input type="text" class="form-control" name="tglSPP" id="tglSPP" placeholder="TglSPP" value="<?php echo $tglSPP; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NoSPM <?php echo form_error('noSPM') ?></label>
            <input type="text" class="form-control" name="noSPM" id="noSPM" placeholder="NoSPM" value="<?php echo $noSPM; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">TglSPM <?php echo form_error('tglSPM') ?></label>
            <input type="text" class="form-control" name="tglSPM" id="tglSPM" placeholder="TglSPM" value="<?php echo $tglSPM; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">JenisTagihan <?php echo form_error('JenisTagihan') ?></label>
            <input type="text" class="form-control" name="JenisTagihan" id="JenisTagihan" placeholder="JenisTagihan" value="<?php echo $JenisTagihan; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">TglTAGIHAN <?php echo form_error('tglTAGIHAN') ?></label>
            <input type="text" class="form-control" name="tglTAGIHAN" id="tglTAGIHAN" placeholder="TglTAGIHAN" value="<?php echo $tglTAGIHAN; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NoTAGIHAN <?php echo form_error('noTAGIHAN') ?></label>
            <input type="text" class="form-control" name="noTAGIHAN" id="noTAGIHAN" placeholder="NoTAGIHAN" value="<?php echo $noTAGIHAN; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kdpaket <?php echo form_error('kdpaket') ?></label>
            <input type="text" class="form-control" name="kdpaket" id="kdpaket" placeholder="Kdpaket" value="<?php echo $kdpaket; ?>" />
        </div>
	    <input type="hidden" name="kdRealisasi" value="<?php echo $kdRealisasi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_realisasi_test') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>




<?php
/* End of file data_realisasi/data_realisasi_form */
/* Location: ./application/view/data_realisasi/data_realisasi_form */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-03 15:55:55 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 03 Feb 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
