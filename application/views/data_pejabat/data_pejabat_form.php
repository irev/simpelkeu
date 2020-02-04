<?PHP
$kdpaket = $this->uri->segment(3);
?>

<?php
$pejabat = $this->db->get('master_pegawai'); 
?>
        <h2 style="margin-top:0px">Data Pejabat</h2>
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">KPA <?php echo form_error('kpa') ?></label>
            
            <select type="text" name="kpa" id="kpa" class="form-control select2" placeholder="kpa" value="<?php echo $kpa; ?>" /> 
                <option value="<?php echo $kpa; ?>"><?php echo $this->Data_pejabat_model->get_nama_by_id($kpa); ?> - <?php echo $this->Data_pejabat_model->get_nip_by_id($kpa); ?></option>';
                <option value=""> ==== Pilih KPA ====</option>
                <?php
                foreach ($pejabat->result_array() as $pej) {
                    echo '<option value="'.$pej['id_peg'].'">'.$pej['nama'].' - '.$pej['nip'].'</option>';
                }
                ?>
            </select>
        </div>
	    <div class="form-group" style="display:none;">
            <label for="varchar">Nip KPA <?php echo form_error('nipkpa') ?></label>
            <input type="text" class="form-control" name="nipkpa" id="nipkpa" placeholder="Nipkpa" value="<?php echo $nipkpa; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">PPTK <?php echo form_error('pptk') ?></label>
            <select type="text" class="form-control select2" name="pptk" id="pptk" placeholder="Pptk" value="<?php echo $pptk; ?>" />
            <option value="<?php echo $pptk; ?>"><?php echo $this->Data_pejabat_model->get_nama_by_id($pptk); ?> - <?php echo $this->Data_pejabat_model->get_nip_by_id($pptk); ?></option>';
            <option value=""> ==== Pilih PPTK ====</option>
                <?php
                foreach ($pejabat->result_array() as $pej) {
                    echo '<option value="'.$pej['id_peg'].'">'.$pej['nama'].' - '.$pej['nip'].'</option>';
                }
                ?>
            </select>
        </div>
	    <div class="form-group" style="display:none;">
            <label for="varchar">Nip PPTK <?php echo form_error('nippptk') ?></label>
            <input type="text" class="form-control" name="nippptk" id="nippptk" placeholder="Nippptk" value="<?php echo $nippptk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pengawas <?php echo form_error('pengawas') ?></label>
            <select type="text" class="form-control select2" name="pengawas" id="pengawas" placeholder="Pengawas" value="<?php echo $pengawas; ?>" />
            <option value="<?php echo $pengawas; ?>"><?php echo $this->Data_pejabat_model->get_nama_by_id($pengawas); ?> - <?php echo $this->Data_pejabat_model->get_nip_by_id($pengawas); ?></option>';
                <option value=""> ==== Pilih Pengawas ====</option>
                <?php
                foreach ($pejabat->result_array() as $pej) {
                    echo '<option value="'.$pej['id_peg'].'">'.$pej['nama'].' - '.$pej['nip'].'</option>';
                }
                ?>
            </select>
        </div>
	    <div class="form-group" style="display:none;">
            <label for="varchar">Nip Pengawas <?php echo form_error('nippengawas') ?></label>
            <input type="text" class="form-control" name="nippengawas" id="nippengawas" placeholder="Nippengawas" value="<?php echo $nippengawas; ?>" />
        </div>
	    <div class="form-group" style="display:none;">
            <label for="varchar">Kdpaket <?php echo form_error('kdpaket') ?></label>
            <input type="text" class="form-control" name="kdpaket" id="kdpaket" placeholder="Kdpaket" value="<?php echo $kdpaket; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('paket/read/'.$kdpaket) ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</form>
 




<?php
/* End of file data_pejabat/data_pejabat_form */
/* Location: ./application/view/data_pejabat/data_pejabat_form */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 19:30:19 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
