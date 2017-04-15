<div>
<?php //if ($this->tank_auth->is_privileged('insert_user')) { ?>
<?php //} ?>
<a href="<?php echo base_url(); ?>papers" title="" class="basicBtn">Back to List</a>
<div class="widget first">
	<div class="head"><h5 class="iFrames">Paper Solutions</h5></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="profile_tbl">
		<tbody>
			<tr>
				<td>Paper Name</td>
				<td><h3><?php echo $paper['name']; ?></h3></td>
			</tr>
			<tr>
				<td>Subject</td>
				<td><?php echo $paper['subject']; ?></td>
			</tr>
			<tr>
				<td>Paper Time</td>
				<td><?php echo $paper['time']; ?></td>
			</tr>
			<tr>
				<td>Start Time</td>
				<td><?php echo date('d M Y H:i:s', strtotime($paper['start_time'])); ?></td>
			</tr>
			<tr>
				<td>End Time</td>
				<td><?php echo date('d M Y H:i:s', strtotime($paper['end_time'])); ?></td>
			</tr>
			<tr>
				<td>Remaining Time to Solutions</td>
				<td><h2><span id='timer'></span></h2></td>
			</tr>
			
			
		</tbody>
	</table>
</div>
</div>


<script type="text/javascript">
var rem = <?php echo (strtotime($paper['end_time']) + (10*60)) - strtotime("now");?>;
var tt = Math.floor(new Date().getTime() / 1000) + rem;
var c = rem;
        timedCount();

        function timedCount() {

        	var hours = parseInt( c / 3600 );
        	var minutes = parseInt( c / 60 ) % 60;
        	var seconds = c % 60;

        	var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);

            
        	$('#timer').html(result);
            if(c == 0 )
			{
            	window.location = "<?php echo base_url()."papers/view/".$paper['pid']; ?>";
            }
            if(c%5 == 0)
            {
            	c = tt - Math.floor(new Date().getTime() / 1000);
            }
            c = c - 1;
            setTimeout(function(){ timedCount() }, 1000);
        }
</script>
