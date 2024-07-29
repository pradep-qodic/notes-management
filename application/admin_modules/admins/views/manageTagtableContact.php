<div class="col-12">
	<table id="managetaglist" class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Tag name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $counter=1; foreach($Taglist as $record): ?>
			<tr>
				<td><?php echo $counter; ?></td>
				<td><?php echo $record->tagName; ?></td>
				<td>
				<button class="btn btn-sm btn-danger" id="deletetag" onclick="deleteTag(<?php echo $record->tagsId; ?>)"><i class="fa fa-trash"></i></button>
				</td>
			</tr>
			<?php $counter++; endforeach; ?>
		</tbody>
	</table>
</div>