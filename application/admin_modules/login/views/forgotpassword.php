<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="<?php echo base_url();?>themes/admin/images/logo.svg" alt="logo">
              </div>
                    <h4>Forgotten Password ?</h4>                            
                    <form id="frmPopupforgot">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">
								  <i class="fa fa-user"></i>
								</span>
							</div>
							<input class="form-control" id="m_email" type="email" name="recoverEmail" placeholder="Your Email ID" autocomplete="off">
						</div>								
					</form>
                    <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" id="btnPopupForgot"  type="button">Request
									<i class="fa fa-spinner fa-spin" id="forgot_loader" style="display:none;float:right;padding: 5px;"></i>
									</button>
                                </div>
                                <div class="col-6 text-right">
                                    <a class="btn btn-link px-0" href="<?php echo base_url('login');?>" class="footer-link">Login</a>									
                                </div>
                            </div>
                        </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script src="<?php echo base_url() ?>themes/admin/js/signin.js"></script>