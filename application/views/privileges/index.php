<?php if ($this->tank_auth->is_privileged('insert_privilege')) { ?>
<a href="<?php echo base_url(); ?>privileges/create" title="" class="basicBtn">Create Privilege</a>
<?php } ?>

<div class="widget first">
	<div class="head"><h5 class="iFrames">List of Privileges</h5></div>
	<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
		<thead>
			<tr>
				<td width="50%">Name</td>
				<td width="35%">Slug</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($privileges as $privilege) { ?>
            <tr>
				<td><?php echo $privilege['name']; ?></td>
				<td><?php echo $privilege['slug']; ?></td>
				<td align="center">
					<?php echo $this->tank_auth->is_privileged('update_privilege') ? update_btn('privileges/update/'.$privilege['id']) : ''; ?>
					<?php echo $this->tank_auth->is_privileged('delete_privilege') ? delete_btn('privileges/delete/'.$privilege['id']) : ''; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>