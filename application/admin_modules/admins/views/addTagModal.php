<div class="modal fade" id="addtag_modal" tabindex="-1" role="dialog" aria-labelledby="addtag_modal-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="addtag_modal_title"></h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="addtagForm" method="post" novalidate="novalidate">
					<input type="hidden" name="companyId" id="tagcompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
					<input type="hidden" name="userId" id="taguserId" value="<?php echo $this->session->userdata('userId'); ?>">
					<input type="hidden" name="tagsId" id="tagId">
					<fieldset>	
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="firstname">Tag Name:</label>
								<input id="tagName" class="form-control" name="tagName" type="text" aria-invalid="true">
								<input id="oldtagName" class="form-control" name="oldtagName" type="hidden" aria-invalid="true">
								</div>
							</div>
						</div>
						<button class="btn btn-primary btn_tagmodal" id="tag_save_btn" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin tagloader"></i></button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/tagmodal.js' ?>"></script>