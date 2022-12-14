<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->document->add_js('validate', base_url('template/assets/js/vendor/forms/validation/validate.min.js'));
//$this->document->add_js('messages-ko', base_url('template/assets/js/plugins/forms/validation/localization/messages_ko.js'));

$this->document->add_inline_style("
.login-cover {
	background: url(" . base_url( 'assets/images/login_cover.jpg' ) . ");
	background-size: cover;
	background-repeat: no-repeat;
}
");

// error message
if($this->session->flashdata('message')) echo $this->session->flashdata('message');
?>

<!-- register form -->
<form class="login-form form-validate-jquery" id="register-form" method="post" novalidate="novalidate">
	<div class="card mb-0">
		<div class="card-body">
			<div class="text-center mb-3">
				<!--img src="<?php echo base_url( 'template/global_assets/images/logo/logo.svg' ); ?>" width="200" class="mb-1" /-->
				<h1 class="font-weight-bold">DEMO corp.</h1>
				<h5 class="mb-0">Create account</h5>
				<span class="d-block text-muted">All fields are required</span>
			</div>

			<div class="text-center text-muted content-divider mb-3">
				<span class="px-2">Your credentials</span>
			</div>

			<div class="mb-3">
				<label class="form-dabel">Your login ID</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="text" class="form-control" name="login" id="login" placeholder="Login ID" />
					<div class="form-control-feedback-icon">
						<i class="ph-user-circle text-muted"></i>
					</div>
				</div>
			</div>

			<div class="mb-3">
				<label class="form-dabel">Password</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="password" class="form-control" name="password" id="password" placeholder="•••••••••••" />
					<div class="form-control-feedback-icon">
						<i class="ph-lock text-muted"></i>
					</div>
				</div>
			</div>

			<div class="mb-3">
				<label class="form-dabel">Confirm password</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="password" class="form-control" name="password_cp" id="password_cp" placeholder="•••••••••••" />
					<div class="form-control-feedback-icon">
						<i class="ph-lock text-muted"></i>
					</div>
				</div>
			</div>

			<div class="text-center text-muted content-divider mb-3">
				<span class="px-2">Your contacts</span>
			</div>

			<div class="mb-3">
				<label class="form-dabel">Confirm password</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="text" class="form-control" name="name" id="name" placeholder="Your name" />
					<div class="form-control-feedback-icon">
						<i class="ph-user-circle text-muted"></i>
					</div>
				</div>
			</div>

			<div class="mb-3">
				<label class="form-dabel">Your email</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="text" class="form-control" name="email" id="email" placeholder="Your email" />
					<div class="form-control-feedback-icon">
						<i class="ph-at text-muted"></i>
					</div>
				</div>
			</div>

			<div class="mb-3">
				<label class="form-dabel">Your mobile</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile number" />
					<div class="form-control-feedback-icon">
						<i class="ph-phone text-muted"></i>
					</div>
				</div>
			</div>

			<button type="submit" name="submit_btn" class="btn btn-teal w-100">Register</button>

			<div class="text-center text-muted content-divider mb-3">
				<span class="px-2">Are you a member?</span>
			</div>

			<div class="mb-3">
				<a href="<?php echo base_url(); ?>" class="btn btn-light w-100">Login</a>
			</div>
			
			<span class="form-text text-center text-muted">&copy; 2022. Copyright: <a href="#">DEMO CO,.LTD.</a></span>
		</div>
	</div>
</form>
<!-- /register form -->

<script type="text/javascript">
var data = function() {
	var _componentValidation = function() {
		if (!$().validate) {
			console.warn('Warning - validate.min.js is not loaded.');
			return;
		}

		var validator = $('.form-validate-jquery').validate({
			rules: {
				login: {
					required: true,
					minlength: 3,
					maxlength: 30,
					remote: {
						url: cp_params.base_url + '/auth/data_check/',
						type: 'post',
						data: {
							login: function() {
								return $('input[name="login"]').val();
							}
						},
					}
				},
				password: {
					required: true,
					minlength: 4,
					maxlength: 20
				},
				password_cp: {
					required: true,
					minlength: 4,
					maxlength: 20,
					equalTo: "input[name='password']"
				},
				name: {
					required: true,
					minlength: 3,
					maxlength: 50
				},
				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 50
				},
				mobile: {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 30
				}
			},
			messages: {
				login: {
					remote: 'There are duplicate values.'
				}
			}
		});
	};

	return {
		init: function() {
			_componentValidation();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
