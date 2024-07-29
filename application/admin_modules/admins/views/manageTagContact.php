<div class="row">
	<div class="col-lg-6 grid-margin ">
				<form id="manageassigntag_tagfrm" method="post">
					<input type="hidden" id="contactId" name="contactId" value="<?php echo $contactId; ?>">
					<h6>Assign Tags</h6>
					<div class="input-group" id="manageselectassigndiv"></div>
				</form>
	</div>
	<div class="col-lg-6 grid-margin ">
		<form id="managecustom_tagfrm" method="post">
			<h6>Custom create a Tag</h6>
			<div class="input-group">
				<input type="text" id="managecustom_tag" name="tagName" class="form-control" placeholder="Tag">
				<div class="input-group-append">
					<button class="btn btn-sm btn-info customcommonbtn managecustom_tag_add" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin managecustomtagloader"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="list align-items-center pb-2">
			<h6>Assigned Tags</h6>
		</div>
		<div class="border-bottom pb-4 pt-2" id="managerefresh_tags"></div>	
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/managetag.js'; ?>"></script>