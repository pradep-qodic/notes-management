<div class="modal fade" id="addassign_modal" tabindex="-1" role="dialog" aria-labelledby="addtag_modal-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addassign_modal_title">Add Tag</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" method="post" id="modal_assign_tag" action="#" novalidate="novalidate">
				<input type="hidden" name="contactId" id="modalcontactId">
					<fieldset>
						<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-2 text-center">
								<label style="padding:10px;">Search:</label>
							</div>
							<div class="col-md-4">
								<input type="text" id="search_tag" class="form-control mb-2 mr-sm-2" onkeyup="searchTag()" placeholder="Search" autocomplete="off">
							</div>
						</div>
						<div class="row form-group" id="assigntag_html">
						</div>
					  <button class="btn btn-success btn-sm" id="modal_tag_assign_btn" type="button" disabled>Save</button>
					  <button class="btn btn-danger btn-sm cancel_checked_tag" type="button">Cancel</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/addassigntagmodal.js'; ?>"></script>