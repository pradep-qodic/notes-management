<div class="col-md-12">
	<div class="form-group">
		<label for="infoname">Select Information Category:</label>
		<select class="form-control" name="infocategory" id="infocategory">
			<option value="">--Select Category--</option>
			<?php foreach($Category as $key=>$value):	?>
			<option data-title="<?= $value['title']; ?>" data-profileurl='<?= $value['pre_url']; ?>' data-type='<?= $value['type']; ?>' data-textname='<?= $value['name']; ?>' value="<?= $key; ?>"><?= $value['field']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>