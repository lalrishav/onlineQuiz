<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('admin/preferences/update/'.$preference['id'], array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Details</h5></div>
			<?php echo admin_form_field('text', array('label'=>'Name', 'name'=>'name', 'req'=>true, 'class'=>'noborder', 'value'=>$preference['name'])); ?>
			<?php echo admin_form_field('text', array('label'=>'Key', 'name'=>'key', 'req'=>true, 'value'=>$preference['key'])); ?>
			<?php echo admin_form_field('multiselect', array('label'=>'Groups', 'name'=>'groups[]', 'req'=>true, 'options'=>$this->group_model->get_list(), 'value'=>unserialize($preference['groups']))); ?>
			<?php echo admin_form_field('textarea', array('label'=>'Options', 'name'=>'options', 'value'=>$preference['options'])); ?>
			<?php echo admin_form_field('text', array('label'=>'Default', 'name'=>'default', 'req'=>true, 'value'=>$preference['default'])); ?>
			<?php echo admin_submit_btn(); ?>
		</div>	
	</fieldset>
</form>