<form id="eventRemindfrm" method="post">
	<input type="hidden" name="eventName" id="remindEventname">
	<input type="hidden" name="contactId" id="remindEventcontactId">
	<input type="hidden" name="eventId" id="remindEventid">
	<input type="hidden" name="userId" id="remindEventuserId">
	<input type="hidden" name="companyId" id="remindEventcompanyId">
	<div class="form-group row">
		<div class="col-md-6">
			<label>Date:</label>
				<div id="remindDate" class="input-group date datepicker cls_datepicker">
					<input type="text" class="form-control cls_date read" name="remindDate">
					<span class="input-group-addon input-group-append border-left">
					<span class="mdi mdi-calendar input-group-text"></span>
					</span>
				</div>
		</div>
		<div class="col-md-6">
			<label>Time:</label>
			<div class="input-group date cls_timepicker" id="remindTime" data-target-input="nearest">
				<div class="input-group" data-target="#remindTime" data-toggle="datetimepicker">
					<input type="text" name="remindTime" class="form-control read datetimepicker-input cls_time" data-target="#remindTime"/>
					<div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Channel:</label>
			<div class="form-inline custom-form-inline">
				<div class="form-check form-check-flat form-check-warning">
					<label class="form-check-label">
					<input type="radio" checked name="event_channel" value="sms" class="form-check-input">
					SMS
					<i class="input-helper"></i></label>
				</div>
				<div class="form-check ml-4 form-check-flat form-check-danger">
						<label class="form-check-label">
						<input type="radio" name="event_channel" value="email" class="form-check-input">
						Email
						<i class="input-helper"></i></label>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Notes:</label>
			<textarea rows="5" name="remindNote" class="form-control read cls_msg"></textarea>
		</div>
	</div>
	<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete <i style="display:none;" class="fa fa-spinner fa-spin eventdeleteloader"></i></button>
	<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
	<button class="btn btn-sm btn-primary text-center btn_eventsave" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin eventloader"></i></button>
</form>
<script src="<?php echo base_url().'themes/admin/js/eventremind.js'; ?>"></script>