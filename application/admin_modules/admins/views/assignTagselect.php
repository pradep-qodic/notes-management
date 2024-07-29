<select class="form-control js-example-basic-multiple assign_tags" id="assign_tags" name="assign_tags[]" multiple="multiple">
	<?php foreach($Tags as $key=>$value): ?>
	<option data-tagName="<?= $value->tagName;?>" value="<?= $value->tagsId;?>"><?= $value->tagName;?></option>
	<?php endforeach; ?>
</select>
<div class="input-group-append">
	<button class="btn btn-sm btn-info asssign_tag_btn" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin assigntagloader"></i></button>
</div>
<div class="input-group-append" style="margin-left:5px;">
	<button class="btn btn-sm btn-info" id="add_assigntag_btn_modal" type="button"><i class="fa fa-plus fa-2x"></i></button>
</div>
