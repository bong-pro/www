<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->document->add_js('moment', base_url('template/assets/js/vendor/ui/moment/moment.min.js'));
$this->document->add_js('datatables', base_url('template/assets/js/vendor/tables/datatables/datatables.min.js'));
$this->document->add_js('select', base_url('template/assets/js/vendor/tables/datatables/extensions/select.min.js'));
$this->document->add_js('select2', base_url('template/assets/js/vendor/forms/selects/select2.min.js'));
$this->document->add_js('buttons', base_url('template/assets/js/vendor/tables/datatables/extensions/buttons.min.js'));

$this->document->add_js('validate', base_url('template/assets/js/vendor/forms/validation/validate.min.js'));
?>

<!-- Table list -->
<div class="card data-table">
	<div class="card-header d-flex align-items-center">
		<h5 class="mb-0"><i class="ph-user me-1"></i><?php echo $page_title; ?></h5>
		<div class="d-inline-flex ms-auto">
			<a class="text-body me-2" data-card-action="reload"><i class="ph-arrows-clockwise"></i></a>
			<a class="text-body" data-card-action="fullscreen"><i class="ph-corners-out"></i></a>
		</div>
	</div>

	<table class="table table-xs table-striped table-hover datatable-button-init-collection datatables" id="table"></table>
</div>
<!-- /table list -->

<!-- Modal create -->
<div id="modal-create" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="ph-user-plus me-1"></i>Create</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<form class="form-horizontal form-validate-jquery">
				<div class="modal-body">
					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User login ID<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="login" id="login" placeholder="Login ID" required />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">Password<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="password" placeholder="•••••••••••" required />
							<div class="form-text">The password must be at least 4 characters long</div>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User name<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="name" placeholder="User name" required />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User email<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="email" placeholder="User email" required />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User mobile<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="mobile" placeholder="Mobile number" required />
							<div class="form-text">Please enter only numbers</div>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User group</label>
						<div class="col-sm-9">
							<select class="form-control select" name="group_id" data-allow-clear="true" data-placeholder="No selected&hellip;">
								<option></option>
								<?php foreach ($groups['list'] as $item) : ?>
									<?php $disabled = $item['group_id'] == '1' && $this->user->item('group_id') !== '1' ? 'disabled' : ''; ?>
									<option value="<?php echo $item['group_id']; ?>" <?php echo $disabled; ?>><?php echo $item['name']; ?></option>
								<?php endforeach; ?>
							</select>
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
<!-- /modal create -->

<!-- Modal status -->
<div id="modal-status" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="ph-pencil me-1"></i>Status</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<form class="form-horizontal">
				<div class="modal-body">
					<div class="row mb-3">
						<div class="col-sm-12">
							<input type="hidden" name="user_id" />
							<select name="is_used" class="form-control select">
								<option value="Y">Enabled</option>
								<option value="N">Disabled</option>
							</select>
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
<!-- /modal status -->

<!-- Modal item -->
<div id="modal-item" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="ph-user me-1"></i>Edit user info</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<form class="form-horizontal form-validate-jquery-item">
				<div class="modal-body">
					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User status</label>
						<div class="col-sm-9">
							<input type="hidden" name="user_id" />
							<select name="is_used" class="form-control select">
								<option value="Y">Enabled</option>
								<option value="N">Disabled</option>
							</select>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User login ID<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="login" placeholder="Login ID" disabled />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User name<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="name" placeholder="User name" required />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User email<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="email" placeholder="User email" required />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User mobile<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="mobile" placeholder="Mobile number" required />
							<div class="form-text">Please enter only numbers</div>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">User group</label>
						<div class="col-sm-9">
							<select class="form-control select" name="group_id" data-allow-clear="true" data-placeholder="No selected&hellip;">
								<option></option>
								<?php foreach ($groups['list'] as $item) : ?>
									<?php $disabled = $item['group_id'] == '1' && $this->user->item('group_id') !== '1' ? 'disabled' : ''; ?>
									<option value="<?php echo $item['group_id']; ?>" <?php echo $disabled; ?>><?php echo $item['name']; ?></option>
								<?php endforeach; ?>
							</select>
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
<!-- /modal modified item -->

<!-- Modal Password -->
<div id="modal-password" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="ph-pencil me-1"></i>Password</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<form class="form-horizontal form-validate-jquery-password">
				<div class="modal-body">
					<div class="row mb-3">
						<div class="col-sm-12">
							<input type="hidden" name="user_id" />
							<input type="password" class="form-control" name="password" placeholder="•••••••••••" required />
							<div class="form-text">The password must be at least 4 characters long</div>
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

	var _componentDatatable = function() {
		if (!$().DataTable) {
			console.warn('Warning - datatables.min.js is not loaded.');
			return;
		}

		const tableEl = $('table.datatables');

		var datatable = tableEl.DataTable( {
			ajax: {
				url: cp_params.base_url + '/preferences/member/users/list',
				type: 'GET',
				data: function(d) {
					// ajax 요청항목 재정의
					var data = {
						limit: d.length,
						offset: d.start,
						keyword: d.search.value,
						orderby: d.columns[d.order[0].column].data,
						order: d.order[0].dir
					};

					// 필터 항목 추가
					$(':input.search-filter-item').each(function() {
						let key = $(this).attr('name').replace(/^filter__/, '');
						let value = $(this).val();

						if (value == '' || ($(this).is(':checkbox, :radio') && ! $(this).is(':checked'))) {
							return;
						}

						if ($(this).data('ionRangeSlider')) {
							let ionRangeSlider = $(this).data('ionRangeSlider');

							if ('single' == ionRangeSlider.options.type) {
								if (ionRangeSlider.result.from < ionRangeSlider.result.max) {
									data[key] = ionRangeSlider.result.from;
								}
							} else {
								data[key] = {};
								if (ionRangeSlider.result.from > ionRangeSlider.result.min) {
									data[key]['min'] = ionRangeSlider.result.from;
								}
								if (ionRangeSlider.result.to < ionRangeSlider.result.max) {
									data[key]['max'] = ionRangeSlider.result.to;
								}
							}
						} else if ($.isArray(value)) {
							data[key] = value.join();
						} else {
							data[key] = value;
						}
					});
					return data;
				},
				dataSrc: function(response){
					response.recordsTotal = response.total_rows;
					response.recordsFiltered = response.total_rows;
					response.draw++;

					return response.list;
				},
			},
			drawCallback: function (settings, json) {
				$('[data-tooltip="tooltip"]').tooltip({
					trigger: 'hover'
				});
			},
			buttons: [
				{
					titleAttr: 'Create',
					text: '<i class="ph-plus"></i>',
					className: 'btn btn-primary btn-create'
				},
				{
					titleAttr: 'Delete Selected',
					text: '<i class="ph-trash"></i>',
					className: 'btn btn-danger btn-delete-selected'
				},
				{
					extend: 'collection',
					text: '<i class="ph-list"></i>',
					className: 'btn btn-light dropdown-toggle dropdown-icon-none',
					buttons: [
						{
							extend: 'copy',
							className: 'dt-button dropdown-item',
							text: '<i class="ph-copy-simple me-2"></i>Copy'
						},
						{
							extend: 'print',
							className: 'dt-button dropdown-item',
							text: '<i class="ph-printer me-2"></i>Print'
						},
						{
							extend: 'excel',
							className: 'dt-button dropdown-item',
							text: '<i class="ph-download-simple me-2"></i>Download',
							customize: function (xlsx) {
								var sheet = xlsx.xl.worksheets["sheet1.xml"];
								$("c[r^=J] t", sheet).text("");
							}
						},
					]
				},
			],
			columnDefs: [
				{
					targets: 0,
					orderable: false,
					className: 'select-checkbox',
					data: null,
					defaultContent: ''
				}
			],
			select: {
				style: 'multi',
				selector: 'td:first-child'
			},
			initComplete: function(settings, json) {
				$('thead .select-checkbox').click(function() {
					if ($('thead tr').hasClass('selected')) {
						datatable.rows().deselect();
						$('thead tr').removeClass('selected');
					} else {
						datatable.rows().select();
						$('thead tr').addClass('selected');
					}
				});
			},
			order: [[1, 'desc']],
			createdRow: function(row, data, dataIndex) {
				$(row).data('target-id', data.user_id);
			},
			columns: [
				{data: null},
				{
					title: '<center>#</center>',
					data: 'user_id',
					class: 'text-nowrap text-end'
				},
				{
					title: '<center>Login ID</center>',
					data: 'login',
					class: 'text-nowrap text-start'
				},
				{
					title: '<center>Name</center>',
					data: 'name',
					class: 'text-nowrap text-start'
				},
				{
					title: '<center>E-Mail</center>',
					data: 'email',
					class: 'text-nowrap text-start'
				},
				{
					title: '<center>Mobile</center>',
					data: 'mobile',
					class: 'text-nowrap text-start',
					render: function(data, type, row, meta) {
						return '<i class="ph-phone me-1"></i>' +
							data.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3");
					}
				},
				{
					title: '<center>Group</center>',
					data: 'group_name',
					class: 'text-nowrap text-center',
					render: function(data, type, row, meta) {
						return data ? data : '<span class="text-muted">&mdash;</span>';
					}
				},
				{
					title: '<center>Status</center>',
					data: 'is_used',
					class: 'text-nowrap text-center',
					render: function(data, type, row, meta) {
						let class_y = "badge badge-flat border-primary text-primary";
						let class_n = "badge badge-flat text-muted";

						var html = '<a href="#" class="';
						if (data == 'Y') {
							html += class_y + '" data-bs-toggle="modal" data-bs-target="#modal-status">Enabled</a>';
						} else if (data == 'N') {
							html += class_n + '" data-bs-toggle="modal" data-bs-target="#modal-status">Disabled</a>';
						} else {
							html += 'text-danger">Error</a>';
						}

						return html;
					}
				},
				{
					title: '<center>Created at</center>',
					data: 'created_at',
					class: 'text-nowrap text-center',
					render: function(data, type, row, meta) {
						let momentDt = moment(data);

						return momentDt.isSame(moment(), 'day')
							? moment.duration(momentDt.diff()).humanize() + ' ago'
							: momentDt.format('YYYY-MM-DD');
					}
				},
				{
					title: '<center><i class="ph-list"></i></center>',
					data: 'user_id',
					class: 'text-nowrap text-center',
					sortable: false,
					render: function(data, type, row, meta) {
						var password = '';
						if ('<?php echo $this->user->item('user_id'); ?>' == '1') {
							password = '<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-password"><i class="ph-lock me-2"></i>Password</a>';
						}

						return '<div class="d-inline-flex">\n' +
							'	<div class="dropdown position-static">\n' +
							'		<a href="#" class="text-body" data-bs-toggle="dropdown"><i class="ph-gear"></i></a>\n' +
							'		<div class="dropdown-menu dropdown-menu-end">\n' +
							'			<div class="dropdown-header">Option</div>\n' +
							'			<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-item"><i class="ph-pencil me-2"></i>Edit</a>\n' + password +
							'			<div class="dropdown-divider"></div>\n' +
							'			<a href="#" class="dropdown-item btn-delete-item"><i class="ph-trash me-2"></i>Move to trach</a>\n' +
							'		</div>\n' +
							'	</div>\n' +
							'</div>';
					}
				}
			],
		});

		$(':input.search-filter-item').on('change', function() {
			datatable.ajax.reload();
		});

		$('.btn-create')
			.attr('data-tooltip', 'tooltip')
			.attr('data-bs-toggle', 'modal')
			.attr('data-bs-target', '#modal-create');
		
		$('.btn-delete-selected')
			.attr('data-tooltip', 'tooltip');
	};

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
						}
					}
				},
				password: {
					required: true,
					minlength: 4,
					maxlength: 20
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

		var validatorItem = $('.form-validate-jquery-item').validate({
			rules: {
				password: {
					required: true,
					minlength: 4,
					maxlength: 20
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
			}
		});

		var validatorItem = $('.form-validate-jquery-password').validate({
			rules: {
				password: {
					required: true,
					minlength: 4,
					maxlength: 20
				},
			}
		});
	};

	var _componentCreate = function() {
		const modalEl = $('#modal-create');

		modalEl.on('show.bs.modal', function(e) {
			$(this).find('form')[0].reset();
			$('select[name="is_used"]').val('Y').trigger('change');
			$('select[name="group_id"]').val('').trigger('change');
		});

		modalEl.on('hidden.bs.modal', function(e) {
			$(this).find('form')[0].reset();
			$('select[name="is_used"]').val('Y').trigger('change');
			$('select[name="group_id"]').val('').trigger('change');
		});

		$('form', modalEl).on('submit', function(e) {
			var form_data = $(this).serialize();

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/preferences/member/users/item_insert/',
				data: form_data,
				dataType: 'json',
				error: function(xhr, status, error) {
					if (xhr.responseText) alert(xhr.responseText);
				},
				success: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-create').modal('hide');
					if (data.message) alert(data.message);
				}
			});
			return false;
		});
	};

	var _componentStatus = function() {
		const modalEl = $('#modal-status');

		modalEl.on('show.bs.modal', function(e) {
			let target_id = $(e.relatedTarget).closest('tr').data('target-id');

			axios.get(cp_params.base_url + '/preferences/member/users/item_get/' + target_id, {
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
		});

		modalEl.on('hidden.bs.modal', function(e) {
			$(this).find('form')[0].reset();
			$('select[name="is_used"]').val('Y').trigger('change');
		});

		$('form', modalEl).on('submit', function(e) {
			let target_id = $('[name="user_id"]').val();
			let form_data = $(this).serialize();

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/preferences/member/users/status_put/' + target_id,
				data: form_data,
				dataType: 'json',
				error: function(xhr, status, error) {
					if (xhr.responseText) alert(xhr.responseText);
				},
				success: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-status').modal('hide');
					if (data.message) alert(data.message);
				}
			});
			return false;
		});
	};

	var _componentItem = function() {
		const modalEl = $('#modal-item');

		modalEl.on('show.bs.modal', function(e) {
			$(this).find('form')[0].reset();
			$('select[name="is_used"]').val('Y').trigger('change');
			$('select[name="group_id"]').val('').trigger('change');

			let target_id = $(e.relatedTarget).closest('tr').data('target-id');

			axios.get(cp_params.base_url + '/preferences/member/users/item_get/' + target_id, {
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
		});

		modalEl.on('hidden.bs.modal', function(e) {
			$(this).find('form')[0].reset();
			$('select[name="is_used"]').val('Y').trigger('change');
			$('select[name="group_id"]').val('').trigger('change');
		});

		$('form', modalEl).on('submit', function(e) {
			let target_id = $('[name="user_id"]').val();
			let form_data = $(this).serialize();

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/preferences/member/users/item_put/' + target_id,
				data: form_data,
				dataType: 'json',
				error: function(xhr, status, error) {
					if (xhr.responseText) alert(xhr.responseText);
				},
				success: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-item').modal('hide');
					if (data.message) alert(data.message);
				}
			});
			return false;
		});
	};
	
	var _componentPassword = function() {
		const modalEl = $('#modal-password');

		modalEl.on('show.bs.modal', function(e) {
			$(this).find('form')[0].reset();

			let target_id = $(e.relatedTarget).closest('tr').data('target-id');

			axios.get(cp_params.base_url + '/preferences/member/users/item_get/' + target_id, {
			}).then(response => {
				$.each(response.data, function(i, v) {
					if (i == 'user_id'){
						var the_el = $('[name="' + i + '"]');
						if (the_el.length > 0) {
							the_el.val(v);
						}
					}
				})
			});
		});

		modalEl.on('hidden.bs.modal', function(e) {
			$(this).find('form')[0].reset();
		});

		$('form', modalEl).on('submit', function(e) {
			let target_id = $('[name="user_id"]').val();
			let form_data = $(this).serialize();

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/preferences/member/users/password_put/' + target_id,
				data: form_data,
				dataType: 'json',
				error: function(xhr, status, error) {
					if (xhr.responseText) alert(xhr.responseText);
				},
				success: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-password').modal('hide');
					if (data.message) alert(data.message);
				}
			});
			return false;
		});
	};

	var _componentDeleteItem = function() {
		const modalEl = $('table.datatables');

		modalEl.on('click', '.btn-delete-item', function(e) {
			let target_id = $(this).closest('tr').data('target-id');

			if (target_id == '1') {
				alert('This ID cannot be deleted');
				return false;
			}

			if (confirm('Are you sure you want to delete it?') == true) {
				$.ajax({
					url: cp_params.base_url + '/preferences/member/users/item_delete/' + target_id,
					dataType: 'json',
					error: function(xhr, status, error) {
						if (xhr.responseText) alert(xhr.responseText);
					},
					success: function(data) {
						$('#table').DataTable().ajax.reload(null, false);
						alert('Delete successful');
					}
				});
				return false;
			} else {
				return false;
			}
		});
	};

	var _componentDeleteSelected = function() {
		const modalEl = $('.data-table');

		modalEl.on('click', '.btn-delete-selected', function(e) {
			var msg = 'Are you sure you want to delete it?';
			var target_ids = '';
			var i = 0;

			$('tr.selected').each(function() {
				if ($(this).data('targetId')) {
					if ($(this).data('targetId') == '1') {
						msg += '\n(The master ID cannot be deleted)';
						return false;
					}

					target_ids += '&' + i + '=' + $(this).data('targetId');
					i++;
				}
			});

			if (target_ids.length > 0) {
				if (confirm(msg) == true) {
					$.ajax({
						type: 'POST',
						url: cp_params.base_url + '/preferences/member/users/selected_delete/',
						data: target_ids,
						dataType: 'json',
						error: function(xhr, status, error) {
							if (xhr.responseText) alert(xhr.responseText);
						},
						success: function(data) {
							$('#table').DataTable().ajax.reload(null, false);
							alert('Delete successful');
						}
					});
					return false;
				} else {
					return false;
				}
			} else {
				alert('No selected');
			}
		});
	};

	return {
		init: function() {
			_componentDatatable();
			_componentValidation();
			_componentCreate();
			_componentStatus();
			_componentItem();
			_componentPassword();
			_componentDeleteItem();
			_componentDeleteSelected();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
