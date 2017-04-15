<div>
<?php //if ($this->tank_auth->is_privileged('insert_user')) { ?>
<?php //} ?>
<a href="<?php echo base_url(); ?>papers" title="" class="basicBtn">Back to List</a>
<div class="widget first">
	<div class="head"><h5 class="iFrames">Paper Details</h5></div>
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
				<td>Remaining Time</td>
				<td><h2><span id='timer'></span></h2></td>
			</tr>
			
			
		</tbody>
	</table>
</div>
<div class="widget first">
	<div class="head"><h5 class="iFrames">Instructions</h5></div>
<div style="margin-left: 20px;">
<ol>
<br/>	1. Marking scheme for the test is 
<br/>	<ul><b><li>&emsp;&emsp;a. Correct Answer: +3</li>
			<li>&emsp;&emsp;c. Wrong Answer : -1</li></b>
	</ul>

</li>
2. Auto submit will submit your paper as the time ends. You are still recommended to submit the paper before the time ends.</li>
<br/>	3. The question can be flagged or saved or skipped.</li>
<br/>	4. Mark a question flag if not sure about the answer</li>
<br/>	5. To submit each answer mark save and continue</li>
<br/>	6. If the paper is not been submitted and the time runs out, the flagged answer will be considered.</li>
<br/>	7. In case of tie break , submission time will be the criteria</li>
<br/>	8.Once a paper get submitted no queries/modifications will be entertained</li>
<br/>	9.All the best for Tesla : TRANSCEND YOUR LIMITS !!!</li>
</ol>
</div>
	
</div>


<script type="text/javascript">
var rem = <?php echo strtotime($paper['start_time'])-strtotime("now");?>;
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
