<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
<title><?php echo $this->config->item('site_name'); ?></title>

<link href="<?php echo base_url();?>static/css/main.css" rel="stylesheet" type="text/css" />

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

<!-- Login form area -->
<div class="loginWrapper">
	<div class="loginLogo">
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	<img src="<?php echo base_url();?>static/images/loginLogo.png" alt="" /></div>
	<br/>
	<?php echo isset($message) && $message ? '<div class="nNote nWarning hideit"><p>'.$message.'</p></div>' : ''; ?>
	<?php echo isset($message2) && $message2 ? '<div class="nNote nSuccess hideit"><p>'.$message2.'</p></div>' : ''; ?>
        
    <div class="loginPanel">
		<div class="head"><h5 class="iUser">Login</h5></div>
		<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
		<?php echo form_open('auth/login', array('class'=>'mainForm', 'id'=>'valid')); ?>		
			<fieldset>
                <div class="loginRow noborder">
                    <label for="req1">Email:</label>
                    <div class="loginInput"><input type="text" name="login" class="validate[required]" id="req1" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <label for="req2">Password:</label>
                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="req2" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <input type="submit" value="Log me in" class="greyishBtn submitForm" />
                    <div class="fix"></div>
                </div>
            </fieldset>
             <center>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<h2 onclick="alert('Contact Administrator(Shashank-9955626469)');" >Forgot Password!</h2></center>
            <center>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<h1><a href="createStudent">Not Signed Up Yet! Register Now.</a></h1></center>
        </form>
    </div>
</div>

<!--
	<div>
        <div><h5><center><a href="createStudent">Not registered yet! Sign Up.</a></center></h5></div>
	</div>
-->
<!-- Footer -->
<div id="footer">
	<div class="wrapper">
    	<span>&copy; Copyright <?php echo date("Y"); ?>.</span>
    </div>
</div>

</body>
</html>
