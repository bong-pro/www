<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->document->add_js('moment', base_url('template/assets/js/vendor/ui/moment/moment.min.js'));
$this->document->add_js('datatables', base_url('template/assets/js/vendor/tables/datatables/datatables.min.js'));
$this->document->add_js('select', base_url('template/assets/js/vendor/tables/datatables/extensions/select.min.js'));
$this->document->add_js('select2', base_url('template/assets/js/vendor/forms/selects/select2.min.js'));
$this->document->add_js('buttons', base_url('template/assets/js/vendor/tables/datatables/extensions/buttons.min.js'));
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
<!-- /tabel list -->

<!-- modal add -->
<div id="modal-add" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-upload7 mr-1"></i>신규 등록</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<legend class="text-uppercase font-size-sm font-weight-bold">등록정보</legend>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">상태</label>
					<div class="col-lg-9">
						<select name="is_used" class="form-control select">
							<option value="Y">활성화</option>
							<option value="N">비활성화</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">메뉴명<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="name" class="form-control" placeholder="메뉴명&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">일련번호<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="menu_id" class="form-control" placeholder="메뉴 아이디&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">부모 일련번호<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="parent_menu_id" class="form-control" placeholder="부모 일련번호&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">우선순위</label>
					<div class="col-lg-9">
						<input type="text" name="priority" class="form-control" placeholder="우선순위&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">링크</label>
					<div class="col-lg-9">
						<input type="text" name="link" class="form-control" placeholder="링크&hellip;" required />
						<small class="form-text text-muted">Base URL 이후부터 작성( /aaa/bbb/ccc )</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">링크 target</label>
					<div class="col-lg-9">
						<input type="text" name="link_target" class="form-control" placeholder="링크 target&hellip;" />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">링크 class</label>
					<div class="col-lg-9">
						<input type="text" name="link_class" class="form-control" placeholder="링크 class&hellip;" />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">메뉴 앞 HTML</label>
					<div class="col-lg-9">
						<input type="text" name="before_html" class="form-control" placeholder="HTML 입력&hellip;" />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">메뉴 뒤 HTML</label>
					<div class="col-lg-9">
						<input type="text" name="after_html" class="form-control" placeholder="HTML 입력&hellip;" />
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>닫기</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>저장</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal add -->

<!-- modal name -->
<div id="modal-name" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-pencil7 mr-1"></i>메뉴명 수정</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="menu_id" />

				<div class="form-group row">
					<label class="col-form-label col-lg-2">메뉴명</label>
					<div class="col-lg-10">
						<input type="text" name="name" class="form-control" placeholder="메뉴명&hellip;" required />
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>닫기</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>저장</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal name -->

<!-- modal parent_menu_id -->
<div id="modal-parent-menu" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-pencil7 mr-1"></i>부모 일련번호 수정</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="menu_id" />

				<div class="form-group row">
					<label class="col-form-label col-lg-4">부모 일련번호</label>
					<div class="col-lg-8">
						<input type="text" name="parent_menu_id" class="form-control" placeholder="부모 일련번호&hellip;" required />
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>닫기</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>저장</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal parent_menu_id -->

<!-- modal priority -->
<div id="modal-priority" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-pencil7 mr-1"></i>우선순위 수정</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="menu_id" />

				<div class="form-group row">
					<label class="col-form-label col-lg-3">우선순위</label>
					<div class="col-lg-9">
						<input type="text" name="priority" class="form-control" placeholder="우선순위&hellip;" required />
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>닫기</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>저장</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal priority -->

<!-- modal link -->
<div id="modal-link" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-pencil7 mr-1"></i>링크 수정</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="menu_id" />

				<div class="form-group row">
					<label class="col-form-label col-lg-2">링크</label>
					<div class="col-lg-10">
						<input type="text" name="link" class="form-control" placeholder="링크&hellip;" required />
						<small class="form-text text-muted">Base URL 이후부터 작성( /aaa/bbb/ccc )</small>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>닫기</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>저장</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal link -->

<!-- modal status -->
<div id="modal-status" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-pencil7 mr-1"></i>상태 변경</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="menu_id" />

				<div class="form-group row">
					<label class="col-form-label col-lg-2">상태</label>
					<div class="col-lg-10">
						<select name="is_used" class="form-control select">
							<option value="Y">활성화</option>
							<option value="N">비활성화</option>
						</select>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>닫기</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>저장</button>
			</div>
		</form>
	</div>
</div>
<!-- /modal status -->

<!-- modal item -->
<div id="modal-item" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<form class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title"><i class="icon-pencil7 mr-1"></i>정보 수정</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">

				<input type="hidden" name="menu_id" />

				<legend class="text-uppercase font-size-sm font-weight-bold">등록정보</legend>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">상태</label>
					<div class="col-lg-9">
						<select name="is_used" class="form-control select">
							<option value="Y">활성화</option>
							<option value="N">비활성화</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">메뉴명<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="name" class="form-control" placeholder="메뉴명&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">일련번호<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="menu_id" class="form-control" placeholder="메뉴 아이디&hellip;" disabled />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">부모 일련번호<span class="text-danger ml-1">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="parent_menu_id" class="form-control" placeholder="부모 일련번호&hellip;" required />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">우선순위</label>
					<div class="col-lg-9">
						<input type="text" name="priority" class="form-control" placeholder="우선순위&hellip;" />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">링크</label>
					<div class="col-lg-9">
						<input type="text" name="link" class="form-control" placeholder="링크&hellip;" />
						<small class="form-text text-muted">Base URL 이후부터 작성( /aaa/bbb/ccc )</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">링크 target</label>
					<div class="col-lg-9">
						<input type="text" name="link_target" class="form-control" placeholder="링크 target&hellip;" />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">링크 class</label>
					<div class="col-lg-9">
						<input type="text" name="link_class" class="form-control" placeholder="링크 class&hellip;" />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">메뉴 앞 HTML</label>
					<div class="col-lg-9">
						<input type="text" name="before_html" class="form-control" placeholder="HTML 입력&hellip;" />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">메뉴 뒤 HTML</label>
					<div class="col-lg-9">
						<input type="text" name="after_html" class="form-control" placeholder="HTML 입력&hellip;" />
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>닫기</button>
				<button type="submit" class="btn btn-primary"><i class="icon-checkmark3 font-size-base mr-1"></i>저장</button>
			</div>
		</form>
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
			ajax: {
				url: cp_params.base_url + '/preferences/setting/menus/list',
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
			buttons : [
				{
					titleAttr: 'Create',
					text: '<i class="ph-plus"></i>',
					className: 'btn btn-primary btn-create'
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
							text: '<i class="ph-copy-simple me-2"></i>Copy'
						},
						{
							extend: 'excel',
							text: '<i class="ph-download-simple me-2"></i>Download',
							customize	: function (xlsx) {
								var sheet = xlsx.xl.worksheets["sheet1.xml"];
								$( "c[r^=I] t", sheet ).text( "" );
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
			order: [[2,'desc']],
			createdRow: function(row, data, dataIndex) {
				$(row).data('target-id', data.menu_id);
			},
			columns: [
				{data: null},
				{
					title: '<center>Menu name</center>',
					data: 'name',
					class: 'text-nowrap text-start',
					render: function(data, type, row, meta) {
						return '<a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-name">' + data + '</a>';
					}

				},
				{
					title: '<center>Menu ID</center>',
					data: 'menu_id',
					class: 'text-nowrap text-end'
				},
				{
					title: '<center>Parent menu ID</center>',
					data: 'parent_menu_id',
					class: 'text-nowrap text-end',
					render: function(data, type, row, meta) {
						return '<a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-parent-menu">' + data + '</a>';
					}
				},
				{
					title: '<center>Priority</center>',
					data: 'priority',
					class: 'text-nowrap text-end',
					sortable: false,
					render: function(data, type, row, meta) {
						return '<a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-priority">' + data + '</a>';
					}
				},
				{
					title: '<center>Link</center>',
					data: 'link',
					class: 'text-nowrap text-start',
					render: function(data, type, row, meta) {
						return '<a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-link">' + data + '</a>';
					}
				},
				{
					title: '<center>Status</center>',
					data: 'is_used',
					class: 'text-nowrap text-center',
					sortable: false,
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
						return '<div class="d-inline-flex">\n' +
							'	<div class="dropdown position-static">\n' +
							'		<a href="#" class="text-body" data-bs-toggle="dropdown"><i class="ph-gear"></i></a>\n' +
							'			<div class="dropdown-menu dropdown-menu-end">\n' +
							'			<div class="dropdown-header">Option</div>\n' +
							'			<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-item"><i class="ph-pencil me-2"></i>데이터 수정</a>\n' +
							'		</div>\n' +
							'	</div>\n' +
							'</div>\n';
					}
				}
			],
		} );

		$(':input.search-filter-item').on('change', function() {
			datatable.ajax.reload();
		});

		$('.btn-create')
			.attr('data-tooltip', 'tooltip')
			.attr('data-bs-toggle', 'modal')
			.attr('data-bs-target', '$modal-create');
	};

	var _componentAddNew = function() {
		const modalEl = $( '#modal-add' );

		modalEl.on( 'show.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();

			$( 'select[name="is_used"]' ).val( 'Y' ).trigger( 'change' );
		} );

		modalEl.on( 'hidden.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();

			$( 'select[name="is_used"]' ).val( 'Y' ).trigger( 'change' );
		} );

		$( 'form', modalEl ).on( 'submit', function(e) {
			var form_data    = $( this ).serialize();

			$.ajax( {
				type        : 'POST',
				url         : cp_params.base_url + '/preferences/management/menus/item_insert/',
				data        : form_data,
				dataType    : 'json',
				error       : function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success     : function( data ) {
					if ( data.confirm === 'Y' ) {
						alert( data.message );
						location.reload();
					} else {
						$( '#table' ).DataTable().ajax.reload( null, false );
						$( '#modal-add' ).modal( 'hide' );
						alert( data.message );
					}
				}
			} );
			return false;
		} );
	}

	var _componentName = function() {
		const modalEl = $( '#modal-name' );

		modalEl.on( 'show.bs.modal', function(e) {
			let target_id = $( e.relatedTarget ).closest( 'tr' ).data( 'target-id' );

			axios.get( cp_params.base_url + '/preferences/management/menus/item_get/' + target_id, {
			} ).then( response => {
				$.each( response.data, function( i, v ) {
					var the_el = $( '[name="' + i + '"]' );
					if ( the_el.length > 0 ) {
						the_el.val( v );
						if ( the_el.is( "select" ) ) {
							the_el.change();
						}
					}
				} )
			} );
		} );

		modalEl.on( 'hidden.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();
		} );

		$( 'form', modalEl ).on( 'submit', function(e) {
			let target_id = $( '[name="menu_id"]' ).val();
			let form_data = $( this ).serialize();

			$.ajax( {
				type        : 'POST',
				url         : cp_params.base_url + '/preferences/management/menus/name_put/' + target_id,
				data        : form_data,
				dataType    : 'json',
				error       : function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success     : function( data ) {
					$( '#table' ).DataTable().ajax.reload( null, false );
					$( '#modal-name' ).modal( 'hide' );
					alert( data.message );
				}
			} );
			return false;
		} );
	}

	var _componentParentMenu = function() {
		const modalEl = $( '#modal-parent-menu' );

		modalEl.on( 'show.bs.modal', function(e) {
			let target_id = $( e.relatedTarget ).closest( 'tr' ).data( 'target-id' );

			axios.get( cp_params.base_url + '/preferences/management/menus/item_get/' + target_id, {
			} ).then( response => {
				$.each( response.data, function( i, v ) {
					var the_el = $( '[name="' + i + '"]' );
					if ( the_el.length > 0 ) {
						the_el.val( v );
						if ( the_el.is( "select" ) ) {
							the_el.change();
						}
					}
				} )
			} );
		} );

		modalEl.on( 'hidden.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();
		} );

		$( 'form', modalEl ).on( 'submit', function(e) {
			let target_id = $( '[name="menu_id"]' ).val();
			let form_data = $( this ).serialize();

			$.ajax( {
				type        : 'POST',
				url         : cp_params.base_url + '/preferences/management/menus/paren_menu_put/' + target_id,
				data        : form_data,
				dataType    : 'json',
				error       : function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success     : function( data ) {
					$( '#table' ).DataTable().ajax.reload( null, false );
					$( '#modal-parent-menu').modal( 'hide' );
					alert( data.message );
				}
			} );
			return false;
		} );
	}

	var _componentPriority = function() {
		const modalEl = $( '#modal-priority' );

		modalEl.on( 'show.bs.modal', function(e) {
			let target_id = $( e.relatedTarget ).closest( 'tr' ).data( 'target-id' );

			axios.get( cp_params.base_url + '/preferences/management/menus/item_get/' + target_id, {
			} ).then( response => {
				$.each( response.data, function( i, v ) {
					var the_el = $( '[name="' + i + '"]' );
					if ( the_el.length > 0 ) {
						the_el.val( v );
						if ( the_el.is( "select" ) ) {
							the_el.change();
						}
					}
				} )
			} );
		} );

		modalEl.on( 'hidden.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();
		} );

		$( 'form', modalEl ).on( 'submit', function(e) {
			let target_id = $( '[name="menu_id"]' ).val();
			let form_data = $( this ).serialize();

			$.ajax( {
				type        : 'POST',
				url         : cp_params.base_url + '/preferences/management/menus/priority_put/' + target_id,
				data        : form_data,
				dataType    : 'json',
				error       : function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success     : function( data ) {
					$( '#table' ).DataTable().ajax.reload( null, false );
					$( '#modal-priority' ).modal( 'hide' );
					alert( data.message );
				}
			} );
			return false;
		} );
	}

	var _componentLink = function() {
		const modalEl = $( '#modal-link' );

		modalEl.on( 'show.bs.modal', function(e) {
			let target_id = $( e.relatedTarget ).closest( 'tr' ).data( 'target-id' );

			axios.get( cp_params.base_url + '/preferences/management/menus/item_get/' + target_id, {
			} ).then( response => {
				$.each( response.data, function( i, v ) {
					var the_el = $( '[name="' + i + '"]' );
					if ( the_el.length > 0 ) {
						the_el.val( v );
						if ( the_el.is( "select" ) ) {
							the_el.change();
						}
					}
				} )
			} );
		} );

		modalEl.on( 'hidden.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();
		} );

		$( 'form', modalEl ).on( 'submit', function(e) {
			let target_id = $( '[name="menu_id"]' ).val();
			let form_data = $( this ).serialize();

			$.ajax( {
				type        : 'POST',
				url         : cp_params.base_url + '/preferences/management/menus/link_put/' + target_id,
				data        : form_data,
				dataType    : 'json',
				error       : function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success     : function( data ) {
					$( '#table' ).DataTable().ajax.reload( null, false );
					$( '#modal-link' ).modal( 'hide' );
					alert( data.message );
				}
			} );
			return false;
		} );
	}

	var _componentStatus = function() {
		const modalEl = $( '#modal-status' );

		modalEl.on( 'show.bs.modal', function(e) {
			let target_id = $( e.relatedTarget ).closest( 'tr' ).data( 'target-id' );

			axios.get( cp_params.base_url + '/preferences/management/menus/item_get/' + target_id, {
			} ).then( response => {
				$.each( response.data, function( i, v ) {
					var the_el = $( '[name="' + i + '"]' );
					if ( the_el.length > 0 ) {
						the_el.val( v );
						if ( the_el.is( "select" ) ) {
							the_el.change();
						}
					}
				} )
			} );
		} );

		modalEl.on( 'hidden.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();

			$( 'select[name="is_used"]' ).val( 'Y' ).trigger( 'change' );
		} );

		$( 'form', modalEl ).on( 'submit', function(e) {
			let target_id = $( '[name="menu_id"]' ).val();
			let form_data = $( this ).serialize();

			$.ajax( {
				type        : 'POST',
				url         : cp_params.base_url + '/preferences/management/menus/status_put/' + target_id,
				data        : form_data,
				dataType    : 'json',
				error       : function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success     : function( data ) {
					$( '#table' ).DataTable().ajax.reload( null, false );
					$( '#modal-status' ).modal( 'hide' );
					alert( data.message );
				}
			} );
			return false;
		} );
	}

	var _componentItem = function() {
		const modalEl = $( '#modal-item' );

		modalEl.on( 'show.bs.modal', function(e) {
			let target_id = $( e.relatedTarget ).closest( 'tr' ).data( 'target-id' );

			axios.get( cp_params.base_url + '/preferences/management/menus/item_get/' + target_id, {
			} ).then( response => {
				$.each( response.data, function( i, v ) {
					var the_el = $( '[name="' + i + '"]' );
					if ( the_el.length > 0 ) {
						the_el.val( v );
						if ( the_el.is( "select" ) ) {
							the_el.change();
						}
					}
				} )
			} );
		} );

		modalEl.on( 'hidden.bs.modal', function(e) {
			$( this ).find( 'form' )[0].reset();

			$( 'select[name="is_used"]' ).val( 'Y' ).trigger( 'change' );
		} );

		$( 'form', modalEl ).on( 'submit', function(e) {
			let target_id = $( '[name="menu_id"]' ).val();
			let form_data   = $( this ).serialize();

			$.ajax( {
				type        : 'POST',
				url         : cp_params.base_url + '/preferences/management/menus/item_put/' + target_id,
				data        : form_data,
				dataType    : 'json',
				error       : function( xhr, status, error ) {
					alert( xhr.responseText );
				},
				success     : function( data ) {
					$( '#table' ).DataTable().ajax.reload( null, false );
					$( '#modal-item' ).modal( 'hide' );
					alert( data.message );
				}
			} );
			return false;
		} );
	}

	return {
		init: function() {
			_componentDatatable();
			_componentAddNew();
			_componentName();
			_componentParentMenu();
			_componentPriority();
			_componentLink();
			_componentStatus();
			_componentItem();
		}
	}
}();

document.addEventListener( 'DOMContentLoaded', function() {
	data.init();
} );
</script>
