<div class="modal fade" id="notification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel-2">Send Notification</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="notifiform" method="post" novalidate="novalidate">
					<fieldset>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="tmlname">Title:</label>
								    <input type="text" class="form-control" name="title" id="title" value="">
								</div>
							</div>
                        </div>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="tmlname">To:</label>
									<input type="text" class="form-control" name="email" id="notifiemail" value="">
								</div>
							</div>
                        </div>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="tmlsmsbody">Message:</label>
								<textarea class="form-control" name="message"></textarea>
								</div>
							</div>
                        </div>
                        <button class="btn btn-primary" id="send_notifi_save_btn" type="button">Send <i style="display:none;" class="fa fa-spinner fa-spin notifiloader"></i></button>
					</fieldset>
                </form>
			</div>
		</div>
	</div>
</div>

