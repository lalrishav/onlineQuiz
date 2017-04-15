
<div class="widgets">
		
	<div class="widget">
			<div class="head">
				<h5 class="iFrames">Solutions for <strong><?php echo $paper['name']; ?></strong></h5>
			</div>
	<div style="padding-left: 20px;padding-top: 20px;">
	<h4><b>Paper setters:</b></h4><br/><h3>Harshit Bahadur</h3>
	</div>
	<br/>
	<?php $i=1; foreach($questions as $q){?>
	<div style="padding-left: 20px; border: 2px">
		<br/>
		<?php $qid=$q['qid'];?>
		<h4>
		<?php echo "   "?><?php echo $this->tank_auth->is_privileged('update_user') ? update_btn("papers/edit_paper?qid=$qid& flag=1& pid=$id") : ''; ?><br><?php echo "Q".$i++.". ". $q['question']; ?></h4>

		<br/>
		<?php if($q['image_url']) { ?><img src="<?php echo base_url();?>static/images/questions/<?php echo $q['image_url']; ?>" alt="Image Unavailable" float="left" width="200px" height="200px"/></a><br/> <?php } ?> 
         <br/>
		<h5><?php echo "1. ".$q['option1']; ?></h5><br/>
		<?php if($q['op1_url']) { ?><img src="<?php echo base_url();?>static/images/option1/<?php echo $q['op1_url']; ?>" alt="Image Unavailable" float="left" width="200px" height="200px"/></a><br/> <?php } ?>
		<h5><?php echo "2. ".$q['option2']; ?></h5><br/>
		<?php if($q['op2_url']) { ?><img src="<?php echo base_url();?>static/images/option2/<?php echo $q['op2_url']; ?>" alt="Image Unavailable" float="left" width="200px" height="200px"/></a><br/> <?php } ?>
		<h5><?php echo "3. ".$q['option3']; ?></h5><br/>
		<?php if($q['op3_url']) { ?><img src="<?php echo base_url();?>static/images/option3/<?php echo $q['op3_url']; ?>" alt="Image Unavailable" float="left" width="200px" height="200px"/></a><br/> <?php } ?>
		<h5><?php echo "4. ".$q['option4']; ?></h5><br/>
		<?php if($q['op4_url']) { ?><img src="<?php echo base_url();?>static/images/option4/<?php echo $q['op4_url']; ?>" alt="Image Unavailable" float="left" width="200px" height="200px"/></a><br/> <?php } ?>
		<br/>
		<hr/>
		<h4><?php echo "Correct Option: ".$q['answer']; ?></h4>
		<hr/>
		
	</div>
	<?php } ?>
	<br/>
	&emsp;<h2><center>Thank You for using IEEE Online Test Portal ! -<b>Indranil Chatterjee(Chairman, IEEE BIT MESRA)</b></center></h2>
   
</div>
</div>