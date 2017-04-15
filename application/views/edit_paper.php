<?php if($flag!=1){?>
<?php if (false || $this->tank_auth->is_privileged('create_paper')) { ?>
<a href="<?php echo base_url("/papers/view_paper/$pid"); ?>" title="" class="basicBtn">Watch Paper</a>
<?php } ?>

<div class="widgets">
     <div class="widget">
             <div class="head">
             <?php foreach ($info as $infos) {?>
				<h5 class="iFrames">Edit :- <?php echo $infos->name?>:(<?php echo $infos->subject ?>)</h5>
			</div>
			
			     <?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>

<?php echo form_open_multipart("/home/edit_paper?pid=$infos->pid", array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', 'student'); ?>
	
	<fieldset>
		
			
			<?php echo form_field('textarea', array('label'=>'Question', 'name'=>'question', 'placeholder'=>'Enter Your Question','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Option 1', 'name'=>'option1', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('file', array('label'=>'Image For Option 1', 'name'=>'op1_url','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Option 2', 'name'=>'option2', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('file', array('label'=>'Image For Option 2', 'name'=>'op2_url','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Option 3', 'name'=>'option3', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('file', array('label'=>'Image For Option 3', 'name'=>'op3_url','req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Option 4', 'name'=>'option4', 'placeholder'=>'Enter your option','req'=>true)); ?>
			<?php echo form_field('file', array('label'=>'Image For Option 4', 'name'=>'op4_url','req'=>true)); ?>
			<?php echo form_field('select', array('label'=>'Answer', 'name'=>'answer', 'options'=> $answer, 'req'=>true)); ?>
			<?php echo form_field('number', array('label'=>'Marks', 'name'=>'marks', 'placeholder'=>'Enter the marks of the question','value'=>'3','req'=>true)); ?>
			<?php echo form_field('file', array('label'=>'Image', 'name'=>'image_url','req'=>true)); ?>
			<!--input type="file" name="image_url" size="20" />-->
			
			
			
			<?php echo submit_btn(); ?>
		
	</fieldset>
</form>
			</div>
			<?php } ?>
     </div>
</div><?php } else { ?>

<div class="widgets">
     <div class="widget">
             <div class="head">
             <?php foreach ($info as $infos) {?>
				<h5 class="iFrames">Edit :- <?php echo $infos->name?>:(<?php echo $infos->subject ?>)</h5>
			</div>
			
			     <?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php $q_info->qid?>
<?php echo form_open_multipart("/home/update_question?qid=$qid", array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', 'student'); ?>
	
	<fieldset>
		
			
			<?php echo form_field('textarea', array('label'=>'Question', 'name'=>'question', 'value'=>$q_info[0]->question,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Option 1', 'name'=>'option1', 'placeholder'=>'Enter your option', 'value'=>$q_info[0]->option1,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Optiion 2', 'name'=>'option2', 'placeholder'=>'Enter your option', 'value'=>$q_info[0]->option2,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Optiion 3', 'name'=>'option3', 'placeholder'=>'Enter your option', 'value'=>$q_info[0]->option3,'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Optiion 4', 'name'=>'option4', 'placeholder'=>'Enter your option', 'value'=>$q_info[0]->option4,'req'=>true)); ?>
			<?php echo form_field('select', array('label'=>'Answer', 'name'=>'answer',  'value'=>$q_info[0]->answer,'options'=> $answer, 'req'=>true)); ?>
			<?php echo form_field('number', array('label'=>'Marks', 'name'=>'marks', 'value'=>$q_info[0]->marks ,'placeholder'=>'Enter the marks of the question','req'=>true)); ?>
			
			<!--input type="file" name="image_url" size="20" />-->
			
			
			
			<?php echo edit_btn(); ?>
		
	</fieldset>
</form>
			</div>
			<?php } ?>
     </div>
</div>
<?php } ?>