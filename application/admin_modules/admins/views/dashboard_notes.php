<!-- partial -->
<style>
.ql-toolbar.ql-snow{
	border-color: #ccc !important;
}
.ql-toolbar.ql-snow + .ql-container.ql-snow  {
	border: 1px solid #ccc;
}
</style>
<script>
$(window).scroll(function(){
	if($(window).scrollTop()==($(document).height()-window.innerHeight)){			
		notestart +=notelimit;
		if(notefirsttime==1){
			dashboardnotesList();
		}
		if(notesearchfilter==1){
			notesearch_contact();
		}
		if(notetagfilterlazy==1){			
			notefilter_data();
		}
  	}
});
</script>
<nav class="filtering-section">
		<?php $this->load->view('filterView'); ?>
</nav>
<script src="<?php echo base_url();?>themes/admin/js/notefilterview.js"></script>
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
			<!-- View Contact List -->
			<div class="header-with-btn-group pt-4 pb-4">
				<input type="hidden" name="companyId" id="contactListcompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
				<input type="hidden" name="userId" id="contactListuserId" value="<?php echo $this->session->userdata('userId'); ?>">
				<h3>MY NOTES <span id="contact_count" style="font-size:16px;"></span></h3>
				<div class="btn-group-wrapper">
					<div class="form-inline searchform" style="">
							<div class="mb-2" id="btnContainer">
							<button class="btn btn-primary" title="List View" id="listView"><i class="fa fa-bars"></i><i class='fa fa-spinner fa-spin listloader' style="display:none"></i></button> 
							<button class="btn btn-primary active" title="Grid View" id="gridView" style="display:none;"><i class="fa fa-th-large"></i><i class='fa fa-spinner fa-spin gridloader' style="display:none"></i></button>
							</div>
							<div class="nav-item nav-profile dropdown mb-2">
								<a class="btn btn-primary dropdown-toggle sortby" href="#" data-toggle="dropdown" aria-expanded="true" >
									Sort By
								</a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown">
									<a class="dropdown-item sortbydata" data-sortpass="createdOn" data-sort="Latest created">
									<i class="fa fa-calendar"></i>
										Latest created
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item sortbydata" data-sortpass="updatedOn" data-sort="Latest updated">
									<i class="fa fa-calendar"></i>
										Latest updated
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item sortbydata" data-sortpass="contactId" data-sort="By contacts">
									<i class="fa fa-address-card"></i>
										By contacts
									</a>
								</div>
							</div>
							<div class="nav-item nav-profile dropdown mb-2">
								<a class="btn btn-primary dropdown-toggle actiondrp" href="#" data-toggle="dropdown" aria-expanded="true" >
									Actions
								</a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown">
									<a class="dropdown-item">
									<i class="fa fa-bell-o"></i>
										Send Notification
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item ">
									<i class="fa fa-envelope-o"></i>
										Send Email to List
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item ">
									<i class="fa fa-comment-o"></i>
										Send SMS to List
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item ">
									<i class="fa fa-tag"></i>
										Group Tag
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item ">
									<i class="fa fa-comment-o"></i>
										Initiate Twilio Flow
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item ">
									<i class="fa fa-exchange"></i>
										Transfer Lead
									</a>
								</div>
							</div>
						<div class="input-group">
							<input type="text" class="form-control mb-2" id="search_note_code" placeholder="Search" autocomplete="off">
							<div class="input-group-append mb-2">
								<button class="btn btn-sm btn-primary" id="search_note_code_btn" type="button"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="noteslistdiv" class="row"></div>
			<div class="dot-opacity-loader notesloader" style="display:none">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<!-- End Contact List -->
		</div>
		<!-- content-wrapper ends -->
		<!-- Load Modal -->
		<div class="modal fade " data-backdrop="static" data-keyboard="false" id="notelist_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document"  style="max-width:65%">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title modal_notelisttitle" id="exampleModalLabel-2"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="modalform">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Filter Modal -->
		<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="filterModaltitle">Add Filter</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="cmxform" id="addfilterForm" method="post" novalidate="novalidate">
						<input type="hidden" name="companyId" id="filtercompanyId" value="<?php echo $this->session->userdata('companyId'); ?>">
						<input type="hidden" name="userId" id="filteruserId" value="<?php echo $this->session->userdata('userId'); ?>">
						<input type="hidden" name="filterData" id="filterData">
							<fieldset>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="filterName">Filtername:</label>
											<input id="filterName" class="form-control" name="filterName" type="text" aria-invalid="true">
										</div>
									</div>
								</div>
								<button class="btn btn-primary" id="filter_save_btn" type="button">Save</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End Filter modal -->
		<!-- End Load Modal -->
		<!-- partial -->
	</div>
		<!-- main-panel ends -->
		<!-- Load Modal -->
		<!-- End Load Modal -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<script src="<?php echo base_url(); ?>themes/admin/js/dashboardnotes.js"></script>