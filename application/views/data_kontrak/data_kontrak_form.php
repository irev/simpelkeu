        <?php 
        $kdpaket = $this->uri->segment(3);
        $NomorPHO=0;
        $tglPHO=0;
        $NomorFHO=0;
        $tglFHO=0;
        ?>
        <h2 style="margin-top:0px">Data kontrak <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group" style="display:none;">
            <label for="date">Nomor Kontrak <?php echo form_error('kdKontrak') ?></label>
            <input type="hidden" name="kdKontrak" id="kdKontrak" class="form-control" placeholder="Nomor Kontrak" value="<?php echo $kdKontrak; ?>" /> 
        </div>
        <div class="form-group">
            <label for="date">Nomor Kontrak <?php echo form_error('nomorKontrak') ?></label>
            <input type="text" name="nomorKontrak" id="nomorKontrak" class="form-control" placeholder="Nomor Kontrak" value="<?php echo $nomorKontrak; ?>" /> 
        </div>
        <div class="form-group">
            <label for="date">Tanggal Kontrak <?php echo form_error('TglKontrak') ?></label>
            <input type="text" class="form-control datepicker" autocomplete="off" name="TglKontrak" id="TglKontrak" placeholder="Tanggal Kontrak" value="<?php echo $TglKontrak; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal akhir <?php echo form_error('tglakhir') ?></label>
            <input type="text" class="form-control datepicker"  autocomplete="off" name="tglakhir" id="tglakhir" placeholder="Tanggal akhir" value="<?php echo $tglakhir; ?>" />
        </div>
	    <div class="form-group" >
            <label for="double">Nilai Kontrak <?php echo form_error('nilaiKontrak') ?></label>
            <input type="text" class="form-control" name="nilaiKontrak" id="nilaiKontrak" placeholder="NilaiKontrak" value="<?php echo $nilaiKontrak; ?>" />
        </div>	 

	    <div class="form-group" style="display: none;">
            <label for="NomorPHO">Nomor PHO <?php echo form_error('NomorPHO') ?></label>
            <textarea class="form-control" rows="3" name="NomorPHO" id="NomorPHO" placeholder="NomorPHO"><?php echo $NomorPHO; ?></textarea>
        </div>
	    <div class="form-group" style="display: none;">
            <label for="date">Tgl PHO <?php echo form_error('tglPHO') ?></label>
            <input type="text" class="form-control datepicker" name="tglPHO" id="tglPHO" placeholder="TglPHO" value="<?php echo $tglPHO; ?>" />
        </div>
	    <div class="form-group" style="display: none;">
            <label for="NomorFHO">Nomor FHO <?php echo form_error('NomorFHO') ?></label>
            <textarea class="form-control" rows="3" name="NomorFHO" id="NomorFHO" placeholder="NomorFHO"><?php echo $NomorFHO; ?></textarea>
        </div>
	    <div class="form-group" style="display: none;">
            <label for="date">Tgl FHO <?php echo form_error('tglFHO') ?></label>
            <input type="text" class="form-control datepicker" name="tglFHO" id="tglFHO" placeholder="TglFHO" value="<?php echo $tglFHO; ?>" />
        </div>
	    <div class="form-group" style="display: none;">
            <label for="varchar">Id Paket <?php echo $kdpaket; ?><?php echo form_error('kdpaket') ?></label>
            <input type="hidden" class="form-control" name="kdpaket" id="kdpaket" placeholder="Kdpaket" value="<?php echo $kdpaket; ?>" />
        </div>
        <?php  $kdKontraks = ($kdKontrak=='')? 'kont'.$kdpaket : $kdKontrak; ?>

	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('paket/read/'.$kdpaket) ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</form>




<?php
/* End of file data_kontrak/data_kontrak_form */
/* Location: ./application/view/data_kontrak/data_kontrak_form */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:59:44 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
