<form id="eventSMSfrm" method="post">
	<input type="hidden" name="eventName" id="smsEventname">
	<input type="hidden" name="eventId" id="smsEventid">
	<input type="hidden" name="editeventId" id="smsediteventId">
	<input type="hidden" name="contactId" id="smsEventcontactId">
	<input type="hidden" name="userId" id="smsEventuserId">
	<input type="hidden" name="companyId" id="smsEventcompanyId">
	<div class="form-group row tempdiv">
		<div class="col-md-12">
			<label>Select Template:</label>
			<select class="form-control commontemplate template" name="templateId">
				<option value=''>-- Select Template --</option>
			<?php 
				$smstemplate = getTemplateHelper('1',$this->session->userdata('companyId'),$this->session->userdata('userId'));
				if(!empty($smstemplate)){ 
					foreach($smstemplate as $record): ?>
					 <option data-template="<?php echo base64_encode($record->templateData); ?>" value="<?= $record->templateId; ?>"><?= $record->templateName; ?></option>
			<?php endforeach;			
				}
			?>
			</select>
		</div>
	</div>	
	<div class="form-group row">
		<div class="col-md-6">
			<label>Date:</label>
				<div id="smsDate" class="input-group date datepicker cls_datepicker">
					<input type="text" class="form-control cls_date read" name="smsDate">
					<span class="input-group-addon input-group-append border-left">
					<span class="mdi mdi-calendar input-group-text"></span>
					</span>
				</div>
		</div>
		<div class="col-md-6">
			<label>Time:</label>
			<div class="input-group date" id="smsTime" data-target-input="nearest">
				<div class="input-group" data-target="#smsTime" data-toggle="datetimepicker">
					<input type="text" name="smsTime" class="form-control read datetimepicker-input cls_time" data-target="#smsTime"/>
					<div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row checknow">
		<div class="col-md-1">
			<div class="form-check">
				<label class="form-check-label">
				<input type="checkbox" name="now_instant" id="checknowsmssend" value="1" class="form-check-input">
				Now
				<i class="input-helper"></i></label>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Message Body:</label>
			<textarea name="smsNote" id="smsNote" rows="5" class="form-control read cls_msg" maxlength="1600"></textarea>
			<div id="the-countsms" class="msgcharcount">
				<span id="currentsmscount">0</span>
				<span id="maximumsmscount">/ 1600</span>
			</div>
			</div>
		</div>
    </div>
	<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete <i style="display:none;" class="fa fa-spinner fa-spin eventdeleteloader"></i></button>
	<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
	<button class="btn btn-sm btn-primary text-center btn_eventsave" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin eventloader"></i></button>
</form>
<script src="<?php echo base_url().'themes/admin/js/eventsms.js'; ?>"></script>