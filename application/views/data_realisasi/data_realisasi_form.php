<style>
.input-kuning{    
    border-radius: 0 !important; 
    box-shadow: none; 
    border-color: #f98306 !important;
}
.input-hijau{    
    border-radius: 0 !important; 
    box-shadow: none; 
    border-color: #0ad613 !important;
}
</style>
<?php
$idpaket = $this->uri->segment(3);
$tahunAnggaran = $this->session->userdata('tahun_anggran');
?>
<div class="row">
    <div class="col-md-12">
<h2 style="margin-top:0px">Realisasi <?php echo $ke; ?> </h2>
<form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Ke <?php echo $ke; ?> <?php echo form_error('ke') ?></label>
            <input type="text" class="form-control hide" name="ke" id="ke" autocomplete="off" placeholder="Ke" value="<?php echo $ke; ?>" />
      </div>
      <div class="col-md-4">
        <div class="form-group">
                    <label>Potongan MC LALU: <?php echo form_error('potMCLALU') ?></label>
                    <div class="input-group">
                      <div class="input-group-addon bg-red disabled">
                        <b>Rp.</b>
                      </div>
                      <input type="text" class="form-control bg-gray disabled" autocomplete="off" name="potMCLALU" id="potMCLALU" placeholder="PotMCLALU" value="<?php echo $potMCLALU; ?>" />
                    </div><!-- /.input group -->
        </div>
        <div class="form-group">
                    <label for="decimal">Potongan UMK <?php echo form_error('potUMK') ?></label>
                    <div class="input-group">
                      <div class="input-group-addon bg-red disabled ">
                        <b>Rp.</b>
                      </div>
                      <input type="text" class="form-control bg-gray disabled" autocomplete="off" name="potUMK" id="potUMK" placeholder="PotUMK" value="<?php echo $potUMK; ?>" />
                    </div><!-- /.input group -->
        </div>
        <div class="form-group">
                    <label for="decimal">Potongan RETENSI <?php echo form_error('potRETENSI') ?></label>
                    <div class="input-group">
                      <div class="input-group-addon bg-red disabled ">
                        <b>Rp.</b>
                      </div>
                      <input type="text" class="form-control bg-gray disabled" autocomplete="off" name="potRETENSI" id="potRETENSI" placeholder="PotRETENSI" value="<?php echo $potRETENSI; ?>" />
                    </div><!-- /.input group -->
        </div>
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
                    <label for="decimal">Nilai BAP <?php echo form_error('nilaiBAP') ?></label>
                    <div class="input-group">
                      <div class="input-group-addon bg-green disabled color-palette">
                        <b>Rp.</b>
                      </div>
                      <input type="text" class="form-control input-hijau" autocomplete="off" name="nilaiBAP" id="nilaiBAP" placeholder="NilaiBAP" value="<?php echo $nilaiBAP; ?>" />
                    </div><!-- /.input group -->
        </div>    
	    <div class="form-group">
                    <label for="decimal">Pajak PPH <?php echo form_error('pajakPPH') ?></label>
                    <div class="input-group">
                      <div class="input-group-addon bg-red ">
                        <b>Rp.</b>
                      </div>
                    <input type="text" class="form-control bg-gray disabled" autocomplete="off" name="pajakPPH" id="pajakPPH" placeholder="PajakPPH" value="<?php echo $pajakPPH; ?>" />
                    </div>
        </div>
	    <div class="form-group">
                    <label for="decimal">Pajak PPN <?php echo form_error('pajakPPN') ?></label>
                    <div class="input-group">
                      <div class="input-group-addon bg-red ">
                        <b>Rp.</b>
                      </div>
                        <input type="text" class="form-control bg-gray disabled" autocomplete="off" name="pajakPPN" id="pajakPPN" placeholder="PajakPPN" value="<?php echo $pajakPPN; ?>" />
                    </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="varchar">Jenis Tagihan <?php echo form_error('JenisTagihan') ?></label>
            <!--input type="text" class="form-control" name="JenisTagihan" id="JenisTagihan" placeholder="JenisTagihan" value="<?php echo $JenisTagihan; ?>" /-->
            <select type="text" class="form-control" name="JenisTagihan" id="JenisTagihan" placeholder="JenisTagihan" value="<?php echo $JenisTagihan; ?>" >
                    <option value="">--- Pilih Jenis Tagihan ---</option>    
                <optgroup label="Termyn">
                    <option value="UMK">Uang Muka Kerja</option>
                    <option value="MC">Monthly Certificate</option>
                    <option value="Termyn">Termyn Terakhir</option>
                    <option value="Retensi">Retensi</option>
                </optgroup>
                <optgroup label="Lump Sum">
                    <option value="LumpSum">Lump Sum</option>
                </optgroup>
            </select>
        </div>
        <div class="input-group input-kuning" style="border-radius: 0 !important; box-shadow: none; border-color: #f98306 !important;">
        <label for="double">Fisik <?php echo form_error('progres') ?></label>
                    <div class="input-group">
                    <input type="text" class="form-control input-kuning" autocomplete="off" name="progres" id="progres" placeholder="Progres" value="<?php echo $progres; ?>" autocomplete="off"/>
                      <div class="input-group-addon bg-aqua disabled color-palette">
                        <b>Rp.</b>
                      </div>
                    </div>    
      </div>
	    <div class="form-group ">
            <label for="double">Fisik <?php echo form_error('fisik') ?></label>
            <div class="input-group">
                      <div class="input-group-addon bg-green disabled color-palette">
                        <b>Rp.</b>
                      </div>
            <input type="text" class="form-control bg-gray disabled" autocomplete="off" name="fisik" id="fisik" placeholder="Fisik" value="<?php echo $fisik; ?>" />
            </div>
        </div>
    </div>

    <hr class="col-md-11">

    <div class="col-md-5">
	    <div class="form-group">
            <label for="varchar">Nomor TAGIHAN <?php echo form_error('noTAGIHAN') ?></label>
            <div class="input-group">
                      <div class="input-group-addon bg-aqua disable ">
                        <b>TAGIHAN</b>
                      </div>
            <input type="text" class="form-control" name="noTAGIHAN" autocomplete="off" id="noTAGIHAN" placeholder="Nomor TAGIHAN" value="<?php echo $noTAGIHAN; ?>" />
            </div>
        </div>
        <div class="form-group">
                <label for="date">TGL TAGIHAN <?php echo form_error('tglTAGIHAN') ?></label>
                    <div class="input-group">    
                    <input type="text" class="form-control datepicker" autocomplete="off" name="tglTAGIHAN" id="tglTAGIHAN" placeholder="TglTAGIHAN" value="<?php echo $tglTAGIHAN; ?>" />
            
                      <div class="input-group-addon bg-yellow ">
                        <b>TANGAL TAGIHAN</b>
                    </div>
            </div>
        </div>
	    <div class="form-group">
            <label for="varchar">Kdpaket <?php echo form_error('kdpaket') ?></label>
            <input type="text" class="form-control" name="kdpaket" id="kdpaket" autocomplete="off" placeholder="Kdpaket" value="<?php echo $idpaket; ?>" readonly />
        </div>
    </div>
    <div class="col-md-6">
    <div class="row">
        
        <div class="col-md-8">  
            <div class="form-group">
                <label for="varchar">Nomor SPP <?php echo form_error('noSPP') ?></label>
                <div class="input-group">
                      <div class="input-group-addon bg-aqua disabled">
                        <b>SPP</b>
                      </div>
                <input type="text" class="form-control" name="noSPP" autocomplete="off" id="noSPP" placeholder="NoSPP" value="<?php echo $noSPP; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="varchar">TGL SPP <?php echo form_error('tglSPP') ?></label>
                <div class="input-group">
                <input type="text" class="form-control datepicker" autocomplete="off" name="tglSPP" id="tglSPP" placeholder="TglSPP" value="<?php echo $tglSPP; ?>" />
                <div class="input-group-addon bg-yellow">
                      <i class="fa fa-calendar" aria-hidden="true"></i> TANGGAL SPP
                      </div>
            </div>
            </div>
        </div>
        <div class="form-group col-xs-3 has-warning">
                <label for="varchar">No SPP & SPM <?php echo form_error('noSPPSPM') ?></label>
                <input type="text" class="form-control" name="noSPPSPM" id="noSPPSPM" placeholder="No SPP SPM" value="<?php echo $noSPPSPM; ?>" autocomplete="off" />
        </div>
    </div>

    
    <div class="row">  
    
    <div class="col-md-8"> 
	    <div class="form-group">
            <label for="varchar">Nomor SPM <?php echo form_error('noSPM') ?></label>
            <div class="input-group">
                      <div class="input-group-addon bg-aqua">
                        <b>SPM</b>
                      </div>
            <input type="text" class="form-control" name="noSPM" id="noSPM" placeholder="NoSPM" value="<?php echo $noSPM; ?>" />
            </div>
        </div>
	    <div class="form-group">
            <label for="varchar">TGL SPM <?php echo form_error('tglSPM') ?></label>
            <div class="input-group">
            <input type="text" class="form-control datepicker" name="tglSPM" id="tglSPM" placeholder="TglSPM" value="<?php echo $tglSPM; ?>" />
                      <div class="input-group-addon bg-yellow">
                      <i class="fa fa-calendar" aria-hidden="true"></i> TANGGAL SPM
                      </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    
    
    <hr class="col-md-11">
    <div class="col-md-12 center">
    <div class="text-center">
	    <input type="hiddens" name="kdRealisasi" value="<?php echo $kdRealisasi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Proses</button> 
      <a class="btn btn-warning" id="hitung"> <i class="fa fa-calculator"></i> Hitung</a> 
      <?php
      list($pak,$code) = explode('_',$idpaket,3);
      ?>
        <a href="<?php echo site_url('paket/read/'.$pak.'_'.$code) ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
    </div>
</form>
</div>
</div>   



<?php
/* End of file data_realisasi/data_realisasi_form */
/* Location: ./application/view/data_realisasi/data_realisasi_form */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-28 09:40:54 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 28 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
