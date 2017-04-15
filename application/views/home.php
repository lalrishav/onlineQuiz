<!--This page is used to show the content of Dashboard-->
<?php if($this->tank_auth->is_admin()){?>
<div class="widgets">
     <div class="widget">
             <div class="head">
				<h5 class="iFrames">Feedbacks : </h5>
			</div>
			
			     <table cellpadding="0" cellspacing="0" border="0" class="display" id="logs_tbl">
			               <thead>
			               	<tr>
			               		<strong>
			               			<b>
			               				<td width="1%"><b>S.no</td>
			               				<td width="15%"><b>Feedback</td>
			               				<td width="5%"><b>Rating</td>
			               			</b>
			               		</strong>
			               	</tr>
			               </thead>
			               <tbody>
			               	<?php $j=0;
			               	foreach($feedback as $feedbacks){?>
			               	<tr>
			               	   <td><?php echo ++$j?></td>
                               <td><?php echo  nl2br($feedbacks->message)?></td>
                               <td><?php echo $feedbacks->rating?></td>
                             </tr>
                             <?php } ?>
			               </tbody>
			               </table>
		           </div>
</div>
<?php } ?>
<div class="widgets">
	
	<div class="widget">
			<div class="head">
				<h5 class="iFrames">Test Rankings for <?php echo $paper6['name']; ?></h5>
			</div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="logs_tbl">
				<thead>
					<tr>
						<strong><b>
						<td width="5%"><b>S.no.</td>
						<td width="25%"><b>Name</td>
						<td width="15%"><b>Score</td>
						<td width="15%"><b>Rank</td>
						<td width="15%"><b>Batch Rank</td>
						
						</b></strong>
					</tr>
				</thead>
				<tbody>
				
					<?php $j=0;
					foreach($submit6 as $sub6) {?>
					<tr>
						<td><?php echo ++$j; ?></td>
						<td><?php echo $sub6['firstname']." ".$sub6['lastname']; ?></td>
						<td><?php echo $sub6['score']; ?></td>
						<td><?php echo $sub6['rank']; ?></td>
						<td><?php echo $sub6['rank_batch']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
	
	<div class="widget">
			<div class="head">
				<h5 class="iFrames">Test Rankings for <?php echo $paper7['name']; ?></h5>
			</div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="logs_tbl">
				<thead>
					<tr>
						<strong><b>
						<td width="5%"><b>S.no.</td>
						<td width="25%"><b>Name</td>
						<td width="15%"><b>Score</td>
						<td width="15%"><b>Rank</td>
						<td width="15%"><b>Batch Rank</td>
						
						</b></strong>
					</tr>
				</thead>
				<tbody>
				
					<?php $j=0;
					foreach($submit7 as $sub7) {?>
					<tr>
						<td><?php echo ++$j; ?></td>
						<td><?php echo $sub7['firstname']." ".$sub7['lastname']; ?></td>
						<td><?php echo $sub7['score']; ?></td>
						<td><?php echo $sub7['rank']; ?></td>
						<td><?php echo $sub7['rank_batch']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
	<b>Wait for it!</b>
	
	<div class="widget">
			<div class="head">
				<h5 class="iFrames">Test Rankings for <?php echo $paper4['name']; ?></h5>
			</div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="logs_tbl">
				<thead>
					<tr>
						<strong><b>
						<td width="5%"><b>S.no.</td>
						<td width="25%"><b>Name</td>
						<td width="15%"><b>Score</td>
						<td width="15%"><b>Rank</td>
						<td width="15%"><b>Batch Rank</td>
						
					</b></strong>
					</tr>
				</thead>
				<tbody>
				
				<?php $j=0;
				foreach($submit4 as $sub4) {?>
				<tr>
					<td><?php echo ++$j; ?></td>
					<td><?php echo $sub4['firstname']." ".$sub4['lastname']; ?></td>
					<td><?php echo $sub4['score']; ?></td>
					<td><?php echo $sub4['rank']; ?></td>
					<td><?php echo $sub4['rank_batch']; ?></td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<br/>
				<!--<b><center>TBD</center></b>-->
		</div>
		
		<div class="widget">
			<div class="head">
				<h5 class="iFrames">Test Rankings for <?php echo $paper5['name']; ?></h5>
			</div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="logs_tbl">
				<thead>
					<tr>
						<strong><b>
						<td width="5%"><b>S.no.</td>
						<td width="25%"><b>Name</td>
						<td width="15%"><b>Score</td>
						<td width="15%"><b>Rank</td>
						<td width="15%"><b>Batch Rank</td>
						
						</b></strong>
					</tr>
				</thead>
				<tbody>
				
					<?php $j=0;
					foreach($submit5 as $sub5) {?>
					<tr>
						<td><?php echo ++$j; ?></td>
						<td><?php echo $sub5['firstname']." ".$sub5['lastname']; ?></td>
						<td><?php echo $sub5['score']; ?></td>
						<td><?php echo $sub5['rank']; ?></td>
						<td><?php echo $sub5['rank_batch']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>

</div>