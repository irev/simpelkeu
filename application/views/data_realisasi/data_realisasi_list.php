
        <h2 style="margin-top:0px">Data realisasi List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('data_realisasi/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('data_realisasi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('data_realisasi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Ke</th>
		<th>Progres</th>
		<th>Fisik</th>
		<th>PotMCLALU</th>
		<th>PotUMK</th>
		<th>PotRETENSI</th>
		<th>NilaiBAP</th>
		<th>PajakPPH</th>
		<th>PajakPPN</th>
		<th>NoSPP</th>
		<th>TglSPP</th>
		<th>NoSPM</th>
		<th>TglSPM</th>
		<th>JenisTagihan</th>
		<th>TglTAGIHAN</th>
		<th>NoTAGIHAN</th>
		<th>Kdpaket</th>
		<th>Action</th>
            </tr><?php
            foreach ($data_realisasi_data as $data_realisasi)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $data_realisasi->ke ?></td>
			<td><?php echo $data_realisasi->progres ?></td>
			<td><?php echo $data_realisasi->fisik ?></td>
			<td><?php echo $data_realisasi->potMCLALU ?></td>
			<td><?php echo $data_realisasi->potUMK ?></td>
			<td><?php echo $data_realisasi->potRETENSI ?></td>
			<td><?php echo $data_realisasi->nilaiBAP ?></td>
			<td><?php echo $data_realisasi->pajakPPH ?></td>
			<td><?php echo $data_realisasi->pajakPPN ?></td>
			<td><?php echo $data_realisasi->noSPP ?></td>
			<td><?php echo $data_realisasi->tglSPP ?></td>
			<td><?php echo $data_realisasi->noSPM ?></td>
			<td><?php echo $data_realisasi->tglSPM ?></td>
			<td><?php echo $data_realisasi->JenisTagihan ?></td>
			<td><?php echo $data_realisasi->tglTAGIHAN ?></td>
			<td><?php echo $data_realisasi->noTAGIHAN ?></td>
			<td><?php echo $data_realisasi->kdpaket ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('data_realisasi/read/'.$data_realisasi->kdRealisasi),'Read'); 
				echo ' | '; 
				echo anchor(site_url('data_realisasi/update/'.$data_realisasi->kdRealisasi),'Update'); 
				echo ' | '; 
				echo anchor(site_url('data_realisasi/delete/'.$data_realisasi->kdRealisasi),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
 




<?php
/* End of file data_realisasi/data_realisasi_list */
/* Location: ./application/views/data_realisasi/data_realisasi_list */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-28 09:40:53 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 28 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
