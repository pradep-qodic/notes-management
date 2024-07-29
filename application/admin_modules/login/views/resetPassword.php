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
					<h4>Reset Your Password</h4>                            
					<?php if(isset($error) && $error): ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Oops...</strong> <?php echo $error; ?>
					</div>
					<?php endif; ?>
					<?php if(isset($message) && $message): ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Success !!!</strong> <?php echo $message; ?>
					</div>
					<script>						
						setTimeout(function(){							
							document.getElementById('password').value='';
							document.getElementById('confirm_password').value='';
						},100);
						setTimeout(function(){							
							var url=$('#base_url').val();
							window.location.href = url+'login';
						},5000);
				</script>
				<?php endif; ?>
			<form >
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
						  <i class="icon-lock"></i>
						</span>
					</div>
					<input class="form-control" id="password" name="npassword" type="password" placeholder="Password" value="<?php echo set_value('npassword');?>">
				</div>
				<div class="input-group mb-4">
					<div class="input-group-prepend">
						<span class="input-group-text">
						  <i class="icon-lock"></i>
						</span>
					</div>
					<input class="form-control" id="confirm_password" name="cpassword" type="password" placeholder="Confirm Password" value="<?php echo set_value('cpassword');?>">
				</div>							
				<div class="row">
					<div class="col-6">
						<button class="btn btn-primary px-4" type="submit"><i class="fa fa-spinner fa-spin" id="signin_loader" style="display:none;float:right;padding: 5px;"></i>Submit</button>
					</div>
					<div class="col-6 text-right">
						<a class="btn btn-link px-0" href="<?php echo base_url('login');?>" class="footer-link">Login</a>									
					</div>
				</div>
			</form>
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