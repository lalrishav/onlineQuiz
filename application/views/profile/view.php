<?php //if ($this->tank_auth->is_privileged('insert_user')) { ?>
<?php //} ?>
<a href="<?php echo base_url(); ?>profile/update" title="" class="basicBtn">Update</a>
<!--<a href="<?php echo base_url(); ?>profile/delete" title="" class="basicBtn">Delete-wont work</a>-->

<div class="widget first">
	<div class="head"><h5 class="iFrames">User Profile</h5></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="profile_tbl">
		<tbody>
			<tr>
				<td>Firstname</td>
				<td><?php echo $profile->firstname; ?></td>
			</tr>
			<tr>
				<td>Middlename</td>
				<td><?php echo $profile->middlename; ?></td>
			</tr>
			<tr>
				<td>Lastname</td>
				<td><?php echo $profile->lastname; ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $profile->email; ?></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><?php echo $profile->mobile; ?></td>
			</tr>
			<tr>
				<td>Sex</td>
				<td><?php echo $profile->sex; ?></td>
			</tr>
			<tr>
				<td>Date of Birth</td>
				<td><?php echo ($profile->dob != NULL)?date('d M Y', strtotime($profile->dob)):'-'; ?></td>
			</tr>
			<tr>
				<td>Roll Number</td>
				<td><?php echo ($profile->roll2 != NULL)?($profile->roll1."/".$profile->roll2."/".$profile->roll3) :"-"; ?></td>
			</tr>
			<tr>
				<td>Branch</td>
				<td><?php echo $profile->branch != NULL?$profile->branch:"-"; ?></td>
			</tr><tr>
				<td>Last Login</td>
				<td><?php echo date('d M Y H:i:s', strtotime($profile->last_login)); ?></td>
			</tr>
			
			
		</tbody>
	</table>
</div>