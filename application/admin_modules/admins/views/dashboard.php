<nav class="filtering-section">
		<?php $this->load->view('filterView'); ?>
</nav>
<style>
.ui-autocomplete{
    z-index: 100000000000000;
	height: 250px !important;
    overflow-x: hidden;
    overflow-y: scroll;
}
</style>
<script>
$(window).scroll(function(){
	if($(window).scrollTop()==($(document).height()-window.innerHeight)){			
		start +=limit;
		if(firsttime==1){
			contactlist();
		}
		if(searchfilter==1){
			search_contact();
		}
		if(tagfilterlazy==1){			
			filter_data();
		}
  	}
});
</script>
<script src="<?php echo base_url();?>themes/admin/js/filterview.js"></script>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
		<div class="main-panel">
			<div class="content-wrapper">
			  <!-- View Contact List -->
				<div class="header-with-btn-group pt-4 pb-4">
					<input type="hidden" name="companyId" id="contactListcompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
					<input type="hidden" name="userId" id="contactListuserId" value="<?php echo $this->session->userdata('userId'); ?>">
					<h3>MY CONTACTS <span id="contact_count" style="font-size:16px;"></span></h3>
					<div class="btn-group-wrapper">
						<div class="form-inline searchform" style="">
								<div class="nav-item nav-profile dropdown mb-2">
								<a class="btn btn-primary dropdown-toggle actiondrp" href="#" data-toggle="dropdown" aria-expanded="true" >
									Actions
								</a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown">
									<a class="dropdown-item sendanotification">
									<i class="fa fa-bell-o"></i>
										Send Notification
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item sendallinstantemail">
									<i class="fa fa-envelope-o"></i>
										Send Email to List
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item sendallinstantsms">
									<i class="fa fa-comment-o"></i>
										Send SMS to List
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item showgroupTag">
									<i class="fa fa-tag"></i>
										Group Tag
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item initiateTwilioFlow">
									<i class="fa fa-comment-o"></i>
										Initiate Twilio Flow
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item transferlead">
									<i class="fa fa-exchange"></i>
										Transfer Lead
									</a>
								</div>
							</div>
							<div class="input-group">
								<input type="text" class="form-control mb-2" id="search_contact_code" placeholder="Search" autocomplete="off">
								<div class="input-group-append mb-2">
									<button class="btn btn-sm btn-primary" id="search_contact_code_btn" type="button"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div id="contactlistdiv" class="row"></div>
				<div class="dot-opacity-loader contactloader" style="display:none">
					<span></span>
					<span></span>
					<span></span>
				</div>
			  <!-- End Contact List -->
			</div>
			<!-- content-wrapper ends -->
			<!-- partial -->
		</div>
		  <!-- main-panel ends -->
		  <!-- Load Modal -->
		    <?php $this->load->view('transferLeadModal'); ?>
		  	<?php $this->load->view('compaignModal'); ?>
		    <?php $this->load->view('addgrouptagModal'); ?>
		  	<?php $this->load->view('notificationModal'); ?>
			<?php $this->load->view('addNotemodal'); ?>
			<?php $this->load->view('saveFiltermodal'); ?>
			<?php $this->load->view('instantEmail'); ?>
			<?php $this->load->view('instantSms'); ?>
		 <!-- End Load Modal -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
  <!-- container-scroller -->