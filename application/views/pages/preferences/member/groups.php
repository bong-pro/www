<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->document->add_js('moment', base_url('template/assets/js/vendor/ui/moment/moment.min.js'));
$this->document->add_js('datatables', base_url('template/assets/js/vendor/tables/datatables/datatables.min.js'));
$this->document->add_js('select', base_url('template/assets/js/vendor/tables/datatables/extensions/select.min.js'));
$this->document->add_js('select2', base_url('template/assets/js/vendor/forms/selects/select2.min.js'));
$this->document->add_js('buttons', base_url('template/assets/js/vendor/tables/datatables/extensions/buttons.min.js'));

$this->document->add_js('sweet_alert', base_url('template/assets/js/vendor/notifications/sweet_alert.min.js'));

$this->document->add_js('fancytree_all', base_url('template/assets/js/vendor/trees/fancytree_all.min.js'));
?>

<!-- Table list -->
<div class="card data-table">
	<div class="card-header d-flex align-items-center">
		<h5 class="mb-0"><i class="ph-users-three me-1"></i><?php echo $page_title; ?></h5>
		<div class="d-inline-flex ms-auto">
			<a class="text-body me-2" data-card-action="reload"><i class="ph-arrows-clockwise"></i></a>
			<a class="text-body" data-card-action="fullscreen"><i class="ph-corners-out"></i></a>
		</div>
	</div>

	<table class="table table-xs table-striped table-hover datatable-button-init-collection datatables" id="table"></table>
</div>
<!-- /table list -->

<!-- /Modal create -->
<div id="modal-create" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="ph-users-three me-1"></i>Create</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<form class="form-horizontal">
				<div class="modal-body">
					<div class="row mb-3">
						<label class="col-form-label col-sm-3">Status</label>
						<div class="col-sm-9">
							<select name="is_used" class="form-control select">
								<option value="Y">Enabled</option>
								<option value="N">Disabled</option>
							</select>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">Group name<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" placeholder="Group name" required />
						</div>
					</div>

					<div class="row mb-0 p-2">
						<label class="form-check form-check-reverse">
							<input type="checkbox" class="form-check-input" id="create_select_all" />
							<span class="form-check-label">Select all</span>
						</label>

						<div class="tree-checkbox-toggle border rounded p-3 tree-create"></div>
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
							<input type="hidden" name="group_id" />
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
				<h5 class="modal-title"><i class="ph-users-three me-1"></i>Edit group</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<form class="form-horizontal form-validate-jquery-item">
				<div class="modal-body">
					<div class="row mb-3">
						<label class="col-form-label col-sm-3">Status</label>
						<div class="col-sm-9">
							<input type="hidden" name="group_id" />
							<select name="is_used" class="form-control select">
								<option value="Y">Enabled</option>
								<option value="N">Disabled</option>
							</select>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-sm-3">Group name<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" placeholder="Group name" required />
						</div>
					</div>

					<div class="row mb-0 p-2">
						<label class="form-check form-check-reverse">
							<input type="checkbox" class="form-check-input" id="item_select_all" />
							<span class="form-check-label">Select all</span>
						</label>

						<div class="m-0 p-0" id="tree-container">
							<div class="tree-checkbox-toggle border rounded p-3 tree-item"></div>
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
<!-- /modal item -->

<script type="text/javascript">
var data = function() {

	var _componentDatatable = function() {
		if (!$().DataTable) {
			console.warn('Warning - datatables.min.js is not loaded.');
			return;
		}

		const tableEl = $('table.datatables');

		var datatable = tableEl.DataTable( {
			ajax : {
				url: cp_params.base_url + '/preferences/member/groups/list',
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
						} else if($.isArray(value)) {
							data[key] = value.join();
						} else {
							data[key] = value;
						}
					});
					return data;
				},
				dataSrc : function(response){
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
			buttons : [
				{
					titleAttr: 'Create',
					text: '<i class="ph-plus"></i>',
					className: 'btn btn-primary btn-create',
				},
				{
					titleAttr: 'Delete Selected',
					text: '<i class="ph-trash"></i>',
					className: 'btn btn-danger btn-delete-selected',
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
							text: '<i class="ph-download-simple me-2"></i>Download',
							customize: function (xlsx) {
								var sheet = xlsx.xl.worksheets["sheet1.xml"];
								$( "c[r^=E] t", sheet ).text( "" );
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
				style: 'nulti',
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
			order: [[1, 'desc']],
			createdRow: function(row, data, dataIndex) {
				$(row).data('target-id', data.group_id);
			},
			columns : [
				{data: null},
				{
					title: '<center>#</center>',
					data: 'group_id',
					class: 'text-nowrap text-end',
					visible: false,
				},
				{
					title: '<center>Group name</center>',
					data: 'name',
					class: 'text-nowrap text-start',
				},
				{
					title: '<center>Status</center>',
					data: 'is_used',
					class: 'text-nowrap text-center',
					render: function(data, type, row, meta) {
						let class_y = "badge badge-flat border-primary text-primary";
						let class_n = "badge badge-flat text-muted";

						var html = '<a href="#" class="';
						if (data === 'Y') {
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
							? moment.duration(momentDt.diff()).humanize() + ' age'
							: momentDt.format('YYYY-MM-DD');
					}
				},
				{
					title: '<center><i class="ph-list"></i></center>',
					data: 'group_id',
					class: 'text-nowrap text-center',
					sortable: false,
					render: function(data, type, row, meta) {
						return '<div class="d-inline-flex">\n' +
							'	<div class="dropdown position-static">\n' +
							'		<a href="#" class="text-body" data-bs-toggle="dropdown"><i class="ph-gear"></i></a>\n' +
							'		<div class="dropdown-menu dropdown-menu-end">\n' +
							'			<div class="dropdown-header">Option</div>\n' +
							'			<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-item"><i class="ph-pencil me-2"></i>Edit</a>\n' +
							'			<div class="dropdown-divider"></div>\n' +
							'			<a href="#" class="dropdown-item btn-delete-item"><i class="ph-trash me-2"></i>Move to trach</a>\n' +
							'		</div>\n' +
							'	</div>\n' +
							'</div>\n';
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

	var _componentCreate = function() {
		const modalEl = $('#modal-create');

		modalEl.on('show.bs.modal', function(e) {
			$(this).find('form')[0].reset();
			$('select[name="is_used"]').val('Y').trigger('change');
		});

		modalEl.on('hidden.bs.modal', function(e) {
			$(this).find('form')[0].reset();
			$('select[name="is_used"]').val('Y').trigger('change');
		});

		$('form', modalEl).on('submit', function(e) {
			var form_data = $(this).serialize();

			var tree = $('.tree-create').fancytree('getTree'),
				node = tree.getActiveNode();

			searchIDs = tree.getSelectedNodes();

			var i = 0;
			searchIDs.forEach(function(node) {
				form_data += '&' + i + '=' + node.key;
				i++;
			});

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/preferences/member/groups/item_insert/',
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

			axios.get(cp_params.base_url + '/preferences/member/groups/item_get/' + target_id, {
			}).then(response => {
				$.each(response.data, function(i, v) {
					var the_el = $('[name="' + i + '"]');
					if ( the_el.length > 0 ) {
						the_el.val(v);
						if ( the_el.is("select") ) {
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
			let target_id = $('[name="group_id"]').val();
			let form_data = $(this).serialize();

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/preferences/member/groups/status_put/' + target_id,
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
			let target_id = $(e.relatedTarget).closest('tr').data('target-id');

			axios.get(cp_params.base_url + '/preferences/member/groups/item_get/' + target_id, {
			}).then(response => {
				$.each(response.data, function(i, v) {
					var the_el = $('[name="' + i + '"]');
					if (i == 'tree') {
						$('.tree-item').remove();
						$('#tree-container').append('<div class="tree-checkbox-toggle border rounded p-3 tree-item"></div>');

						var tree = '[' + v + ']';
						$('.tree-item').fancytree( {
							checkbox: true,
							selectMode: 3,
							source: eval(tree),
						});

						var selectAllSwitch = document.querySelector('#item_select_all');
						selectAllSwitch.addEventListener('change', function() {
							if (selectAllSwitch.checked) {
								$.ui.fancytree.getTree('.tree-item').visit(function(node){
									node.setSelected(true);
								});
								return false;
							} else {
								$.ui.fancytree.getTree('.tree-item').visit(function(node){
									node.setSelected(false);
								});
								return false;
							}
						});	
					} else {
						if (the_el.length > 0) {
							the_el.val(v);
							if (the_el.is("select")) {
								the_el.change();
							}
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
			let target_id = $('[name="group_id"]').val();
			let form_data = $(this).serialize();

			var tree = $('.tree-item').fancytree('getTree'),
				node = tree.getActiveNode();

			searchIDs = tree.getSelectedNodes();

			var i = 0;
			searchIDs.forEach(function(node) {
				form_data += '&' + i + '=' + node.key;
				i++;
			});

			$.ajax({
				type: 'POST',
				url: cp_params.base_url + '/preferences/member/groups/item_put/' + target_id,
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

	var _componentDeleteItem = function() {
		const modalEl = $('table.datatables');

		modalEl.on('click', '.btn-delete-item', function(e) {
			let target_id = $(this).closest('tr').data('target-id');

			if (target_id == '1') {
				alert('This Group cannot be deleted');
				return false;
			}

			if (confirm('Are you sure you want to delete it?') == true) {
				$.ajax({
					url: cp_params.base_url + '/preferences/member/groups/item_delete/' + target_id,
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
						msg += '\n(The master Group cannot be deleted)';
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
						url: cp_params.base_url + '/preferences/member/groups/selected_delete/',
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

	var _componentFancytree = function() {
		if ( !$().fancytree ) {
			console.warn('Warning - codepress.js is not loaded.');
			return;
		}

		$('.tree-create').fancytree({
			checkbox: true,
			selectMode: 3,
			source: [<?php echo $tree ?>]
		});

		var selectAllSwitch = document.querySelector('#create_select_all');
		selectAllSwitch.addEventListener('change', function() {
			if (selectAllSwitch.checked) {
				$.ui.fancytree.getTree('.tree-checkbox-toggle').visit(function(node){
					node.setSelected(true);
				});
				return false;
			} else {
				$.ui.fancytree.getTree('.tree-checkbox-toggle').visit(function(node){
					node.setSelected(false);
				});
				return false;
			}
		});	
	};

	return {
		init: function() {
			_componentDatatable();
			_componentCreate();
			_componentStatus();
			_componentItem();
			_componentDeleteItem();
			_componentDeleteSelected();
			_componentFancytree();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
