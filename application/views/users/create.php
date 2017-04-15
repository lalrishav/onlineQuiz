<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('users/'.$group['slug'].'/create', array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', $group['slug']); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Details</h5></div>
			<?php echo form_field('text', array('label'=>'First Name', 'name'=>'firstname', 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Last Name', 'name'=>'lastname', 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Email', 'name'=>'email', 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Mobile', 'name'=>'mobile')); ?>
			<?php echo form_field('password', array('label'=>'Password', 'name'=>'password', 'req'=>true)); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>