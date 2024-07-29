<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="filterModaltitle">Add Filter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="addfilterForm" method="post" novalidate="novalidate">
				<input type="hidden" name="companyId" id="filtercompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
				<input type="hidden" name="userId" id="filteruserId" value="<?php echo $this->session->userdata('userId'); ?>">
				<input type="hidden" name="filterData" id="filterData">
					<fieldset>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="filterName">Filtername:</label>
									<input id="filterName" class="form-control" name="filterName" type="text" aria-invalid="true">
								</div>
							</div>
						</div>
						<button class="btn btn-primary" id="filter_save_btn" type="button">Save</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/savefilter.js' ?>"></script>