<!-- partial -->
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Manage</h4>
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="tag-tab" data-toggle="tab" href="#tag-1" role="tab" aria-controls="home-1" aria-selected="true">Manage tags</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">Contact</a>
						</li> -->
						<?php if($this->session->userdata('user_role')==strtolower('Administrator')){ ?>
						
						<li class="nav-item">
							<a class="nav-link" id="twilio-tab" data-toggle="tab" href="#twilio-1" role="tab" aria-controls="twilio-1" aria-selected="false">Twilio Number</a>
						</li>
						<?php } ?>
						<li class="nav-item">
							<a class="nav-link" id="template-tab" data-toggle="tab" href="#template-1" role="tab" aria-controls="template-1" aria-selected="false">Template</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="campaign-tab" data-toggle="tab" href="#campaign-1" role="tab" aria-controls="campaign-1" aria-selected="false">Campaign</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="tag-1" role="tabpanel" aria-labelledby="tag-tab">
							<div class="col-md-12 text-right pb-2">
								<button class="btn btn-sm btn-primary" id="add_tag_btn">Add Tag</button>
							</div>
							<div class="col-md-12" id="taglisttbl"></div>
						</div>
						<!-- <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
						</div>
						<div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
						</div> -->
						<?php if($this->session->userdata('user_role')==strtolower('Administrator')){ ?>
						<div class="tab-pane fade" id="twilio-1" role="tabpanel" aria-labelledby="twilio-tab">
							<div class="buyhtml"></div>
						</div>
						<?php } ?>
						<div class="tab-pane fade" id="template-1" role="tabpanel" aria-labelledby="template-tab">
							<div class="col-md-12 text-right pb-2">
								<button class="btn btn-sm btn-primary" id="add_template_btn">Add Template</button>
							</div>
							<?php echo $this->load->view('addTemplate'); ?>
							<div class="col-md-12" id="tmplistlist"></div>
						</div>
						<div class="tab-pane fade" id="campaign-1" role="tabpanel" aria-labelledby="campaign-tab">
							<div class="col-md-12 text-right pb-2">
								<button class="btn btn-sm btn-primary" id="add_compaign_btn">Add Compaign</button>
							</div>
							<div class="col-md-12" id="compaignlist"></div>
							<?php echo $this->load->view('addCompaign'); ?>
						</div>
					</div>
				</div>
			</div>
        </div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/settings_tab.js' ?>"></script>