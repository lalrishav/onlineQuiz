<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('groups/create', array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Details</h5></div>
			<?php echo form_field('text', array('label'=>'Name', 'name'=>'name', 'req'=>true, 'class'=>'noborder')); ?>
			<?php echo form_field('text', array('label'=>'Slug', 'name'=>'slug', 'req'=>true)); ?>
			<?php echo form_field('select', array('label'=>'User Type', 'name'=>'user_type', 'options'=>$this->data_model->user_types, 'value'=>'employee', 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Description', 'name'=>'description')); ?>
			<?php echo form_field('text', array('label'=>'Level', 'name'=>'level', 'placeholder'=>'Enter between 1 to 100, 100 being highest')); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>