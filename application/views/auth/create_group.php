<h1><?php echo lang('create_group_heading');?></h1>
<p><?php echo lang('create_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_group");?>

      <div class="form-group ">
            <?php echo lang('create_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </div>

      <div class="form-group ">
            <?php echo lang('create_group_desc_label', 'description');?> <br />
            <?php echo form_input($description);?>
      </div>

      <p><?php echo form_submit('submit', lang('create_group_submit_btn'), ['class'=>'btn btn-xs btn-primary']);?>| <?php echo anchor('auth/index', lang('btn_back', 'back', ['class'=>'btn btn-xs btn-danger'])); ?> </p>

<?php echo form_close();?>