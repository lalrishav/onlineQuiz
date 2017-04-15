<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo $this->config->item('site_name'); ?> | <?php echo $page_title; ?></title>

<link href="<?php echo base_url();?>static/css/main.css" rel="stylesheet" type="text/css" />
<!--<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />-->

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

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="welcome"><a href="<?php echo base_url();?>" title=""><img src="<?php echo base_url();?>static/images/userPic.png" alt="" /></a><span>Hello <?php echo $this->tank_auth->get_fullname(); ?></span></div>
            <div class="userNav">
                <ul> 
					<?php if (false && $this->tank_auth->get_group('slug') == 'student') ://edit for notifications ?>
					<li><a href="<?php echo base_url('notifications');?>"><img src="<?php echo base_url();?>static/images/icons/topnav/messages.png" alt=""><span>Notifications</span><span class="numberTop"><?php /*echo $this->notification_model->count_unread($this->tank_auth->get_user_id());*/ ?></span></a></li>
					<?php endif; ?>

					<!--Access only to admins-->

                    <?php if ($this->tank_auth->is_privileged('view_settings') && false) { //edit to enable settings?>
					<li><a href="<?php echo base_url('settings');?>" title=""><img src="<?php echo base_url();?>static/images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
					<?php } ?>
					
					<!--Access to all-->

					<li><a href="<?php echo base_url('profile');?>" title=""><img src="<?php echo base_url();?>static/images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
					<li><a href="<?php echo base_url('auth/logout');?>" title=""><img src="<?php echo base_url();?>static/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Header -->
<div id="header" class="wrapper">
    <div class="logo"><img src="<?php echo base_url();?>static/images/loginLogo.png" alt="" width="212px"/></div>
    <div class="middleNav" style="padding:20px 10px 0 0;text-align:right;"><!-- ORGANISATION HERE -->
    </div>
    <div class="fix"></div>
</div>

<!-- Main wrapper -->
<div class="wrapper">
	
	<?php if (!(isset($hide_menu) && $hide_menu==true)) : ?>
	<!-- Left navigation -->
    <div class="leftNav">
    	<ul id="menu">
			<?php 	
				foreach ($this->menu->pages as $menu_slug => $menu_item) { 
					if ($this->tank_auth->is_privileged('insert_'.$menu_item['privilege']) || $this->tank_auth->is_privileged('update_'.$menu_item['privilege']) || $this->tank_auth->is_privileged('view_'.$menu_item['privilege'])) {
						echo '<li class="'.$menu_item['class'].'">';
						if (!isset($menu_item['sub'])) {	
							echo '<a'.(($page == $menu_slug) ? ' class="active"' : '').' href="'.base_url($menu_item['link']).'"'.(isset($menu_item['target']) ? ' target="'.$menu_item['target'].'"' : '').'><span>'.$menu_item['name'].'</span></a>';
						} else {
							echo '<a class="exp'.(($page == $menu_slug) ? ' active' : '').'" href="#"><span>'.$menu_item['name'].'</span></a>';
							echo '<ul class="sub">';
							foreach ($menu_item['sub'] as $sub_menu_slug => $sub_menu_item) {
								echo '<li><a'.(($page == $sub_menu_slug) ? ' class="active"' : '').' href="'.base_url($menu_item['link'].'/'.$sub_menu_item['link']).'"'.(isset($menu_item['target']) ? ' target="'.$menu_item['target'].'"' : '').'>'.$sub_menu_item['name'].'</a></li>';								
							}
							echo '</ul>';
						}
						echo '</li>';
					}
				}
			?>
        </ul>
    </div>
	<?php endif; ?>
	<!-- Content -->
    <div class="content" id="container">
		<div class="title"><h5><?php echo $page_title; ?></h5></div>
		<?php echo isset($message) && $message ? '<div class="nNote nWarning hideit"><p>'.$message.'</p></div>' : ''; ?>
		<?php echo isset($message2) && $message2 ? '<div class="nNote nSuccess hideit"><p>'.$message2.'</p></div>' : ''; ?>