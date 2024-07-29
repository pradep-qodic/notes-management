<?php if(count($History) > 0){ ?>
<ul class="bullet-line-list">
	<?php foreach($History as $key=>$value):
	/* get date with -8 hour */
	 $date = convertToLocalTime($value->createdOn,'-8'); 
		if($value->userType=='1'){
			$type = 'Company';
		}else if($value->userType=='2'){
			$type = 'User';
		}else if($value->userType=='3'){
			$type = 'Contact';
		}else if($value->userType=='4'){
			$type = 'Event';
		}else if($value->userType=='5'){
			$type = 'Tag';
		}else if($value->userType=='6'){
			$type = 'Note';
		}else if($value->userType=='7'){
			$type = 'Additional Information';
		}
	?>
	<li>
		<p class="mb-0">
		<strong><?php echo date('m/d/y',strtotime($date)); ?> at <?php echo date('h:i A',strtotime($date)); ?></strong> 
		<?= $type; ?>: <?= $value->contentText; ?>
		</p>
	</li>
	<?php endforeach; ?>
 </ul>
<?php } else{ ?>
	<h3 class="text-center">No history found</h3>
<?php } ?>