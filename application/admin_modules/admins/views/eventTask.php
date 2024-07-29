<form id="eventTaskfrm" method="post">
	<input type="hidden" name="eventName" id="taskEventname">
	<input type="hidden" name="contactId" id="taskEventcontactId">
	<input type="hidden" name="eventId" id="taskEventid">
	<input type="hidden" name="editeventId" id="taskediteventId">
	<input type="hidden" name="userId" id="taskEventuserId">
	<input type="hidden" name="companyId" id="taskEventcompanyId">
	<div class="form-group row">
		<div class="col-md-6">
			<label>Date:</label>
				<div id="taskDate" class="input-group date datepicker cls_datepicker">
					<input type="text" class="form-control cls_date read" name="taskDate">
					<span class="input-group-addon input-group-append border-left">
					<span class="mdi mdi-calendar input-group-text"></span>
					</span>
				</div>
		</div>
		<div class="col-md-6">
			<label>Time:</label>
			<div class="input-group date cls_timepicker" id="taskTime" data-target-input="nearest">
				<div class="input-group" data-target="#taskTime" data-toggle="datetimepicker">
					<input type="text" name="taskTime" class="form-control read datetimepicker-input cls_time" data-target="#taskTime"/>
					<div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Notes:</label>
			<textarea rows="5" name="taskNote" class="form-control read cls_msg"></textarea>
		</div>
    </div>
	<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete <i style="display:none;" class="fa fa-spinner fa-spin eventdeleteloader"></i></button>
	<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
	<button class="btn btn-sm btn-primary text-center btn_eventsave" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin eventloader"></i></button>
</form>
<script src="<?php echo base_url().'themes/admin/js/eventtask.js'; ?>"></script>