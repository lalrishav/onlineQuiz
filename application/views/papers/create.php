<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('papers/create', array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Create Paper:</h5></div>
			<?php echo form_field('text', array('label'=>'Paper Name', 'name'=>'paperName','value'=>set_value("paperName", ''))); ?>
			<?php echo form_field('text', array('label'=>'Subject', 'name'=>'paperSubject','value'=>set_value("paperSubject", ''))); ?>
			<?php echo form_field('text', array('label'=>'Time', 'name'=>'paperTime','value'=>set_value("paperTime", ''))); ?>
			<?php echo form_field('text', array('label'=>'Start Time', 'name'=>'paperStartTime', 'value'=>set_value("paperStartTime", date('H:i:s d M Y', ''))); ?>
			<?php echo form_field('text', array('label'=>'End Time', 'name'=>'paperEndTime', 'value'=>set_value("paperEndTime", date('H:i:s d M Y', ''))); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>
