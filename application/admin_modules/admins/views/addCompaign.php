<div class="modal fade" id="compaign_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width:65%">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="compaigntitle">Add Compaign</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="addcompaignForm" method="post" action="#" novalidate="novalidate">
					<input type="hidden" name="companyId" id="compaigncompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
					<input type="hidden" name="userId" id="compaignuserId" value="<?php echo $this->session->userdata('userId'); ?>">
					<input type="hidden" name="compaignId" id="compaignId">
                    <fieldset>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="compaignname">Compaign Name:</label>
								    <input type="text" class="form-control" name="compaignName" id="compaignName">
								</div>
							</div>
                        </div>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="webhookUrl">Webhook URL:</label>
								    <input type="text" class="form-control" name="webhookUrl" id="webhookUrl" >
								</div>
							</div>
                        </div>
                        <button class="btn btn-primary" id="compaign_save_btn" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin compaignloader"></i></button>
					</fieldset>
                </form>
			</div>
		</div>
	</div>
</div>