<a href="<?php echo base_url(); ?>users/<?php echo $group['slug']; ?>/add_performance/<?php echo $user_id; ?>" title="" class="basicBtn">Add Comment</a>

<div class="widget first">
	<div class="head"><h5 class="iFrames">List of Comments</h5></div>
	<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
		<thead>
			<tr>
				<td width="15%">Time</td>
				<td>Comments</td>
				<td width="20%">By</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($performance as $row) { ?>
            <tr>
				<td><?php echo date("Y-m-d H:i:s", $row['time']); ?></td>
				<td><?php echo $row['comments']; ?></td>
				<td><?php echo $row['by_firstname'].' '.$row['by_lastname']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>