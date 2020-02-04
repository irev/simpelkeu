
        <h2 style="margin-top:0px">Master OPD <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NmOPD <?php echo form_error('nmOPD') ?></label>
            <input type="text" class="form-control" name="nmOPD" id="nmOPD" placeholder="NmOPD" value="<?php echo $nmOPD; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('Alamat') ?></label>
            <input type="text" class="form-control" name="Alamat" id="Alamat" placeholder="Alamat" value="<?php echo $Alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Telpon <?php echo form_error('Telpon') ?></label>
            <input type="text" class="form-control" name="Telpon" id="Telpon" placeholder="Telpon" value="<?php echo $Telpon; ?>" />
        </div>
	    <input type="hidden" name="kdOPD" value="<?php echo $kdOPD; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('m_opd') ?>" class="btn btn-default">Cancel</a>
	</form>
  