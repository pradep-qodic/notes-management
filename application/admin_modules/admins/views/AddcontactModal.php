
<div class="modal fade" id="contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel-2">Add Contact</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="addcontactForm" method="post" novalidate="novalidate">
					<input type="hidden" name="companyId" id="contactcompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
					<input type="hidden" name="userId" id="contactuserId" value="<?php echo $this->session->userdata('userId'); ?>">
					<fieldset>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label for="firstname">Firstname:</label>
								<input id="firstname" class="form-control" name="firstname" type="text" aria-invalid="true">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								<label for="lastname">Lastname:</label>
								<input id="lastname" class="form-control" name="lastname" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label for="email">Primary Email Id:</label>
								<input id="email" class="form-control" name="email" type="email">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								<label for="phone_no">Primary Phone No:</label>
								<input id="phone_no" class="form-control bfh-phone" data-format="(ddd) ddd-dddd" name="phone_no" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="overview">Overview:</label>
								<textarea class="form-control" name="overview"></textarea>
								</div>
							</div>
						</div>
						<button class="btn btn-primary" id="contact_save_btn" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin btn_loadercontact"></i></button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
  var input = document.querySelector("#phone_no");
  window.intlTelInput(input);
</script>
<script src="<?php echo base_url().'themes/admin/js/contactmodal.js' ?>"></script>