<form id="eventPhonefrm" method="post">
	<input type="hidden" name="eventName" id="phoneEventname">
	<input type="hidden" name="contactId" id="phoneEventcontactId">
	<input type="hidden" name="eventId" id="phoneEventid">
	<input type="hidden" name="editeventId" id="phoneediteventId">
	<input type="hidden" name="userId" id="phoneEventuserId">
	<input type="hidden" name="companyId" id="phoneEventcompanyId">
	<div class="form-group row">
		<div class="col-md-6">
			<label>Date:</label>
				<div id="phoneDate" class="input-group date datepicker cls_datepicker">
					<input type="text" class="form-control cls_date read" name="phoneDate">
					<span class="input-group-addon input-group-append border-left">
					<span class="mdi mdi-calendar input-group-text"></span>
					</span>
				</div>
		</div>
		<div class="col-md-6">
			<label>Time:</label>
			<div class="input-group date cls_timepicker" id="phoneTime" data-target-input="nearest">
				<div class="input-group" data-target="#phoneTime" data-toggle="datetimepicker">
					<input type="text" name="phoneTime" class="form-control read datetimepicker-input cls_time" data-target="#phoneTime"/>
					<div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Notes:</label>
			<textarea name="phoneNote" rows="5" class="form-control read cls_msg"></textarea>
		</div>
    </div>
	<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete <i style="display:none;" class="fa fa-spinner fa-spin eventdeleteloader"></i></button>
	<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
	<button class="btn btn-sm btn-primary text-center btn_eventsave" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin eventloader"></i></button>
</form>
<script src="<?php echo base_url().'themes/admin/js/eventphonecall.js'; ?>"></script>