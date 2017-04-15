<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo $this->config->item('site_name'); ?></title>

<link href="<?php echo base_url();?>static/css/my.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>static/css/main.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/jquery-ui.min.js"></script> 

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/flot/excanvas.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/flot/jquery.flot.resize.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/tables/colResizable.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/forms.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/autotab.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/forms/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/other/calendar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/other/elfinder.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.colorpicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/wizards/jquery.validate.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.ToTop.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.listnav.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/plugins/ui/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/js/custom.js"></script>

</head>

<body>

<!-- Registration form area -->
<?php echo isset($message2) && $message2 ? '<div class="nNote nSuccess hideit"><p>'.$message2.'  	<a href="/tesla" title="" class="btn55">Back to Login</a></p></div>' : ''; ?>
    

<?php echo form_open('auth/createStudent', array('class'=>'mainForm')); ?>
	<?php echo form_hidden('group', 'student'); ?>
	<fieldset>
		<div class="widget first" style="position: relative; top:50%; left: 25%; width: 50%">
			<div class="head"><h5 class="iList">Registration Details</h5></div>
			<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
			<?php echo form_field('text', array('label'=>'First Name', 'name'=>'firstname', 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Last Name', 'name'=>'lastname')); ?>
			<?php echo form_field('text', array('label'=>'Email', 'name'=>'email','placeholder'=>'Enter valid email', 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Mobile','placeholder'=>'Enter valid mobile no.', 'name'=>'mobile')); ?>
			<?php echo form_field('select', array('label'=>'Course', 'name'=>'roll1', 'options'=> $courses, 'req'=>true)); ?>
			<?php echo form_field('text', array('label'=>'Roll', 'name'=>'roll2','placeholder'=>'Eg. 10212', 'req'=>true)); ?>
			<?php echo form_field('select', array('label'=>'Batch', 'name'=>'roll3', 'options'=> $batches, 'req'=>true)); ?>
			<?php echo form_field('select', array('label'=>'Branch', 'name'=>'branch', 'options'=> $branches, 'req'=>true)); ?>
			
			<?php echo form_field('password', array('label'=>'Password', 'name'=>'password','placeholder'=>'Min. 4 characters', 'req'=>true)); ?>
			<?php echo form_field('password', array('label'=>'Confirm password', 'name'=>'confirm_password', 'req'=>true)); ?>
			<?php echo submit_btn(); ?>
			
		</div>	
	</fieldset>
</form>

</body>
</html>
