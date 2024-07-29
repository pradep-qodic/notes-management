<div class="col-12">
	<table id="twilio_numbertbl" class="display nowrap table">
	    <thead>
			<tr>
				<th>Number</th>
                <th>Type</th>
				<th>Freindly Name</th>
				<th>Voice</th>
				<th>SMS</th>
				<th>MMS</th>
				<th>FAX</th>
                <th>Monthly Fee(USD)</th>
                <th>Buy</th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($Numbers as $record):
			$capabilities = json_decode(json_encode($record->capabilities));
        ?>
			<tr>
				<td><?= $record->phone_number; ?></td>
                <td style="text-transform:capitalize;"><?= $Number_type; ?></td>
				<td><?= $record->friendly_name; ?></td>
				<td><?php $class = $capabilities->voice=='1' ? '<i class="fa fa-check fa-2x text-success"></i>' : '<i class="fa fa-close fa-2x text-danger"></i>';?><?php echo $class; ?></td>
				<td><?php $class = $capabilities->SMS=='1' ? '<i class="fa fa-check fa-2x text-success"></i>' : '<i class="fa fa-close fa-2x text-danger"></i>';?><?php echo $class; ?></td>
				<td><?php $class = $capabilities->MMS=='1' ? '<i class="fa fa-check fa-2x text-success"></i>' : '<i class="fa fa-close fa-2x text-danger"></i>';?><?php echo $class; ?></td>
				<td><?php $class = $capabilities->fax=='1' ? '<i class="fa fa-check fa-2x text-success"></i>' : '<i class="fa fa-close fa-2x text-danger"></i>';?><?php echo $class; ?></td>
                <td><?= $MonthlyFee; ?></td>
                <td><button data-number="<?php echo base64_encode(json_encode($record)); ?>" class="btn btn-outline-danger twiliobuy">Buy</button></td>
			</tr>
        <?php endforeach; ?>
		</tbody>
	</table>
</div>
<script src="<?php echo base_url().'themes/admin/js/twiliobuy.js'; ?>"></script>