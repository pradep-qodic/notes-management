<select style="width:85%;" class="form-control js-example-basic-multiple" id="manageassign_tags" name="assign_tags[]" multiple="multiple">
	<?php foreach($Tags as $key=>$value): ?>
		<option data-tagName="<?= $value->tagName;?>" value="<?= $value->tagsId;?>"><?= $value->tagName;?></option>
	<?php endforeach; ?>
</select>
<div class="input-group-append">
	<button class="btn btn-sm btn-info commonbtn manageasssign_tag_btn" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin manageassigntagloader"></i></button>
</div>
