<div class="widgets">
		
	<div class="widget">
			<div class="head">
				<h5 class="iFrames">Solutions for <strong><?php echo $paper['name']; ?></strong></h5>
			</div>
	<div style="padding-left: 20px;padding-top: 20px;">
	<h4><b>Paper setters:</b></h4><br/><h3>Ravi Kumar, Priyanka Mohanta, Chandan Pandey, Abhinav Mishra</h3>
	</div>
	<br/>
	<?php $i=1; foreach($questions as $q){?>
	<div style="padding-left: 20px; border: 2px">
		<br/>
		<h4><?php echo "Q".$i++.". ". $q['question']; ?></h4>
		<br/>
		<?php if($q['image_url']) { ?><img src="<?php echo base_url();?>static/images/questions/<?php echo $q['image_url']; ?>" alt="Image Unavailable" float="left" width="200px" height="200px"/></a><br/> <?php } ?>
         <br/>
		<h5><?php echo "1. ".$q['option1']; ?></h5>
		<h5><?php echo "2. ".$q['option2']; ?></h5>
		<h5><?php echo "3. ".$q['option3']; ?></h5>
		<h5><?php echo "4. ".$q['option4']; ?></h5>
		<br/>
		<hr/>
		<h4><?php echo "Correct Option: ".$q['answer']; ?></h4>
		<hr/>
		
	</div>
	<?php } ?>
	<br/>
	&emsp;<h2><center>Thank You for using IEEE Online Test Portal ! -<b>Kartikeya Mishra(Chairman, IEEE BIT MESRA)</b></center></h2>
   
</div>
</div>