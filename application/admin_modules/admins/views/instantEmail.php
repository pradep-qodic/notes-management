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
/* For Custumfile upload button*/
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="instantemail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width:65%">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal_instantemailtitle" id="exampleModalLabel-2"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="instantEmailfrm" method="post">
					<input type="hidden" name="eventName" id="instantemailEventname">
					<input type="hidden" name="contactId" id="instantemailEventcontactId">
					<input type="hidden" name="companyId" id="instantemailEventcompanyId">
					<input type="hidden" name="userId" id="instantemailEventuserId">
					<input type="hidden" name="eventId" id="instantemailEventid">
					<div class="form-group row templateDiv">
						<div class="col-md-12">
							<label>Select Template:</label>
							<select class="form-control commontemplate instantemailtemplate" name="templateId">
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
							<input class="form-control" id="instantcontactemailId" name="emailId" readonly>
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
							<div class="instant_cc_click">
								<input class="form-control read cls_cc" id="instantemail_cc" name="email_cc">
							</div>
						</div>
						<div class="col-md-6">
							<label>Bcc:</label>
							<div class="instant_bcc_click">
								<input class="form-control read cls_bcc" id="instantemail_bcc" name="email_bcc">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
						  <label>Message Body:</label>
						  <div id="instantEmailmsg" class="quill-container" style="height:150px;">
						  </div>
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
					<div class="form-group row">
						<div class="col-md-12 attachments">
						</div>
					</div>
						<button class="btn btn-sm btn-danger text-center btn_deleteevent" data-contactId="" data-event_id="" style="display:none" type="button">Delete</button>
						<button class="btn btn-sm btn-warning text-center btn_eventedit" type="button" style="display:none" data-event_id="">Edit</button>
						<button class="btn btn-sm btn-primary text-center btn_instantemailsave" type="button">Send</button>
						<button class="btn btn-sm btn-primary loader-btn" type="button" style="display:none" disabled>
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						Loading...
						</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/quill.js'; ?>"></script>
<script src="<?php echo base_url().'themes/admin/js/instantemail.js'; ?>"></script>