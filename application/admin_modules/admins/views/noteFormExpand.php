<style>
.ql-toolbar.ql-snow{
	border: 1px solid #ccc;
}
.ql-toolbar.ql-snow + .ql-container.ql-snow  {
	border: 1px solid #ccc;
}
</style>
<script>
var notebody;
$(document).ready(function () {
    // Note form validation
	$('.myformnote').validate({
	rules: {
		noteType: {
			required: true
		},
		noteTitle:{
			required: true
		}
	},
	errorElement: 'em',
	errorPlacement: function errorPlacement(error, element) {
		error.addClass('invalid-feedback');
		if (element.prop('type') === 'checkbox') {
			error.insertAfter(element.parent('label'));
		} else {
			error.insertAfter(element);
		}
	},
	highlight: function highlight(element) {
		$(element).addClass('is-invalid').removeClass('is-valid');
	},
	unhighlight: function unhighlight(element) {
		$(element).addClass('is-valid').removeClass('is-invalid');
	}
});
    // Note form assign tag validation
    $('.noteassigntagfrm').validate({
		rules: {
			'assign_tags[]': {
				required: true
			}
		},
		errorElement: 'em',
		errorPlacement: function errorPlacement(error, element) {
			error.addClass('invalid-feedback');
			if (element.prop('type') === 'checkbox') {
				error.insertAfter(element.parent('label'));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function highlight(element) {
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function unhighlight(element) {
			$(element).addClass('is-valid').removeClass('is-invalid');
		}
    });
     // Note form custom tag validation
    $('.notecustomtagfrm').validate({
		rules: {
			tagName: {
				required: true,
				remote: {
					url: url + 'admins/checkTagExits',
					type: 'post',
					data: {
						tagName: function () {
							return $(".notecustomtag").val();
						}
					}
				}
			}
		},
		messages: {
			tagName: {
				remote: "Tagname already exist"
			}
		},
		errorElement: 'em',
		errorPlacement: function errorPlacement(error, element) {
			error.addClass('invalid-feedback');
			if (element.prop('type') === 'checkbox') {
				error.insertAfter(element.parent('label'));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function highlight(element) {
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function unhighlight(element) {
			$(element).addClass('is-valid').removeClass('is-invalid');
		}
    }); 
});
</script>
<form  method="post" class="myformnote" id="frmId_<?= $record['notesId']; ?>">
    <input type="hidden" name="notesId" id="noteIdHidden" value="<?= $record['notesId']; ?>">
    <input type="hidden" name="contactId" id="contactId" value="<?= $record['contactId']; ?>">
    <input type="hidden" name="hiddenNoteType" id="hiddenNoteType" value="<?php echo getNoteEvent($record['noteType']); ?>">
    <fieldset>
    <div class="row editnotetitlediv">
        <div class="col-md-12">
			<div class="form-group">
				<label>Title: </label>
				<input type="text" class="form-control" id="editnotetitle" name="noteTitle" id="" value="<?= $record['noteTitle']=='' ? 'Untitled Note': $record['noteTitle']; ?>">
			</div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>Event: </label>
				<select class="form-control editnoteevent" name="noteType">
					<?php foreach(getNoteEvent() as $key=>$value): 
						$selected = $record['noteType'] == $key ? 'selected' : '';
					?>
					<option <?= $selected; ?> data-noteName="<?= $value; ?>" value="<?= $key; ?>"><?= $value; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="tmlname">Message:</label>
				<div class="quill-container divnotebody" id="recID_<?= $record['notesId']; ?>" style="height:auto;min-height:150px;"><?= $record['notesData']; ?></div>
			</div>
		</div>
	</div>
    </fieldset>
</form>
<!-- Tag Contents -->
<div class="row">
	<div class="col-lg-6 grid-margin ">
        <form method="post" class="noteassigntagfrm">
            <h6>Assign Tags</h6>
            <div class="input-group" id="noteselectassigndiv">
                <select style="width:85%;" class="form-control js-example-basic-multiple noteassigntag" name="assign_tags[]" multiple="multiple">
                </select>
                <div class="input-group-append">
                    <button class="btn btn-sm btn-info noteassigntagbtn" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin noteassigntagloader"></i></button>
                </div>
            </div>
        </form>
	</div>
	<div class="col-lg-6 grid-margin ">
		<form method="post" class="notecustomtagfrm">
			<h6>Custom create a Tag</h6>
			<div class="input-group">
				<input type="text" name="tagName" class="form-control notecustomtag" placeholder="Tag">
				<div class="input-group-append">
					<button class="btn btn-sm btn-info notecustomtagbtn" type="button">Add <i style="display:none;" class="fa fa-spinner fa-spin notecustomtagloader"></i></button>
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
		<div class="border-bottom pb-4 pt-2 availtagsnote"></div>	
	</div>
</div>
<!-- End tag Content -->
<button class="btn btn-sm btn-danger closebtn" data-dismiss="modal" aria-label="Close" type="button" style="display:none">Cancel</button>
<button class="btn btn-sm btn-danger deletebtn" type="button" onclick="deleteNote(<?php echo $record['notesId']; ?>)">Delete</button>
<button class="btn btn-sm btn-primary noteupdate" id="<?= $record['notesId']; ?>" type="button">Save <i style="display:none;" class="fa fa-spinner fa-spin noteloader"></i></button>