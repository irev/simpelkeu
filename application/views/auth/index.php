
<div id="infoMessage"><?php echo $message;?></div>
<p><?php echo anchor('auth/create_user', lang('index_create_user_link'),['class'=>'btn btn-xs btn-danger'])?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'),['class'=>'btn btn-xs btn-primary'])?></p>
<div class="box-body table-responsive">
<table cellpadding=0 cellspacing=10 class="table table-bordered table-striped table-hover">
<thead>

	<tr>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
	</tr>
</thead>	
<tbody>
	<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link'),['class'=>'btn btn-xs btn-success']) : anchor("auth/activate/". $user->id, lang('index_inactive_link'),['class'=>'btn btn-xs btn-danger']);?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit',['class'=>'btn btn-xs btn-warning']) ;?></td>
		</tr>
	<?php endforeach;?>
</tbody></table>
</div>

        

