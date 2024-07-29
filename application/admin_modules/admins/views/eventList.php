<div class="col-md-12">
	<?php if(count($Events) > 0){ ?>
	<ul class="bullet-line-list multi-event-timeline">
	<?php foreach($Events as $key=>$value): ?>
		<li>
			<div class="date-stamp">
			<?= date('d', strtotime($value->eventStartdate)).' '.date('M', strtotime($value->eventStartdate)).'`'.date('y', strtotime($value->eventStartdate)); ?>
			</div>
			<div class="date-event">
				<p>
					<strong><?= date('h:i A', strtotime($value->eventStartime)).' '.$value->eventName; ?></strong> 
				</p>
				<p>
					Event - <?= $value->eventName; ?> by <?= $value->name; ?>
				</p>
				<a href="javascript:void(0);" class="view_event" data-events="<?php echo base64_encode(json_encode($value)); ?>">view more..</a>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
	<?php } else{ ?>
	<center><h3>No Events Added</h3></center>
	<?php } ?>
</div>
<script src="<?php echo base_url().'themes/admin/js/addSequence.js'; ?>"></script>