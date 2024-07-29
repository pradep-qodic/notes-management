<?php 
	$additionalDetails = json_decode($additionalInfo->additionalDetails);
?>
<?php if(!empty($additionalDetails)){ ?>
<form id="editableinfoform" class="editableinfoform" method="post">
	<div class="row">
		<?php foreach($additionalDetails as $key=>$value):?>
		<div class="col-lg-6 grid-margin stretch-card">
			<div class="list align-items-center pb-2">
				<h6><?= $value->label; ?></h6>
				<?php if($value->pre_url !="" || $value->label == 'Photo URL'){ 
					$href = "<a target='_blank' href=".$value->pre_url.''.$value->value.">".$value->value."</a>";
				}else{
					$href =$value->value;
				}
				?>
				<p class="update_additionalinfo" style="border-bottom:0;" data-title="<?= $value->title; ?>" data-name="<?= $value->label; ?>" data-type="<?= $value->type; ?>" data-pk="<?= $value->id; ?>" data-placement="right" data-placeholder="Required"><?= $href; ?></p>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</form>
<?php }else{ ?>
<div class="row">
	<div class="col-lg-12 text-center">
		<h3>No Additional information added</h3>
	</div>
</div>
<?php } ?>
<script src="<?php echo base_url().'themes/admin/js/editableaddinfo.js'; ?>"></script>