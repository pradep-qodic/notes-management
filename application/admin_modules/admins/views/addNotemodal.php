<div class="modal fade" id="addnote_modal" tabindex="-1" role="dialog" aria-labelledby="addnote_modal-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="addnote_modal_title">Add Note</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="modaladdnoteForm" method="post" novalidate="novalidate">
					<input type="hidden" name="companyId" id="notecompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
					<input type="hidden" name="userId" id="noteuserId" value="<?php echo $this->session->userdata('userId'); ?>">
					<input type="hidden" name="contactId" id="modalnotecontactId">
					<fieldset>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="notetype">Note Type:</label>
									<select class="form-control" id="noteeventselect" name="noteType">
										<option value="">--Select Event--</option>
										<?php foreach(getNoteEvent() as $key=>$value): ?>
										<option data-noteName="<?= $value; ?>" value="<?= $key; ?>"><?= $value; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="notetitle">Note Title:</label>
								<input type="text" class="form-control" name="noteTitle" id="notetitle">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="contactNote">Note:</label>
								<div class="quill-container contactNote" style="height:150px;"></div>
								<!-- <textarea class="form-control" name="contactNote"></textarea> -->
								</div>
							</div>
						</div>
						  <button class="btn btn-primary" id="modalnote_save_btn" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin btn_loadernote"></i></button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/addnotemodal.js'; ?>"></script>