<div class="col-12">
	<table id="taglist" class="display nowrap table" style="width:100%">
	    <thead>
			<tr>
				<th>Id</th>
				<th>Tag name</th>
				<th>CreatedOn</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $counter=1; foreach($Taglist as $record): ?>
			<tr>
				<td><?php echo $counter; ?></td>
				<td><?php echo $record->tagName; ?></td>
				<td><?php echo date('Y-m-d',strtotime($record->createdOn)); ?></td>
				<td class="text-right">
				<a id="edit_tag_btn" data_tag="<?php echo base64_encode(json_encode($record)); ?>"><i class="fa fa-edit fa-2x text-success"></i></a>
				&nbsp;&nbsp;<a id="deletetag" onclick="deleteTag(<?php echo $record->tagsId; ?>,'<?php echo $record->tagName;?>')"><i class="fa fa-trash fa-2x text-danger"></i></a>
				</td>
			</tr>
	  <?php $counter++; endforeach; ?>
		</tbody>
	</table>
</div>