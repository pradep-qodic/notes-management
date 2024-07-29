<div class="col-12">
	<table id="tmplisttbl" class="display nowrap table">
	    <thead>
			<tr>
                <th>Template Name</th>
                <th>Type</th>
				<!-- <th>Action</th> -->
			</tr>
		</thead>
		<tbody>
        <?php foreach($Templates as $record): ?>
			<tr>
				<td><?= $record->templateName; ?></td>
				<td><?php $type = $record->templateType=='1' ? 'SMS' : 'Email';?><?php echo $type; ?></td>
                <!-- <td><i class="fa fa-trash text-danger fa-2x"></i></td> -->
			</tr>
        <?php  endforeach; ?>
		</tbody>
	</table>
</div>