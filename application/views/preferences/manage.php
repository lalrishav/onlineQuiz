<?php echo form_open('admin/preferences/manage/'.$id, array('class'=>'mainForm')); ?>
	<div class="widget first">
		<div class="head"><h5 class="iFrames">List of Preferences for <?php echo $for; ?></h5></div>
		<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
			<thead>
				<tr>
					<td width="50%">Name</td>
					<td width="35%">Key</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($preferences as $preference) { ?>
				<tr>
					<td><?php echo $preference['name']; ?></td>
					<td><?php echo $preference['key']; ?></td>
					<td><?php echo admin_dropdown(array('name'=>'preference['.$preference['id'].']', 'options'=>$preference['options'], 'value'=>$user_preferences[$preference['key']])); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div><br />
	<?php echo admin_submit_btn(); ?>
</form>