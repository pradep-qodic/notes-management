<style>
.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
</style>
<?php 
	if(!empty($Notes)){ ?>
	<ul class="bullet-line-list">
		<?php foreach($Notes as $key=>$value): 
		/* get date with -8 hour */
			$date = convertToLocalTime($value->createdOn,'-8'); 
		?>
		<li style="line-height:1.8">
			<p class="mb-0">
			<strong><?php echo date('m/d/y',strtotime($date)); ?> at <?php echo date('h:i A',strtotime($date)); ?></strong>  
			Event - <?php $event = getNoteEvent(); echo $event_type = $event[$value->noteType];?> by <?php echo $value->name; ?>
			- <span class="more"><?php echo $value->notesData;?></span>
			</p>
		</li>
		<?php endforeach;?>
	</ul>
	<?php } else{ ?>
		<h3 class="text-center">No Notes Added</h3>
	<?php } ?>