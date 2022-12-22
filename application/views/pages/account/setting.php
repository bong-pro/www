<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
?>

<!-- Info -->
<div class="card" id="info">
	<div class="card-header d-flex align-items-center">
		<h5 class="mb-0"><i class="ph-user me-1"></i><?php echo $page_title; ?></h5>
		<div class="d-inline-flex ms-auto">
			<a class="text-body me-2" data-card-action="reload"><i class="ph-arrows-clockwise"></i></a>
			<a class="text-body" data-card-action="fullscreen"><i class="ph-corners-out"></i></a>
		</div>
	</div>

	<form class="form">
		<div class="card-header">
			<div class="d-flex justify-content-between align-items-center">
				<a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-password">
					<i class="ph-lock me-1"></i><span>Password</span>
				</a>
				<button type="submit" class="btn btn-primary"><i class="ph-check me-1"></i>Save</button>
			</div>
		</div>

		<div class="card-body">
			<div class="mb-4">
				<div class="row mb-3">
					<label class="col-form-label col-lg-2">Login ID<span class="text-danger">*</span></label>	
					<div class="col-lg-10">
						<input type="hidden" id="user_id" name="user_id" value="1" />
						<input type="text" class="form-control" name="login" placeholder="Login ID" disabled />
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-form-label col-lg-2">Name<span class="text-danger">*</span></label>	
					<div class="col-lg-10">
						<input type="text" class="form-control" name="name" placeholder="Name" required />
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-form-label col-lg-2">Email<span class="text-danger">*</span></label>	
					<div class="col-lg-10">
						<input type="text" class="form-control" name="email" placeholder="Email" required />
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-form-label col-lg-2">Mobile<span class="text-danger">*</span></label>	
					<div class="col-lg-10">
						<input type="text" class="form-control" name="mobile" placeholder="Mobile" required />
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-form-label col-lg-2">Group name</label>	
					<div class="col-lg-10">
						<input type="text" class="form-control" name="group_name" placeholder="Mobile" disabled />
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- /info -->

<!-- Modal Password -->
<div id="modal-password" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="ph-pencil me-1"></i>Password</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<form class="form-horizontal form-validate-jquery-password">
				<div class="modal-body">
					<div class="row mb-3">
						<label class="col-form-label col-sm-4">Old password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password_old" placeholder="•••••••••••" required />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-4">New password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password" placeholder="•••••••••••" required />
							<div class="form-text">The password must be at least 4 characters long</div>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-4">Confirm password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password_cp" placeholder="•••••••••••" required />
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-bs-dismiss="modal"><i class="ph-x me-1"></i>Close</button>
					<button type="submit" class="btn btn-primary"><i class="ph-check me-1"></i>Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /modal Password -->

<script type="text/javascript">
var data = function() {

	var _componentInfo = function() {
		const cardEl = $('#info');
		let target_id = <?php echo $this->user->item('user_id'); ?>;

		axios.get(cp_params.base_url + '/account/setting/item_get/' + target_id, {
		}).then(response => {
			$.each(response.data, function(i, v) {
				var the_el = $('[name="' + i + '"]');
				if (the_el.length > 0) {
					the_el.val(v);
					if (the_el.is("select")) {
						the_el.change();
					}
				}
			})
		});

		$('form', cardEl).on('submit', function(e) {
			let form_data = $(this).serialize();

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/account/setting/item_put/' + target_id,
				data: form_data,
				dataType: 'json',
				error: function(xhr, status, error) {
					if (xhr.responseText) alert(xhr.responseText);
				},
				success: function(data) {
					if (data.message) alert(data.message);
					location.reload();
				}
			});
			return false;
		});
	}; 

	var _componentPassword = function() {
		const modalEl = $('#modal-password');

		modalEl.on('show.bs.modal', function(e) {
			$(this).find('form')[0].reset();
		});

		$('form', modalEl).on('submit', function(e) {
			let form_data = $(this).serialize();
			let target_id = <?php echo $this->user->item('user_id'); ?>;

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/account/setting/password_put/' + target_id,
				data: form_data,
				dataType: 'json',
				error: function(xhr, status, error) {
					if (xhr.responseText) alert(xhr.responseText);
				},
				success: function(data) {
					if (data.message) alert(data.message);
					$('#modal-password').modal('hide');
				}
			});
			return false;
		});
	};

	return {
		init: function() {
			_componentInfo();
			_componentPassword();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>

