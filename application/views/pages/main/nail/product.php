<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->document->add_js('glightbox', base_url('template/assets/js/vendor/media/glightbox.min.js'));
?>

<!-- Image grid -->
<div class="mb-3">
	<h5 class="mb-0"><i class="ph-image me-1"></i><?php echo $page_title; ?></h5>
</div>

<div class="row">
	<div class="col-sm-6 col-lg-3">
		<div class="card">
			<div class="card-img-actions m-1">
				<img class="card-img img-fluid" src="<?php echo base_url('template/assets/images/demo/flat/1.png'); ?>" alt="">
				<div class="card-img-actions-overlay card-img">
					<a href="<?php echo base_url('template/assets/images/demo/flat/1.png'); ?>" class="btn btn-outline-white btn-icon roded-pill" data-bs-popup="lightbox" data-gallery="gallery1">
						<i class="ph-plus"></i>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-3">
		<div class="card">
			<div class="card-img-actions m-1">
				<img class="card-img img-fluid" src="<?php echo base_url('template/assets/images/demo/flat/2.png'); ?>" alt="">
				<div class="card-img-actions-overlay card-img">
					<a href="<?php echo base_url('template/assets/images/demo/flat/2.png'); ?>" class="btn btn-outline-white btn-icon roded-pill" data-bs-popup="lightbox" data-gallery="gallery1">
						<i class="ph-plus"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /image grid -->

<script type="text/javascript">
var data = function() {
	return {
		init: function() {
		}
	}
}();

</div>
<!-- /image grid -->

<script type="text/javascript">
var data = function() {
	return {
		init: function() {
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
