
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
				<form id="notelistform" method="post">
					<input type="hidden" name="notesId" id="noteIdHidden" value="">
					<fieldset>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Event: </label>
									<select class="form-control editnoteevent" name="noteType">
										<?php foreach(getNoteEvent() as $key=>$value): ?>
										<option data-noteName="<?= $value; ?>" value="<?= $key; ?>"><?= $value; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Title: </label>
									<input type="text" class="form-control" name="noteTitle" id="editnotetitle">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tmlname">Message:</label>
									<div class="quill-container notebody" style="height:150px;"></div>
								</div>
							</div>
						</div>
                </form>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="taglist"></div>
							</div>
						</div>
					</div>
				<button class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
				<button class="btn btn-sm btn-primary noteupdate" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin noteloader"></i></button>
			</div>
		</div>
	</div>
</div>