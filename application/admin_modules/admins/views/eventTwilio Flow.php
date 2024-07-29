<form id="eventTwiliofrm" method="post">
	
	<div class="form-group row">
		<div class="col-md-12">
			<label>Message Body:</label>
			<textarea rows="5" class="form-control read cls_msg"></textarea>
			</div>
		</div>
    </div>
	<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete <i style="display:none;" class="fa fa-spinner fa-spin eventdeleteloader"></i></button>
	<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
	<button class="btn btn-sm btn-primary text-center btn_eventsave" type="button">Save</button>
</form>
<script src="<?php echo base_url().'themes/admin/js/eventsms.js'; ?>"></script>