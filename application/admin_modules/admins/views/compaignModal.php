<div class="modal fade" id="selectcompaign_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="compaigntitle">Select Compaign</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="selectcompaignForm" method="post" action="#" novalidate="novalidate">
                    <input type="hidden" name="compaignContactId" id="compaignContactId">
                    <input type="hidden" name="compaignPhone" id="compaignPhone">
                    <fieldset>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="compaignname">Select Compaign:</label>
                                    <select name="conpaignselect" class="form-control" id="conpaignselect">
                                        <option value=''>-- Select Compaign --</option>
                                        <?php $Compaign = getCompaignHepler($this->session->userdata('companyId')); 
                                        foreach($Compaign as $record):
                                        ?>
                                        <option data-url = '<?= $record->webhookUrl; ?>' value='<?= $record->compaignId; ?>'><?= $record->compaignName; ?></option>
                                        <?php endforeach; ?>
                                    </select>
								</div>
							</div>
                        </div>
                        <button class="btn btn-primary" id="compaign_select_btn" type="button">Select <i style="display:none;" class="fa fa-spinner fa-spin selectcompaignloader"></i></button>
					</fieldset>
                </form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/compaignModal.js'; ?>"></script>