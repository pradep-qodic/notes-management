<?php foreach($Taglist as $key=>$value): ?>
	<input type="checkbox" data-name="<?= $value->tagName; ?>" class="btn_filter" name="tags_filter[]" value="<?= $value->tagsId; ?>" autocomplete="off">
	<label class="btn btn-sm btn-outline-info filter_label" style="font-size:0.775rem;height:25px;padding:5px;margin:5px;">
	<i class="fa fa-tag" style="font-size:inherit"></i> <?= $value->tagName; ?></label>
<?php endforeach;?>