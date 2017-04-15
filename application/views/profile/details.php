<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('profile/update', array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Update User Profile: <?php echo $this->tank_auth->get_fullname(); ?></h5></div>
			<?php echo form_field('text', array('label'=>'First Name', 'name'=>'firstname','value'=>$profile->firstname, 'disabled'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Middle Name', 'name'=>'middlename','value'=>set_value("middlename", $profile->middlename))); ?>
			<?php echo form_field('text', array('label'=>'Last Name', 'name'=>'lastname','value'=>$profile->lastname, 'disabled'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Email', 'name'=>'email', 'value'=> $profile->email, 'readonly'=>'true', 'disabled'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Mobile', 'name'=>'mobile', 'value'=>set_value("mobile", $profile->mobile), 'req'=>true)); ?>
			<?php echo form_field('date', array('label'=>'Date of Birth', 'name'=>'dob','value'=>set_value("dob", $profile->dob), 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Sex', 'name'=>'sex','value'=>set_value("sex", $profile->sex), 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Address Line 1', 'name'=>'address1','value'=>set_value("address1", $profile->address1), 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Address Line 2', 'name'=>'address2','value'=>set_value("address2", $profile->address2))); ?>
			<?php echo form_field('text', array('label'=>'City', 'name'=>'city','value'=>set_value("city", $profile->city), 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'State', 'name'=>'state','value'=>set_value("state", $profile->state), 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Country', 'name'=>'country','value'=>set_value("country", $profile->country), 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Pincode', 'name'=>'zipcode','value'=>set_value("zipcode", $profile->pin))); ?>
			<?php echo form_field('text', array('label'=>'Nationality', 'name'=>'nationality','value'=>set_value("nationality", $profile->nationality), 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Preferred Language', 'name'=>'language_preferred','value'=>set_value("language_preferred", $profile->language_preferred))); ?>
			<?php echo form_field('text', array('label'=>'Profile Picture', 'name'=>'profile_pic','value'=>set_value("profile_pic", $profile->profile_pic))); ?>
			<?php echo form_field('text', array('label'=>'Company Mail', 'name'=>'company_mail','value'=>set_value("company_mail", $profile->company_mail))); ?>
			<?php echo form_field('text', array('label'=>'Linked In', 'name'=>'linkedin','value'=>set_value("linkedin", $profile->linkedin))); ?>
			<?php echo form_field('text', array('label'=>'Facebook', 'name'=>'facebook','value'=>set_value("facebook", $profile->facebook))); ?>
			<?php echo submit_btn(); ?>
		</div>	
	</fieldset>
</form>
