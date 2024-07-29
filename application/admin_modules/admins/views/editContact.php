<style>
.editable-error-block{
	color:red !important;
}
.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
.morecontent1 span {
    display: none;
}
.morelink1 {
    display: block;
}
.editlist .editableform .editable-delete{
	display:none;
}
.profile-pic {
  position: relative;
  /* width: 50%;
  max-width: 300px; */
}

.img1 {
  display: block;
}

.editimg {
  position: absolute; 
  bottom: 0; 
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  width: 64px;
  /* transition: .5s ease; */
  color: white;
  font-size: 20px;
  padding: 20px;
  text-align: center;
  border-radius:50%;
  display:none;
}
.profile-pic:hover .editimg {
  display:block;
}
.profile{
	display:none;
}
</style>
<script src="<?php echo base_url().'themes/admin/js/bootstrap-editable.min.js'; ?>"></script>
<script src="<?php echo base_url().'themes/admin/js/editablecontact.js'; ?>"></script>
<?php //_pre($contactDetail); ?>
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
			<div class="header-with-btn-group d-flex flex-row pt-4 pb-4 editcontactheadbtn">
				<div class="title-group-wrapper">
				<form id="imguploadfrm" method="post">
					<div class="profile-pic">
					<img class="img-md rounded-circle img1" height="64px" width="64px" src="<?php echo base_url().'uploads/contactPic/'.$contactDetail->profilePic; ?>" alt="">
						<?php $icon = $contactDetail->profilePic=='defaultUser.png' ? 'fa fa-plus' : 'fa fa-pencil'; ?>
						<div class="editimg"><i class="<?=$icon; ?>"></i></div>
						<input type="file" name="profile_pic" class="profile"/>
						<input type="hidden" name="old_profile_pic" value="<?= $contactDetail->profilePic; ?>"/>
					</div>
					</form>
					<h3><b id="head_firstname"><?php echo strtoupper($contactDetail->firstName); ?></b>&nbsp;<b id="head_lastname"><?php echo strtoupper($contactDetail->lastName); ?></b><span id="head_line"><b> | </b></span><span id="head_overview"><?php echo $contactDetail->overView;?></span></h3>
				</div>
				<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
				<!--<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center d-flex" type="button">
					<span class="mdi mdi-menu" id="buttons"></span>
				</button>-->
				<button class="nav-link dropdown-toggle navbar-toggler navbar-toggler-right d-lg-none align-self-center d-flex custom_drop" id="navbarDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="mdi mdi-menu" id="buttons" style="content:''"></span>
				</button>
					<div class="dropdown-menu" id="custom_drop_btnmenu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" onclick="addNotemodal(<?php echo $contactDetail->contactId;?>)" href="#"><i class="fa fa-edit"></i> Add Note</a>
					  <a class="dropdown-item" href="#"><i class="fa fa-phone"></i> Call</a>
					  <a class="dropdown-item" id="instantemail" href="#"><i class="fa fa-envelope-o"></i> Email</a>
					  <a class="dropdown-item" id="sendsms" href="#"><i class="fa fa-comment-o"></i> SMS</a>
					  <?php if($contactDetail->ownerId==''): ?>
					  <a class="dropdown-item" id="transferlead"><i class="fa fa-exchange"></i> Transfer Lead</a>
					  <?php endif; ?>
					  <a class="dropdown-item" onclick="window.location.href='<?php echo base_url().'admins/dashboard';?>'" href="#"><i class="fa fa-arrow-left"></i> Back To List</a>
					</div>
				</li>
				<div class="btn-group-wrapper">
					<form class="form-inline" _lpchecked="1">
						<div class="nav-item nav-profile dropdown">
							<a class="btn btn-primary dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true" >
								Actions
							</a>
							<div class="dropdown-menu dropdown-menu-right navbar-dropdown">
								<a class="dropdown-item" onclick="addNotemodal(<?php echo $contactDetail->contactId;?>)">
									<i class="fa fa-edit"></i>
									<span class="icon_res">Add Note</span>
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item">
									<i class="fa fa-phone"></i>
									<span class="icon_res">Call</span>
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" id="instantemail">
									<i class="fa fa-envelope-o"></i>
									<span class="icon_res">Email</span>
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" id="sendsms">
									<i class="fa fa-comment-o"></i>
									<span class="icon_res">SMS</span>
								</a>
								<?php if($contactDetail->userId == $this->session->userdata('userId')): ?>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" id="transferlead">
									<i class="fa fa-exchange"></i>
									<span class="icon_res">Transfer Lead</span>
								</a>
								<?php endif; ?>
								
							</div>
						</div>
						<button type="button" onclick="window.location.href='<?php echo base_url().'admins/dashboard';?>'" class="btn btn-primary">
							<i class="fa fa-arrow-left"></i>
							<span class="icon_res">Back To List</span>
						</button>
					</form>
				</div>
				<!-- Load Modal -->
				<?php $this->load->view('transferLeadModal'); ?>
				<?php $this->load->view('instantEmail'); ?> 
				<?php $this->load->view('instantSms'); ?> 
				<?php $this->load->view('addNotemodal'); ?>
				<?php $this->load->view('addAssignTagModal'); ?>
				<div class="modal fade" data-backdrop="static" data-keyboard="false" id="sms_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document" style="max-width:65%">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title sms_title" id="exampleModalLabel-2"></h5>
										<input type="hidden" id="modal_smstitle">
										<input type="hidden" id="modal_smseventid">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div id="smsForm"></div>
									</div>
								</div>
							</div>
						</div>
				<!-- End Load Modal -->
			</div>
			<div class="row">
				<div class="col-lg-4 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<form id="editable-form" class="editable-form" method="post">
							<input type="hidden" id="editableCountryCode" name="countryCode" value="<?php echo $contactDetail->countryCode; ?>">
							<input type="hidden" id="editcompanyId" name="companyId" value="<?php echo $this->session->userdata('companyId'); ?>">
							<input type="hidden" id="edituserId" name="userId" value="<?php echo $this->session->userdata('userId'); ?>">
							<input type="hidden" id="contactId" name="contactId" value="<?php echo $contactDetail->contactId; ?>">
								<div class="list align-items-center border-bottom pb-2 editlist">
									<h6>First Name</h6>
									<p class="update_filed" style="border-bottom:0;" id="firstname" data-type="text" data-pk="<?php echo $contactDetail->contactId; ?>" data-placement="right" data-placeholder="Required" data-title="Enter your firstname"><?php echo $contactDetail->firstName; ?></p>
								</div>
								<div class="list align-items-center border-bottom pt-3 pb-2 editlist">
									<h6>Last Name</h6>
									<p class="update_filed" style="border-bottom:0;" id="lastname" data-type="text" data-pk="<?php echo $contactDetail->contactId; ?>" data-placement="right" data-placeholder="Required" data-title="Enter your lastname"><?php echo $contactDetail->lastName; ?></p>
								</div>
								<div class="list align-items-center border-bottom pt-3 pb-2 editlist">
									<h6>Overview</h6>
									<p class="update_filed" style="border-bottom:0;" id="overView" data-type="textarea" data-pk="<?php echo $contactDetail->contactId; ?>" data-placement="right" data-placeholder="Required" data-title="Enter your overView"><?php echo $contactDetail->overView; ?></p>
								</div>
								<div class="list align-items-center border-bottom pt-3 pb-2 editlist">
									<h6>Email</h6>
									<p class="update_filed" style="border-bottom:0;" id="primaryEmailId" data-type="email" data-pk="<?php echo $contactDetail->contactId; ?>" data-placement="right" data-placeholder="Required" data-title="Enter your primaryEmailId"><?php echo $contactDetail->primaryEmailId; ?></p>
								</div>
								<div class="list align-items-center pt-3 editlist">
									<h6>Phone</h6>
									<p class="update_filed" style="border-bottom:0;" id="primaryPhoneno" data-formatnumber="<?php echo preg_replace("/[^0-9]/", "", $contactDetail->primaryPhoneno); ?>" data-type="text" data-pk="<?php echo $contactDetail->contactId; ?>" data-placement="right" data-placeholder="Required" data-title="Enter your primaryPhoneno"><?php echo $contactDetail->primaryPhoneno; ?></p>
								</div>
								<div class="list align-items-center pt-3 editlist">
									<h6>CountryCode</h6>
									<p class="update_filed" style="border-bottom:0;" id="countryCode" data-type="text" data-pk="<?php echo $contactDetail->contactId; ?>" data-placement="right" data-placeholder="Required" data-title="Enter your primaryPhoneno"><?php echo $contactDetail->countryCode; ?></p>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="list align-items-center pb-2">
								<h6>Assigned Tags</h6>
							</div>
							<div class="border-bottom pb-4 pt-2" id="refresh_tags"></div>
							<div class="border-bottom pb-4 pt-4">
								<form id="assigntag_tagfrm" method="post">
								<input type="hidden" id="assigncontactId" name="contactId" value="<?php echo $contactDetail->contactId; ?>">
									<h6>Assign Tags</h6>
									<div class="input-group" id="selectassigndiv">
										<select class="form-control js-example-basic-multiple" id="assign_tags" name="assign_tags[]" multiple="multiple">
											<option value="">Select a tags...</option>
										</select>
										<div class="input-group-append">
											<button class="btn btn-sm btn-info" type="button">Add</button>
										</div>
										<div class="input-group-append">
											<button class="btn btn-sm btn-info" id="add_assigntag_btn_modal" type="button"><i class="fa fa-plus fa-2x"></i></button>
										</div>
									</div>
								</form>
							</div>
							<div class="pb-4 pt-4">
								<form id="custom_tagfrm" method="post">
									<h6>Custom create a Tag</h6>
									<div class="input-group">
										<input type="text" id="custom_tag" name="tagName" class="form-control" placeholder="Tag">
										<div class="input-group-append">
											<button class="btn btn-sm btn-info custom_tag_add" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin customtagloader"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="list align-items-center pb-2 recenthead" style="display:none">
								<h6>Recent Note</h6>
							</div>
							<div class="border-bottom pb-4 pt-2">
								<p id="recent_note"></p>
								<small class="text-muted added_show" style="display:none"></small>
							</div>
							<div class="list align-items-center pt-2 pb-2">
								<form id="div_add_note_frm" method="post">
									<input type="hidden" name="userId" id="userId" value="<?php echo $this->session->userdata('userId'); ?>">
									<input type="hidden" id="addnotecontactId" name="contactId" value="<?php echo $contactDetail->contactId; ?>">
										<h6>Add a Note</h6>
										<select class="form-control noteeventselect" name="noteType" style="border-bottom:0">
											<option value="">--Select Event--</option>
											<?php foreach(getNoteEvent() as $key=>$value): ?>
											<option data-noteName="<?= $value; ?>" value="<?= $key; ?>"><?= $value; ?></option>
											<?php endforeach; ?>
										</select>
									<!-- <textarea class="form-control mb-3" name="contactNote" rows="3"></textarea> -->
									<input type="text" class="form-control mb-3" name="noteTitle" id="divnoteTitle" placeholder="Enter Note Title"> 
									<!-- <button type="button" class="btn btn-info btn_add_note_div">Add <i style="display:none;" class="fa fa-spinner fa-spin editcntnoteloader"></i></button> -->
									<button type="button" class="btn btn-info opennotemodal">Add</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		  <!-- Tab Content -->
			<div class="pt-1 custom-profile-tab">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#history" role="tab">History</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="additionalinfo-tab" data-toggle="tab" href="#additionalinfo" role="tab">Additional Information</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#text-sequence-manager" role="tab">Sequence Manager</a>
					</li>
					<!--<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#schedule-email-sms" role="tab">Schedule Email/SMS</a>
					</li>-->
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#manage-tags" role="tab">Manage Tags</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#manage-notes" role="tab">Manage Notes</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade show active" id="history" role="tabpanel">
						<div class="historydetail"></div>
					</div>
					<div class="tab-pane fade show" id="additionalinfo" role="tabpanel">
						<div class="col-md-12 d-flex justify-content-between pt-3 py-4">
						<div class="col-md-10"></div>
						<div class="col-md-10">
						<button class="btn btn-sm btn-primary text-left" id="add_info">Add information</button>
						</div>
						</div>
						<?php $this->load->view('additionalInfoModal'); ?>
						<div class="additionalinfo"></div>
					</div>
					<div class="tab-pane fade" id="text-sequence-manager" role="tabpanel">
						<div class="col-md-12 d-flex justify-content-between pt-3 py-4">
							<div class="col-md-10"></div>
							<div class="nav-item nav-profile dropdown col-md-2">
								<a class="btn btn-primary btn-sm  dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-expanded="true" >
								Add a Sequence
								</a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown">
									<?php foreach(getSequenceEvent() as $key=>$value): ?>
									<a class="dropdown-item eventType" data-eventId="<?= $key; ?>" data-name="<?= $value; ?>">
									<?= $value; ?>
									</a>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<div class="row" id="eventlist"></div>
						<div class="modal fade" data-backdrop="static" data-keyboard="false" id="event_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document" style="max-width:65%">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title event_title" id="exampleModalLabel-2"></h5>
										<input type="hidden" id="modal_eventtitle">
										<input type="hidden" id="modal_eventid">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div id="eventForm"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="manage-tags" role="tabpanel">
						<div id="managetagdiv"></div>
					</div>
					<div class="tab-pane fade" id="manage-notes" role="tabpanel">
						<div id="managenotediv"></div>
					</div>
				</div>
			</div>
		  <!-- End tab -->
	    </div>
	</div>
  <!-- End custom js for this page-->	
</div>	
<!-- container ends -->
<script src="<?php echo base_url().'themes/admin/js/editcontact.js'; ?>"></script>