<div class="modal fade " data-backdrop="static" data-keyboard="false" id="instantsms_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document"  style="max-width:65%">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal_instantsmstitle" id="exampleModalLabel-2"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="instantSmsfrm" method="post">
					<input type="hidden" name="eventName" id="instantsmsEventname">
					<input type="hidden" name="contactId" id="instantsmsEventcontactId">
					<input type="hidden" name="companyId" id="instantsmsEventcompanyId">
					<input type="hidden" name="userId" id="instantsmsEventuserId">
					<input type="hidden" name="eventId" id="instantsmsEventid">
					<div class="form-group row tempdiv">
						<div class="col-md-12">
							<label>Select Template:</label>
							<select class="form-control commontemplate instanttemplate" name="templateId">
								<option value=" ">-- Select Template --</option>
								<?php 
									$smstemplate = getTemplateHelper('1',$this->session->userdata('companyId'),$this->session->userdata('userId'));
									if(!empty($smstemplate)){ 
										foreach($smstemplate as $record):
										 ?>
											<option data-template="<?php echo base64_encode($record->templateData); ?>" value="<?= $record->templateId; ?>"><?= $record->templateName; ?></option>
										<?php endforeach;			
									} ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<label>Phone No:</label>
							<input type="hidden" name="phoneNo" id="instantcontactphone" class="form-control" readonly/>
							<input type="text" name="phoneNoshow" id="instantcontactphoneformat" class="form-control" readonly/>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-md-6">
							<label>Date:</label>
							<div id="instantsmsDate" class="input-group date datepicker cls_datepicker">
								<input type="text" class="form-control cls_date read" name="instantsmsDate">
								<span class="input-group-addon input-group-append border-left">
								<span class="mdi mdi-calendar input-group-text"></span>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<label>Time:</label>
							<div class="input-group date" id="instantsmsTime" data-target-input="nearest">
							<div class="input-group" data-target="#instantsmsTime" data-toggle="datetimepicker">
							<input type="text" name="smsTime" class="form-control read datetimepicker-input instantsmsTime" data-target="#instantsmsTime"/>
							<div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
							</div>
							</div>
						</div>
					</div>
					<div class="form-group row checknow">
						<div class="col-md-1">
							<div class="form-check">
								<label class="form-check-label">
								<input type="checkbox" name="now_instant" id="instantchecknowsmssend" value="1" class="form-check-input checkinstant">
								Now
								<i class="input-helper"></i></label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<label>Message Body:</label>
							<textarea name="smsNote" class="form-control" id="instantsmsbody" maxlength="1600"></textarea>
							<div id="the-countinstantsms" class="msgcharcount">
							<span id="current">0</span>
							<span id="maximum">/ 1600</span>
							</div>
							</div>
						</div>
						<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete</button>
						<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
						<button class="btn btn-sm btn-primary text-center btn_instantsmssave" type="button">Send</button>
						<button class="btn btn-sm btn-primary loader-btn" type="button" style="display:none" disabled>
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						Loading...
						</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/instantsms.js'; ?>"></script>