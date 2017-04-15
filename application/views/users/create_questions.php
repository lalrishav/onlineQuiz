<div class="widgets">
     <div class="widget">
             <div class="head">
				<h5 class="iFrames">Create Paper </h5>
			</div>
			<div style="padding: 15px">
			     <?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('/home/create_paper', array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', 'student'); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Create Paper</h5></div>
			<?php echo form_field('textarea', array('label'=>'Question', 'name'=>'question', 'placeholder'=>'Enter Your Question','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Optiion 1', 'name'=>'option1', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Optiion 2', 'name'=>'option2', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Optiion 3', 'name'=>'option3', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Optiion 4', 'name'=>'option4', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Answer', 'name'=>'answer', 'placeholder'=>'Enter the correct answer','req'=>true)); ?>
			<?php echo form_field('number', array('label'=>'Marks', 'name'=>'marks', 'placeholder'=>'Enter the marks od the question','req'=>true)); ?>
			
			
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>
			</div>
     </div>
</div>