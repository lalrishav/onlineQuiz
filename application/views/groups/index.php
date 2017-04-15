<?php if ($this->tank_auth->is_privileged('insert_group')) { ?>
<a href="<?php echo base_url('groups/create'); ?>" title="" class="basicBtn">Create Group</a>
<?php } ?>

<div class="widget first">
	<div class="head"><h5 class="iFrames">List of Groups</h5></div>
	<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
		<thead>
			<tr>
				<td width="40%">Name</td>
				<td width="30%">Privileges</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($groups as $group) { ?>
            <tr>
				<td><?php echo $group['name']; ?></td>
				<td align="center"><?php echo $this->tank_auth->is_privileged('update_group_privilege') ? anchor('privileges/manage/group/'.$group['id'], 'Manage') : ''; ?></td>
				<td align="center">
					<?php echo $this->tank_auth->is_privileged('update_group') ? update_btn('groups/update/'.$group['id']) : ''; ?>
					<?php echo $this->tank_auth->is_privileged('delete_group') ? delete_btn('groups/delete/'.$group['id']) : ''; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>