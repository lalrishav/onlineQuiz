<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open(current_url(), array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList"><?php echo $user['firstname'].' '.$user['lastname']; ?></h5></div>
			<?php echo form_field('textarea', array('label'=>'Comments', 'name'=>'comments', 'req'=>true, 'class'=>'noborder')); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>