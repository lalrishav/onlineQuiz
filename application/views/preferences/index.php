<?php if ($this->tank_auth->is_privileged('insert_preference')) { ?>
<a href="<?php echo base_url(); ?>admin/preferences/create" title="" class="basicBtn">Create Preference</a>
<?php } ?>

<div class="widget first">
	<div class="head"><h5 class="iFrames">List of Preferences</h5></div>
	<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
		<thead>
			<tr>
				<td width="50%">Name</td>
				<td width="35%">Key</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($preferences as $row) { ?>
            <tr>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['key']; ?></td>
				<td align="center">
					<?php echo $this->tank_auth->is_privileged('update_preference') ? admin_update_btn('admin/preferences/update/'.$row['id']) : ''; ?>
					<?php echo $this->tank_auth->is_privileged('delete_preference') ? admin_delete_btn('admin/preferences/delete/'.$row['id']) : ''; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>