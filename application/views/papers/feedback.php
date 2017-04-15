<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('papers/feedback', array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first" style="padding-left: 20px">
			<div class="head"><h5 class="iList">Feedback Form: </h5></div>
			<?php echo form_field('text', array('label'=>'Message', 'name'=>'message','value'=>'')); ?>
			<?php echo form_field('select', array('label'=>'Rate your Experience', 'name'=>'rating','value'=>1, 'options'=>$ratings)); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>
