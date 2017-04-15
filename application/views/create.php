<div class="widgets">
     <div class="widget">
             <div class="head">
				<h5 class="iFrames">Update Paper </h5>
			</div>
			<?php if($_GET['flag']==1){?>
			<?php foreach($value as $values){?>
			     <?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open("/home/update_paper?pid=$values->pid", array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', 'student'); ?>
	<fieldset>
		
			<?php echo form_field('text', array('label'=>'Name Of Paper', 'name'=>'name','placeholder'=>'Name of paper','value'=>$values->name,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Subject', 'name'=>'subject', 'value'=>$values->subject,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Total Time', 'name'=>'time', 'value'=>$values->time,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Start Time', 'name'=>'start_time', 'value'=>$values->start_time,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'End Time', 'name'=>'end_time', 'value'=>$values->end_time,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Created By', 'name'=>'created_by', 'value'=>$values->created_by,'req'=>true)); ?>
			
			<?php echo edit_btn(); ?>
		
		<?php } ?>
		<?php } ?>
		<?php if($_GET['flag']!=1) {?>
		<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('/home/create_paper', array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', 'student'); ?>
	<fieldset>
		<?php echo form_field('text', array('label'=>'Name Of Paper', 'name'=>'name','placeholder'=>'Name of paper','value'=>$values->name,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Subject', 'name'=>'subject', 'placeholder'=>'Subject (Ex:-Apttitude/Electrical or Electronics)','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Total Time', 'name'=>'time', 'placeholder'=>'Total time alloted for test','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Start Time', 'name'=>'start_time', 'placeholder'=>'(Ex:-2016-09-09 23:15:00)','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'End Time', 'name'=>'end_time', 'placeholder'=>'(Ex:-2016-09-09 23:15:00)','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Created By', 'name'=>'created_by', 'placeholder'=>'Who has created question???','req'=>true)); ?>
			
			<?php echo submit_btn(); ?>
			
			<?php } ?>
	</fieldset>
</form>
			
     </div>
</div>


