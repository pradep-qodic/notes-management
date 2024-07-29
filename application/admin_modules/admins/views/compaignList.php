<div class="col-12">
	<table id="compaigntbl" class="display nowrap table">
	    <thead>
			<tr>
				<th>Compaign Name</th>
                <th>Webhook Url</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($Compaign as $record): ?>
			<tr>
				<td><?= $record->compaignName; ?></td>
				<td><?= $record->webhookUrl; ?></td>
                <td class="text-right">
				<a id="edit_compaign" data-compaign="<?php echo base64_encode(json_encode($record)); ?>"><i class="fa fa-edit fa-2x text-success"></i></a>
				&nbsp;&nbsp;<a id="delete_compaign" data-compaign="<?php echo base64_encode(json_encode($record)); ?>"><i class="fa fa-trash fa-2x text-danger"></i></a>
				</td>
			</tr>
        <?php endforeach; ?>
		</tbody>
	</table>
</div>