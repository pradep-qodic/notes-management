<style>
.select2-container{
    width: 88% !important;
}
</style>
<div class="modal fade" id="addgrouptag_modal" tabindex="-1" role="dialog" aria-labelledby="addgrouptag_modal-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addassign_modal_title">Group Tag</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
            <form id="grpassigntag_tagfrm">
                    <h6>Assign Tags</h6>
                    <div class="input-group">
                        <select class="form-control js-example-basic-multiple" id="grpassign_tags" name="assign_tags[]" multiple="multiple">
                            
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-info grpassign_tag_add" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin btn_loaderassigngrptag"></i></button>
                        </div>
                    </div>
				</form>
                <div class="border-bottom pb-4 pt-4"></div>
                <form class="cmxform" id="groupcustom_tag_frm">
                    <h6>Add Custom Tag</h6>
                    <div class="input-group">
                        <input type="text" id="grpcustom_tag" name="tagName" class="form-control" placeholder="Tag">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-info grpcustom_tag_add" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin btn_loadercustomgrptag"></i></button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>