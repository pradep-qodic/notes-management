<div class="modal fade" id="additionalinfo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel-2">Add Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="addinfoForm" method="post" action="#" novalidate="novalidate">
					<input type="hidden" name="contactId" id="addinfocontactId">
					<fieldset>
						<div class="row categorylistdiv"></div>
						<div class="row additionalfield_div" style="display:none">
							<div class="col-md-12">
								<div class="form-group html_field"></div>
							</div>
						</div>	
						<button class="btn btn-sm btn-primary" id="additionalinfo_save_btn" type="button" disabled>Save <i style="display:none;" class="fa fa-spinner fa-spin addinfoloader"></i></button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/additionalinfo.js' ?>"></script>