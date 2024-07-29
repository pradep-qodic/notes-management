<div class="modal fade" id="transferlead_modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel-2">Transfer Lead</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="trasnferform" method="post" novalidate="novalidate">
					<input type="hidden" id="transferContactID" name="contactId">
					<fieldset>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="userName">Select User:</label>
								    <select class="form-control js-example-basic-multiple" id="userlisttransfer" name="userId[]" multiple="multiple" style="width:100% !important">
                                        <option value=''>-- Select user --</option>
                                    <!-- Call helper for current company's userlist -->
                                    <?php
                                        $userId = $this->session->userdata('userId');
                                        $companyId = $this->session->userdata('companyId');
                                        $userList = getUserList($userId,$companyId);
                                        foreach($userList as $record):
                                    ?>
                                        <option value='<?= $record->userId; ?>'><?= $record->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
								</div>
							</div>
                        </div>
                        <button class="btn btn-primary btn-sm transferbtn" id="transferlead_btn" type="button">Transfer <i style="display:none;" class="fa fa-spinner fa-spin transferloader"></i></button>
					</fieldset>
                </form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/transferLead.js'; ?>"></script>