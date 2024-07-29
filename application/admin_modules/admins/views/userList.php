<div class="col-12">
	<table id="userlist" class="display nowrap table">
	    <thead>
			<tr>
				<th>Id</th>
				<th>User Name</th>
				<th>Email</th>
				<!-- <th>Assigned</th> -->
				<th>Role</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $counter=1; foreach($Users as $value): ?>
			<tr>
				<td><?php echo $counter; ?></td>
				<td><?php echo $value->name; ?></td>
				<td><?php echo $value->emailId; ?></td>
				<!-- <td><?php echo $value->companyId!=0 ? 'Assigned':'<button class="btn btn-sm btn-success">Assign</button>'; ?></td> -->
				<td><?php echo $value->userRole; ?></td>
				<td class="text-right">
				<a id="edit_user_btn" data_user="<?php echo base64_encode(json_encode($value)); ?>"><i class="fa fa-edit fa-2x text-success"></i></a>
				&nbsp;&nbsp;<a id="deleteuser" onclick="deleteUser('<?php echo base64_encode(json_encode($value)); ?>')"><i class="fa fa-trash fa-2x text-danger"></i></a>
				</td>
			</tr>
		<?php $counter++;  endforeach; ?>
		</tbody>
	</table>
</div>