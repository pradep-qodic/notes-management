<link rel="stylesheet" href="<?php echo base_url().'themes/admin/css/quill.snow.css'; ?>" />
<style>
/* For Custom Button of file upload*/
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>
<script>
/* For Cutomfile upload button*/
$(document).on('change','.up', function(){
	var names = [];
	var length = $(this).get(0).files.length;
		for (var i = 0; i < $(this).get(0).files.length; ++i) {
			names.push($(this).get(0).files[i].name);
		}
		// $("input[name=file]").val(names);
		if(length>2){
		  var fileName = names.join(', ');
		  $(this).closest('.form-group').find('.form-control').attr("value",length+" files selected");
		}
		else{
			$(this).closest('.form-group').find('.form-control').attr("value",names);
		}
});
</script>
<form id="eventEmailfrm" method="post">
	<input type="hidden" name="eventName" id="emailEventname">
	<input type="hidden" name="contactId" id="emailEventcontactId">
	<input type="hidden" name="companyId" id="emailEventcompanyId">
	<input type="hidden" name="userId" id="emailEventuserId">
	<input type="hidden" name="eventId" id="emailEventid">
	<input type="hidden" name="editeventId" id="emailediteventId">
	<div class="form-group row">
		<div class="col-md-12">
			<label>Select Template:</label>
			<select class="form-control commontemplate emailtemplate" name="templateId">
				<option value=''>-- Select Template --</option>
				<?php 
					$smstemplate = getTemplateHelper('2',$this->session->userdata('companyId'),$this->session->userdata('userId'));
					if(!empty($smstemplate)){ 
						foreach($smstemplate as $record): ?>
							<option data-template="<?php echo base64_encode($record->templateData); ?>" value="<?= $record->templateId; ?>"><?= $record->templateName; ?></option>
						<?php endforeach;			
					} ?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Email Id:</label>
			<input class="form-control" id="contactemailId" name="emailId" readonly>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6">
			<label>Date:</label>
				<div id="emailDate" class="input-group date datepicker cls_datepicker">
					<input type="text" class="form-control cls_date read" name="emailDate">
					<span class="input-group-addon input-group-append border-left">
					<span class="mdi mdi-calendar input-group-text"></span>
					</span>
				</div>
		</div>
		<div class="col-md-6">
			<label>Time:</label>
			<div class="input-group date cls_timepicker" id="emailTime" data-target-input="nearest">
				<div class="input-group" data-target="#emailTime" data-toggle="datetimepicker">
				  <input type="text" name="emailTime" class="form-control read datetimepicker-input cls_time" data-target="#emailTime"/>
				  <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Email Subject:</label>
			<input class="form-control read cls_subject" name="email_subject">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6">
			<label>Cc:</label>
			<div class="tags_cc_click">
				<input class="form-control read cls_cc" id="email_cc" name="email_cc">
			</div>
		</div>
		<div class="col-md-6">
			<label>Bcc:</label>
			<div class="tags_bcc_click">
				<input class="form-control read cls_bcc" id="email_bcc" name="email_bcc">
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label>Message Body:</label>
			<div id="eventEmailmsg" class="quill-container" style="height:150px;"></div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12 ">
			<label>Attachments:</label>
			<div class="input-group">
				<input type="text" class="form-control read cls_file" readonly>
				<div class="input-group-btn">
					<span class="fileUpload btn btn-info">
					<span class="upl" id="upload">Upload</span>
					<input type="file" name="eventfile[]" class="upload up" id="up" multiple/>
					</span>
				</div>
			</div>
		</div>
	</div>
<?php if(!empty($Eventdata)){
	$json_data[] = json_decode($Eventdata->eventData);
	if($json_data[0]->attachments!=''){
		$attach = explode(',',$json_data[0]->attachments);
	?>
	<div class="form-group row attachdiv">
		<div class="col-md-12 attachdata">
			<?php for($i=0;$i< count($attach);$i++){ ?>
				<a style="margin:3px !important;" data-files="<?php echo $attach[$i]; ?>" id="removefile" class="badge badge-warning oldfiles"><?php echo $attach[$i]; ?>&nbsp;&nbsp;<i class="fa fa-close removefile"></i></a>
			<?php	} ?>
		</div>
	</div>
<?php }
	}else{ ?>
	<div class="form-group row attachdiv">
		<div class="col-md-12 attachdata">
		</div>
	</div>
	<?php } ?>
	<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete <i style="display:none;" class="fa fa-spinner fa-spin eventdeleteloader"></i></button>
	<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
	<button class="btn btn-sm btn-primary text-center btn_eventsave" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin eventloader"></i></button>
</form>
<script src="<?php echo base_url().'themes/admin/js/quill.js'; ?>"></script>
<script src="<?php echo base_url().'themes/admin/js/eventemail.js'; ?>"></script>