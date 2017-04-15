<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('privileges/create', array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Details</h5></div>
			<?php echo form_field('text', array('label'=>'Name', 'name'=>'name', 'req'=>true, 'class'=>'noborder')); ?>
			<?php echo form_field('text', array('label'=>'Slug', 'name'=>'slug', 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Description', 'name'=>'description')); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>