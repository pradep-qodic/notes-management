<div class="modal fade" id="adduser_modal" tabindex="-1" role="dialog" aria-labelledby="adduser_modal-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="adduser_modal_title"></h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="adduserForm" method="post" action="#" novalidate="novalidate">
                <input type="hidden" name="set_edit_userid" id="set_edit_userid">
                <input type="hidden" name="set_edit_username" id="set_edit_username">
					<fieldset>	
						<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Username:</label>
                                    <input id="userName" class="form-control" name="userName" type="text" aria-invalid="true">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Email:</label>
                                    <input id="userEmail" class="form-control" name="userEmail" type="text" aria-invalid="true">
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name:</label>
                                    <input id="firstName" class="form-control" name="firstName" type="text" aria-invalid="true">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Last Name:</label>
                                    <input id="lastName" class="form-control" name="lastName" type="text" aria-invalid="true">
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-6 pass_div">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input id="password" class="form-control" name="password" type="password" aria-invalid="true">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Select Role:</label>
                                    <select name="role" id="role" class="form-control" style="height:43px">
                                    <?php 
                                        $roles_obj = new WP_Roles();
                                        $roles_names_array = $roles_obj->get_names();
                                        foreach ($roles_names_array as $role_name): ?>
                                            <option value="<?= $role_name; ?>"><?= $role_name; ?></option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
						</div>
						<button class="btn btn-primary" id="user_save_btn" type="button">Save <i style="display:none;" id="btn_loader" class="fa fa-spinner fa-spin"></i></button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'themes/admin/js/userModal.js' ?>"></script>