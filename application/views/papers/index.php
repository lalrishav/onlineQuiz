<?php if (false || $this->tank_auth->is_privileged('create_paper')) { ?>
<a href="<?php echo base_url('papers/create'); ?>" title="" class="basicBtn">Create Paper</a>
<?php } ?>

<div class="widget first">
	<div class="head"><h5 class="iFrames">List of Papers</h5></div>
	<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
		<thead>
			<tr>
				<td width="15%">Name</td>
				<td width="5%">Subject</td>
				<td width="5%">Status</td>
				<td width="10%">Start Time</td>
				<td width="10%">End Time</td>
				<td width="10%">Score</td>
				<td width="10%">Action</td>
				<?php if($this->tank_auth->is_privileged('edit_paper')){?><td width="10%">Action</td><?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($papers as $paper) { ?>
            <tr>
				<td align="center"><?php echo $paper['name']; ?></td>
				<td align="center"><?php echo $paper['subject']; ?></td>
				<td align="center"><?php if((strtotime("now") >= strtotime($paper['start_time'])) && (strtotime("now") <= strtotime($paper['end_time'])))
							echo "Active";
						else if(strtotime("now") >= strtotime($paper['end_time']))
							echo "Ended";
						else
							echo "Coming Up";
				 ?></td>
				<td align="center"><?php echo date("d M Y H:i:s", strtotime($paper['start_time'])); ?></td>
				<td align="center"><?php echo date("d M Y H:i:s", strtotime($paper['end_time'])); ?></td>
				<td align="center"><?php echo ($scores[$paper['pid']] === NULL)?"-":$scores[$paper['pid']]; ?></td>
				<td align="center">
				<?php

			if($this->paper_model->has_submitted($paper['pid'], $this->tank_auth->get_user_id())&&(strtotime("now") >= strtotime($paper['start_time'])) && (strtotime("now") <= strtotime($paper['end_time'])))
                        echo "Submited";
				else if((strtotime("now") >= strtotime($paper['start_time'])) && (strtotime("now") <= strtotime($paper['end_time'])))
							echo anchor('papers/view/'.$paper['pid'], "Attempt Now");
						else if(strtotime("now") >= strtotime($paper['end_time']))
							echo anchor('papers/view/'.$paper['pid'], "View Solution");
						else
							echo anchor('papers/view/'.$paper['pid'], "Attempt");
				 ?></td>
                <?php $pid=$paper['pid'] ?>
				<?php if ($this->tank_auth->is_privileged('edit_paper')&&(((strtotime("now")<strtotime($paper['start_time']))||strtotime("now") >= strtotime($paper['start_time'])) && (strtotime("now") <= strtotime($paper['end_time'])))) {?> <td align="center">
				    
					<?php echo $this->tank_auth->is_privileged('update_user') ? add_btn("papers/edit_paper?pid=$pid") : ''; ?>
                    <?php echo $this->tank_auth->is_privileged('update_user') ? delete_btn("papers/delete_paper?pid=$pid") : ''; ?>
					<?php echo $this->tank_auth->is_privileged('delete_user') ? update_btn("papers/create?pid=$pid& flag=1") : ''; } ?>

			    <?php if($this->tank_auth->is_privileged('edit_paper')&&(strtotime("now") >= strtotime($paper['end_time']))){?>
			    <td align="center">
			    <?php echo $this->tank_auth->is_privileged('delete_user') ? update_btn("papers/create?pid=$pid& flag=1") : ''; ?>
			    	<?php echo $this->tank_auth->is_privileged('delete_user') ? delete_btn("papers/delete_paper?pid=$pid") : ''; }?>
			    </td><?php ?>
			</tr>
			<?php  } ?>
		</tbody>
	</table>
</div>


