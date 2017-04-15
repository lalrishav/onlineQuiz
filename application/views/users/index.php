<?php if ($this->tank_auth->is_privileged('insert_user')) { ?>
<a href="<?php echo base_url(); ?>users/<?php echo $group['slug']; ?>/create" title="" class="basicBtn">Create <?php echo $group['name']; ?></a>
<?php } ?>
<?php if ($this->tank_auth->is_privileged('insert_user')) { ?>
<a href="<?php echo base_url(); ?>users/<?php echo $group['slug']; ?>" title="" class="basicBtn">Active</a>
<a href="<?php echo base_url(); ?>users/<?php echo $group['slug']; ?>/banned" title="" class="basicBtn">Banned</a>
<?php } ?>

<div class="widget first">
	<div class="head"><h5 class="iFrames">List of Users</h5></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="users_tbl">
		<thead>
			<tr>
				<td width="50%">Name</td>
				<?php echo $this->tank_auth->is_privileged('update_user') ? '<td width="20%">Email</td>' : ''; ?>
				<?php echo $this->tank_auth->is_privileged('update_user') ? '<td width="10%">Last Login</td>' : ''; ?>
				<?php echo $this->tank_auth->is_privileged('update_user') ? '<td width="30%">Actions</td>' : ''; ?>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $user) { ?>
            <tr>
				<td><?php echo $user['firstname'].' '.$user['lastname']; ?></td>
				<?php echo $this->tank_auth->is_privileged('update_user') ? '<td>'.$user['email'].'</td>' : ''; ?>
				<?php echo $this->tank_auth->is_privileged('update_user') ? '<td>'.$user['last_login'].'</td>' : ''; ?>
				<?php if ($this->tank_auth->is_privileged('update_user')) {?> <td align="center">
					<?php echo $this->tank_auth->is_privileged('update_user') ? update_btn('users/'.$group['slug'].'/update/'.$user['id']) : ''; ?>
					<?php if ($user['banned'] == '1') : ?>
					<?php echo $this->tank_auth->is_privileged('delete_user') ? undelete_btn('users/'.$group['slug'].'/ban/'.$user['id']) : ''; ?>
					<?php else : ?>
					<?php echo $this->tank_auth->is_privileged('delete_user') ? delete_btn('users/'.$group['slug'].'/delete/'.$user['id']) : ''; ?>
					<?php endif; ?>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>			
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready( function() {
		$('#users_tbl').dataTable( {
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sDom": '<""f>rt<"F"lip>',
			"iDisplayLength": 25,
			"bSort": false			
		} );
	} );
</script>