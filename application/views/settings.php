<?php echo validation_errors('<div class="nNote nWarning hideit"><p>', '</p></div>'); ?>
<?php echo form_open('admin/settings/update', array('class'=>'mainForm')); ?>
	<fieldset>
		<div class="widget first">
			<div class="head"><h5 class="iList">Settings</h5></div>
			<?php
				foreach ($settings as $setting) { 
					echo '<div class="rowElem"><label>'.$setting['name'].':</label>';
					echo '<div class="formRight"><input type="text" name="'.$setting['slug'].'" value="'.$setting['value'].'" /></div>';
					echo '<div class="fix"></div></div>';						
				}
			?>
			<div class="submitForm"><input type="submit" value="submit" class="redBtn" /></div><div class="fix"></div>
		</div>	
	</fieldset>
</form>
