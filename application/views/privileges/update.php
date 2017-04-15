<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('privileges/update/'.$privilege['id'], array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Details</h5></div>
			<?php echo form_field('text', array('label'=>'Name', 'name'=>'name', 'req'=>true, 'class'=>'noborder', 'value'=>$privilege['name'])); ?>
			<?php echo form_field('text', array('label'=>'Slug', 'name'=>'slug', 'req'=>true, 'value'=>$privilege['slug'])); ?>
			<?php echo form_field('text', array('label'=>'Description', 'name'=>'description', 'value'=>$privilege['description'])); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>