<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->document->add_js('validate', base_url('template/assets/js/vendor/forms/validation/validate.min.js'));
#$this->document->add_js('messages_ko', base_url('template/global_assets/js/plugins/forms/validation/localization/messages_ko.js'));

$this->document->add_inline_style ("
.login-cover {
	background: url(" . base_url('assets/images/login_cover.jpg') . ");
	background-size: cover;
	background-repeat: no-repeat;
}
");
?>

<!-- login form -->
<form class="login-form form-validate-jquery" method="post" novalidate="novalidate">
	<input type="hidden" name="redirect_to" value="<?php echo html_escape($redirect_to); ?>" />
	<div class="card mb-0">
		<div class="card-body">
			<div class="text-center mb-3">
				<h1 class="font-weight-bold">DEMO corp.</h1>
				<h5 class="mb-0">Login to your account</h5>
				<span class="d-block text-muted">Enter your credentials below</span>
				<small class="d-block">( ID : test | PW : 1111 )</small>
			</div>

			<div class="mb-3">
				<label class="form-label">Your login ID</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="text" class="form-control" name="login" id="login" value="<?php echo set_value( 'login', '' ); ?>" placeholder="Login ID" />
					<div class="form-control-feedback-icon">
						<i class="ph-user-circle text-muted"></i>
					</div>
				</div>
			</div>

			<div class="mb-3">
				<label class="form-label">Password</label>
				<div class="form-control-feedback form-control-feedback-start">
					<input type="password" class="form-control" name="password" id="password" value="<?php echo set_value( 'password', '' ); ?>" placeholder="•••••••••••" />
					<div class="form-control-feedback-icon">
						<i class="ph-lock text-muted"></i>
					</div>
				</div>
			</div>

			<div class="mb-3">
				<button type="submit" class="btn btn-primary w-100">Sign in</button>
			</div>

			<div class="text-center text-muted content-divider mb-3">
				<span class="px-2">Don't have an account?</span>
			</div>

			<div class="mb-3">
				<a href="<?php echo base_url('auth/register'); ?>" class="btn btn-light w-100">Sign up</a>
			</div>
            
			<span class="form-text text-center text-muted">&copy; 2022. Copyright: <a href="#">DEMO CO,.LTD.</a></span>
		</div>
	</div>
</form>
<!-- /login form -->

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
					minlength: 3
				},
				password: {
					required: true,
					minlength: 4,
				}
			}
		});
	};

	var _componentAlertClose = function() {
		$(document).ready(function () {
			window.setTimeout(function() {
				$(".alert").fadeTo(3000, 0).slideUp(3000, function(){
					$(this).remove();
				});
			}, 1000);
		});
	};

	return {
		init: function() {
			_componentValidation();
			_componentAlertClose();
		}
	};
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
