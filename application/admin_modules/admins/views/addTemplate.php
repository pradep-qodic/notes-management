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
#addtemplateemailForm{
    display: none;
}
</style>
<script>
/* For Cutomfile upload button*/
$(document).on('change','.tmlup', function(){
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
<div class="modal fade" id="template_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width:65%">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel-2">Add Template</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <label>Select Type:</label>
                        <select class="form-control tmltype" name="tmltype">
                            <option value="1">SMS</option>
                            <option value="2">Email</option>
                        </select>
                    </div>
                </div>
                <br>
				<form class="cmxform" id="addtemplatesmsForm" method="post" action="#" novalidate="novalidate">
					<input type="hidden" name="companyId" id="templatesmscompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
					<input type="hidden" name="userId" id="templatesmsuserId" value="<?php echo $this->session->userdata('userId'); ?>">
					<fieldset>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="tmlname">Template Name:</label>
								    <input type="text" class="form-control" name="tmlSMSName" id="tmlSMSName" value="">
								</div>
							</div>
                        </div>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="tmlsmsbody">Message Body:</label>
								<textarea class="form-control" id="tmlSmsBody" name="tmlSmsBody" maxlength="1600"></textarea>
                                    <div id="the-counttemplate" class="msgcharcount">
                                    <span id="currenttemplate">0</span>
                                    <span id="maximumtemplate">/ 1600</span>
                                    </div>
								</div>
							</div>
                        </div>
                        <button class="btn btn-primary" id="tml_sms_save_btn" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin tmlloader"></i></button>
					</fieldset>
                </form>
                <form class="cmxform" id="addtemplateemailForm" method="post" action="#" novalidate="novalidate">
					<input type="hidden" name="companyId" id="templateemailcompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
					<input type="hidden" name="userId" id="templateemailuserId" value="<?php echo $this->session->userdata('userId'); ?>">
					<fieldset>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="tmlname">Template Name:</label>
								    <input type="text" class="form-control" name="tmlEmailName" id="tmlEmailName" value="">
								</div>
							</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Email Subject:</label>
                                <input class="form-control read" name="tmlEmailSubject">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Message Body:</label>
                                <div id="tmlEmailmsg" class="quill-container" style="height:150px;"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 ">
                                <label>Attachments:</label>
                                <div class="input-group">
                                <input type="text" class="form-control read" readonly>
                                <div class="input-group-btn">
                                    <span class="fileUpload btn btn-info">
                                    <span class="upl" id="tmlemailupload">Upload</span>
                                    <input type="file" name="tmlemailfile[]" class="upload tmlup" id="tmlup" multiple/>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <button class="btn btn-primary" id="tml_email_save_btn" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin tmlloader"></i></button>
                </form>
                
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/templatemodal.js' ?>"></script>