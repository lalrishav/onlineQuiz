<div class="widgets">
     <div class="widget">
             <div class="head">
				<h5 class="iFrames">Feedback : </h5>
			</div>
			<div style="padding: 15px">
			     <?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('/home/feedback', array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', 'student'); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Feel comfortable to write your Opinion.All your information are secured</h5></div>
			<?php echo form_field('textarea', array('label'=>'Feedback', 'name'=>'feedback', 'placeholder'=>'Enter Your Feedback ','req'=>true)); ?>
			<?php echo form_field('select', array('label'=>'Rating', 'name'=>'rating', 'options'=> $rating, 'req'=>true)); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>
			</div>
     </div>
</div>