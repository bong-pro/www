<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->document->add_js('moment', base_url('template/global_assets/js/plugins/ui/moment/moment.min.js'));
$this->document->add_js('select2', base_url('template/global_assets/js/plugins/forms/selects/select2.min.js'));
$this->document->add_js('datatables', base_url('template/global_assets/js/plugins/tables/datatables/datatables.min.js'));
$this->document->add_js('select', base_url('template/global_assets/js/plugins/tables/datatables/extensions/select.min.js'));
$this->document->add_js('buttons', base_url('template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js'));

$this->document->add_js('validate', base_url('template/global_assets/js/plugins/forms/validation/validate.min.js'));

$this->document->add_inline_style("
	.sorting:before {content: '' !important;}
	.sorting:after {content: '' !important;}
	.sorting {padding-right: 20px !important;}
");
?>

<!-- table list -->
<div class="card data-table">
	<div class="card-header bg-white header-elements-inline">
		<h6 class="card-title"><i class="icon-list2 mr-2"></i><?php echo $page_title; ?></h6>
		<div class="header-elements">
			<div class="list-icons">
				<ul class="list-inline list-inline-dotted mb-0">
					<li class="list-inline-item">
						<!--a class="list-icons-item sidebar-control sidebar-right-toggle" data-action="search"></a-->
						<!--a class="list-icons-item" data-action="reload"></a-->
						<a class="list-icons-item" data-action="fullscreen"></a>
						<!--a class="list-icons-item" data-action="remove"></a-->
					</li>
				</ul>
			</div>
		</div>
	</div>

	<table class="table table-bordered table-striped table-xs table-hover w-100 datatables" id="table"></table>
</div>
<!-- /table list -->

<!-- modal add new -->
<div id="modal-add-new" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<form class="modal-content form-validate-jquery">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-user-plus mr-1"></i>Add New</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<legend class="text-uppercase font-size-sm font-weight-bold">Login information</legend>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">ID<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="login" id="login" placeholder="Login ID&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">PW<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="password" class="form-control" name="password" placeholder="Login Password&hellip;" required />
						<small class="text-muted ml-1">The password must be at least 4 characters long</small>
					</div>
				</div>

				<legend class="text-uppercase font-size-sm font-weight-bold">User information</legend>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Name<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="name" placeholder="User name&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">E-Mail<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="email" placeholder="User E-Mail&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Mobile<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="mobile" placeholder="User mobile number&hellip;" required />
						<small class="text-muted ml-1">Please enter only numbers</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Group</label>
					<div class="col-lg-10">
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
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>Close</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>Save</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal add new -->

<!-- modal status -->
<div id="modal-status" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-pencil7 mr-1"></i>Status</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="user_id" />

				<div class="form-group row">
					<div class="col-lg-12">
						<select name="is_used" class="form-control select">
							<option value="Y">Enabled</option>
							<option value="N">Disabled</option>
						</select>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>Close</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>Save</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal status -->

<!-- modal item -->
<div id="modal-item" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<form class="modal-content form-validate-jquery-item">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-user mr-1"></i>Information</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="user_id" />

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Status</label>
					<div class="col-lg-10">
						<select name="is_used" class="form-control select">
							<option value="Y">Enabled</option>
							<option value="N">Disabled</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">ID<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="login" placeholder="Login ID&hellip;" disabled />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Name<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="name" placeholder="User name&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">E-Mail<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="email" placeholder="User E-Mail&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Mobile<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="mobile" placeholder="User mobile number&hellip;" required />
						<small class="text-muted ml-1">Please enter only numbers</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Group</label>
					<div class="col-lg-10">
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
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>Close</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>Save</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal modified item -->

<!-- modal Password -->
<div id="modal-password" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<form class="modal-content form-validate-jquery-password">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-user-lock mr-1"></i>Password</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="user_id" />

				<div class="form-group row">
					<div class="col-lg-10">
						<input type="password" class="form-control" name="password" placeholder="Login Password&hellip;" required />
						<small class="text-muted ml-1">The password must be at least 4 characters long</small>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>Close</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>Save</button>
			</div>
		</form>
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
					} );

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
					className: 'btn btn-primary btn-add-new',
					titleAttr: 'Add New',
					text: '<i class="icon-plus3 font-size-base"></i>'
				},
				{
					className: 'btn btn-danger btn-delete-selected',
					titleAttr: 'Delete Selected',
					text: '<i class="icon-trash font-size-base"></i>'
				},
				{
					extend: 'collection',
					text: '<i class="icon-three-bars"></i>',
					className: 'btn btn-teal btn-icon dropdown-toggle dropdown-icon-none',
					buttons: [
						{
							extend: 'copy',
							className: 'btn btn-light',
							text: '<i class="icon-copy3 font-size-base mr-1"></i>Copy'
						},
						{
							extend: 'print',
							className: 'btn btn-light',
							text: '<i class="icon-printer font-size-base mr-1"></i>Print'
						},
						{
							extend: 'excel',
							className: 'btn btn-light',
							text: '<i class="icon-file-download font-size-base mr-1"></i>Download',
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
				selector: 'td:first-child',
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
			order: [[1,'desc']],
			createdRow: function(row, data, dataIndex) {
				$(row).data('target-id', data.user_id);
			},
			columns: [
				{
					data: null,
				},
				{
					title: '<center>#</center>',
					data: 'user_id',
					class: 'text-nowrap text-right'
				},
				{
					title: '<center>Login ID</center>',
					data: 'login',
					class: 'text-nowrap text-left'
				},
				{
					title: '<center>Name</center>',
					data: 'name',
					class: 'text-nowrap text-left'
				},
				{
					title: '<center>E-Mail</center>',
					data: 'email',
					class: 'text-nowrap text-left'
				},
				{
					title: '<center>Mobile</center>',
					data: 'mobile',
					class: 'text-nowrap text-left',
					render: function(data, type, row, meta) {
						return '<i class="icon-phone-outgoing font-size-sm mr-1"></i>' +
							data.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3");
					}
				},
				{
					title: '<center>Group</center>',
					data: 'group_name',
					class: 'text-nowrap text-left',
					render: function(data, type, row, meta) {
						return data ? data : '<span class="text-muted">&mdash;</span>';
					}
				},
				{
					title: '<center>Status</center>',
					data: 'is_used',
					class: 'text-nowrap text-center',
					render: function(data, type, row, meta) {
						let classY = "badge badge-flat border-primary text-primary";
						let classN = "badge badge-flat text-muted";

						var html = '<a href="#" class="';
						if (data == 'Y') {
							html += classY + '" data-toggle="modal" data-target="#modal-status">Enabled</a>';
						} else if (data == 'N') {
							html += classN + '" data-toggle="modal" data-target="#modal-status">Disabled</a>';
						} else {
							html += 'text-danger">Error<a>';
						}

						return html;
					}
				},
				{
					title: '<center>Date Added</center>',
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
					title: '<center><i class="icon-menu-open2"></i></center>',
					data: 'user_id',
					class: 'text-nowrap text-center',
					sortable: false,
					render: function(data, type, row, meta) {
						var password = '';
						if ('<?php echo $this->user->item('user_id'); ?>' == '1') {
							password = '<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-password"><i class="icon-lock"></i>Password</a>';
						}

						return '<div class="list-icons">\n' +
							'	<div class="dropdown">\n' +
							'		<a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-cog2"></i></a>\n' +
							'		<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">\n' +
							'			<div class="dropdown-header">Option</div>\n' +
							'			<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-item"><i class="icon-cog2"></i>Edit</a>\n' + password +
							'			<a href="#" class="dropdown-item btn-delete-item"><i class="icon-trash"></i>Delete</a>\n' +
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

		$('.btn-add-new')
			.attr('data-tooltip', 'tooltip')
			.attr('data-toggle', 'modal')
			.attr('data-target', '#modal-add-new');
		
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
						},
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

	var _componentAddNew = function() {
		const modalEl = $('#modal-add-new');

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
					alert(xhr.responseText);
				},
				success: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-add-new').modal('hide');
					alert(data.message);
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
					alert(xhr.responseText);
				},
				success: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-status').modal('hide');
				}
			});
			return false;
		});
	};

	var _componentItem = function() {
		const modalEl = $('#modal-item');

		modalEl.on('click', '#btn_modified_password', function(e) {
			if ( document.getElementById('user_password_box').className === 'col-lg-10 d-none' ) {
				document.getElementById('user_password_box').classList.replace('col-lg-10', 'col-lg-7');
				document.getElementById('user_password_box').classList.replace('d-none', 'd-block');
				$('#btn_modified_text').text('접기');
			} else {
				document.getElementById('user_password_box').classList.replace('col-lg-7', 'col-lg-10');
				document.getElementById('user_password_box').classList.replace('d-block', 'd-none');
				$('#btn_modified_text').text('수정');
			}
		});

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
		} );

		$('form', modalEl).on('submit', function(e) {
			let target_id = $('[name="user_id"]').val();
			let form_data = $(this).serialize();

			$.ajax({
				type			: 'POST',
				url				: cp_params.base_url + '/preferences/member/users/item_put/' + target_id,
				data			: form_data,
				dataType	: 'json',
				error			: function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success		: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-item').modal('hide');
					alert(data.message);
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
					alert(xhr.responseText);
				},
				success: function(data) {
					$('#table').DataTable().ajax.reload(null, false);
					$('#modal-password').modal('hide');
					alert(data.message);
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
						alert(xhr.responseText);
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
							alert(xhr.responseText);
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
			_componentAddNew();
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
