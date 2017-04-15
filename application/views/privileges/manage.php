<?php echo form_open('privileges/manage/'.$type.'/'.$id, array('class'=>'mainForm')); ?>
	<div class="widget first">
		<div class="head"><h5 class="iFrames">List of Privileges for <?php echo $for; ?></h5></div>
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
						<?php echo '<input type="checkbox" name="privilege['.$privilege['id'].']" value="1"'.(in_array($privilege['slug'], $set_privileges) ? ' checked="checked"' : '').'>'; ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div><br />
	<?php echo submit_btn(); ?>
</form>