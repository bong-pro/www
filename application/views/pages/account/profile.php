<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
?>

<!-- Info -->
<div class="card">
	<div class="card-header d-flex align-items-center">
		<h5 class="mb-0"><i class="ph-user me-1"></i><?php echo $page_title; ?></h5>
		<div class="d-inline-flex ms-auto">
			<a class="text-body me-2" data-card-action="reload"><i class="ph-arrows-clockwise"></i></a>
			<a class="text-body" data-card-action="fullscreen"><i class="ph-corners-out"></i></a>
		</div>
	</div>

	<div class="card-body">
		<div class="mb-4">
			<div class="row mb-3">
				<label class="col-form-label col-lg-2">Login ID</label>	
				<div class="col-lg-10">
					<input type="text" class="form-control-plaintext border-bottom p-1" name="login" placeholder="Login ID" disabled />
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-2">Name</label>	
				<div class="col-lg-10">
					<input type="text" class="form-control-plaintext border-bottom p-1" name="name" placeholder="Name" disabled />
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-2">Email</label>	
				<div class="col-lg-10">
					<input type="text" class="form-control-plaintext border-bottom p-1" name="email" placeholder="Email" disabled />
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-2">Mobile</label>	
				<div class="col-lg-10">
					<input type="text" class="form-control-plaintext border-bottom p-1" name="mobile" placeholder="Mobile" disabled />
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-2">Group name</label>	
				<div class="col-lg-10">
					<input type="text" class="form-control-plaintext border-bottom p-1" name="group_name" placeholder="Mobile" disabled />
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /info -->

<script type="text/javascript">
var data = function() {

	var _componentInfo = function() {
		const cardEl = $('.form');
		let target_id = <?php echo $this->user->item('user_id'); ?>;

		axios.get(cp_params.base_url + '/account/profile/item_get/' + target_id, {
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
	}; 

	return {
		init: function() {
			_componentInfo();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>

