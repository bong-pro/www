<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->document->add_js('select2', base_url('template/assets/js/vendor/forms/selects/select2.min.js'));

$this->document->add_js('glightbox', base_url('template/assets/js/vendor/media/glightbox.min.js'));
?>

<!-- Search field -->
<div class="card">
	<div class="card-header d-flex align-items-center">
		<h5 class="mb-0"><i class="ph-image me-1"></i><?php echo $page_title; ?></h5>
	</div>
	<form action="#" class="card-body d-sm-flex" id="img_form" onsubmit="return false">
		<div class="mb-3 wmin-sm-300">
			<select class="form-select mb-3 mb-sm-0 select" name="group_id" id="group_id" data-allow-clear="true" data-placeholder="No selected&hellip;">
				<option></option>
				<option value="all">All</option>
				<?php foreach ($groups['list'] as $item) : ?>
					<?php $disabled = $item['group_id'] == '1' && $this->user->item('group_id') !== '1' ? 'disabled' : ''; ?>
					<option value="<?php echo $item['group_id']; ?>" <?php echo $disabled; ?>><?php echo $item['name']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-control-feedback form-control-feedback-start flex-grow-1 ms-sm-3 mb-sm-0">
			<input type="search" class="form-control search-filter-item" name="keyword" id="keyword" value="" placeholder="Search">
			<div class="form-control-feedback-icon">
				<i class="ph-magnifying-glass"></i>
			</div>
		</div>
	</form>
</div>
<!-- /search field -->

<!-- Image grid -->
<div class="row" id="image-grid"></div>
<!-- /image grid -->

<script type="text/javascript">
var data = function() {

	var _componentImageList = function() {
		function imgGrid(v) {
			var form_data = {
				keyword: '',
				group_id: '',
				type: 'A',
				is_used: 'Y'
			}
			form_data.keyword = v ? v.keyword : '';
			form_data.group_id = v ? v.group_id : '';

			$.ajax({
				url: cp_params.base_url + '/main/nail/products/list',
				type: 'GET',
				data: form_data,
				success: function(data) {
					var html = '';

					$.each(data.list, function(i, v) {
						var img_url = cp_params.base_url + v.link + v.name;

						html += '<div class="col-xl-3 col-sm-6" title="' + v.name + '" data-bs-popup="tooltip">\n' +
							'	<div class="card">\n' +
							'		<div class="card-img-actions m-1">\n' +
							'			<img class="card-img img-fluid" src="' + img_url + '" alt="">\n' +
							'			<div class="card-img-actions-overlay card-img">\n' +
							'				<a href="' + img_url + '" class="btn btn-outline-white btn-icon roded-pill" data-bs-popup="lightbox" data-gallery="gallery1">\n' +
							'					<i class="ph-plus"></i>\n' +
							'				</a>\n' +
							'			</div>\n' +
							'		</div>\n' +
							'	</div>\n' +
							'</div>\n';
					});

					$('#image-grid').append(html);

					// Image lightbox
					const lightbox = GLightbox({
						 selector: '[data-bs-popup="lightbox"]',
						 loop: true,
						 svg: {
							next: document.dir == "rtl" ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>' : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"> <g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>',
							prev: document.dir == "rtl" ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>' : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>'
						}
					});
				}
			});
		};

		function imgSearch() {
			$('#image-grid').empty();

			var select = $('#group_id option:selected').val();

			select = select == 'all' ? '' : select;

			var v = {
				keyword: $('#keyword').val(),
				group_id: select
			}

			imgGrid(v);

			$('#keyword').val(v.keyword);
		}

		$(':input.search-filter-item').on('input', function() {
			imgSearch();
		});

		$('#group_id').on('change', function() {
			imgSearch();
		});

		return imgGrid();
	};

	return {
		init: function() {
			_componentImageList();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
