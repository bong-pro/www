/*********************
 * # Custom JS code
 *********************/

var CodePress = function () {

	const _componentDropzone = function() {
		if (typeof Dropzone == 'undefined') {
			return;
		}

		//Dropzone.autoDiscover = false;
		$.extend(true, Dropzone.prototype.defaultOptions, {
			dictDefaultMessage: "파일을 드래그 하거나<span>여기를 클릭 하세요</span>",
			dictFallbackMessage: "브라우저에서 드래그 앤 드롭을 지원하지 않습니다.",
			dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
			dictFileTooBig: "파일 크기가 초과되었습니다.({{filesize}}MiB). 최대 용량: {{maxFilesize}}MiB.",
			dictInvalidFileType: "이 형식의 파일은 업로드할 수 없습니다.",
			dictResponseError: "서버가 {{statusCode}} 코드를 응답하였습니다.",
			dictCancelUpload: "업로드 취소",
			dictCancelUploadConfirmation: "해당 업로드를 취소하시겠습니까?",
			dictUploadCanceled: '업로드가 취소되었습니다.',
			dictRemoveFile: "파일 삭제",
			dictMaxFilesExceeded: "더 이상 파일을 업로드할 수 없습니다.",

			addRemoveLinks: true,
			data: null,
			init: function() {
				const dz = this;
				const multiple = dz.options.maxFiles > 1;
				const inputEl = $(this.element).find(':input');

				// drop, dragstart, dragend, dragenter, dragover, dragleave,
				// addedfile, removedfile, thumbnail, error, errormultiple,
				// processing, processingmultiple, uploadprogress, totaluploadprogress,
				// sending, sendingmultiple, success, successmultiple,
				// canceled, canceledmultiple, complete, completemultiple,
				// reset, maxfilesexceeded, maxfilesreached

				dz.on('maxfilesexceeded', function (file) {
					this.removeAllFiles();
					this.addFile(file);
					console.log('교체함');
				});

				dz.on('addedfile', function(file) {
					console.log('추가됨');
				});

				dz.on('sending', function(file, xhr, formData) {
					console.log('전송');
				});

				dz.on('success', function(file, response) {
					console.log(dz.getAcceptedFiles());
					const value = is_json(inputEl.val()) ? JSON.parse(inputEl.val()) : [inputEl.val()];
					response.forEach(function(v) {
						value.push(v.dataURL);
					});

					inputEl.val(JSON.stringify(value));
				});

				dz.on('removedfile', function(file) {
					const value = dz.files.map(v => {
						return v['dataURL'];
					});

					inputEl.val(value.length > 0 ? JSON.stringify(value) : '' );
				});

				$.each(dz.options.data, function(index, mock) {
					if (dz.options.maxFiles <= index + 1) {
						dz.files.push($.extend(mock, {
							accepted : true,
						}));

						dz.displayExistingFile(mock, mock.path);
					}
				} );
			}
		} );
	};
    
	// Select2
	const _componentSelect2 = function() {
		if (!$().select2) {
			return;
		}

		// Default initialization
		$('.select').select2( {
			minimumResultsForSearch: Infinity
		});

		// Select with search
		$('.select-search').select2();

		// Fixed width. Single select
		$('.select-fixed-single').select2( {
			minimumResultsForSearch: Infinity,
			width: 250
		});

		$.fn.select2.defaults.set('language', 'ko');

		$('select.select2:not(.select2-hidden-accessible)').select2( {
			minimumResultsForSearch: Infinity,
			dropdownAutoWidth: true,
			//width: 'auto',
			//allowClear:true,
		});

		$('select.select2-search:not(.select2-hidden-accessible)').select2( {
			placeholder: function() {
				return $(this).data('placeholder');
			},
		});
	};

	// BlockUI
	const _componentBlockUI = function() {
		if ( !$().block ) {
			return;
		}

		$.extend( $.blockUI.defaults, {
			overlayCSS: {
				backgroundColor: '#fff',
				opacity: 0.8,
				cursor: 'wait',
				'box-shadow': '0 0 0 1px #ddd'
			},
			css: {
				border: 0,
				padding: 0,
				backgroundColor: 'none'
			}
		} );
	};

	// Loading Button
	const _componentLoadingButton = function() {
		$( '.btn-loading' ).on( 'click', function () {
			var btn = $( this ),
				initialText = btn.html(),
				loadingText = btn.data( 'loading-text' );
			btn.html( loadingText ).addClass( 'disabled' );
			setTimeout( function () {
				btn.html( initialText ).removeClass( 'disabled' );
			}, 3000 )
		} );
	};

	// Ladda Button
	const _componentLaddaButton = function() {
		if ( typeof Ladda == 'undefined' ) {
			return;
		}

		// Button with spinner
		Ladda.bind( '.btn-ladda-spinner', {
			dataSpinnerSize: 16,
			timeout: 2000
		} );

		Ladda.bind( '.btn-ladda-progress', {
			callback: function( instance ) {
				var progress = 0;
				var interval = setInterval( function() {
					progress = Math.min( progress + Math.random() * 0.1, 1);
					instance.setProgress( progress );

					if( progress === 1 ) {
						instance.stop();
						clearInterval( interval );
					}
				}, 200 );
			}
		} );
	};

	// Validation
	const _componentVailidation = function() {
		if (!$().validate) {
			return;
		}

		$.validator.setDefaults( {
			ignore: 'input[type=hidden], .select2-search__field',
			errorClass: 'validation-invalid-label',
			successClass: 'validation-valid-label',
			validClass: 'validation-valid-label',
			highlight: function(element, errorClass) {
				$(element).removeClass(errorClass);
			},
			unhighlight: function(element, errorClass) {
				$(element).removeClass(errorClass);
			},
			success: function(label) {
				label.remove();
				//label.addClass('validation-valid-label').text('Success.');
			},
			errorPlacement: function( error, element ) {
				if (element.parents().hasClass('form-check')) {
					error.appendTo( element.parents('.form-check').parent());
				}
				else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
					error.appendTo(element.parent());
				}
				else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
					error.appendTo(element.parent().parent());
				}
				else {
					error.insertAfter(element);
				}
			},
		});
	};

	// Datatables
	const _componentDatatable = function() {
		if (!$().DataTable) {
			return;
		}

		const displayLength = sessionStorage.getItem('ui_datatable_length') !== null ? parseInt(sessionStorage.getItem('ui_datatable_length')) : 10;
		$.extend(true, $.fn.dataTable.defaults, {
			dom: '<"datatable-spinner"r><"datatable-header"flB><"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"ip>',
			retrieve: true,
			processing: true,
			serverSide: true,
			responsive: true,
			columnDefs: [
				{
					width: 10,
					targets: [0]
				}
			],
			fixedColumns: {
				leftColumns: 1,
				rightColumns: 0
			},
			select: {
				style: 'multi',
				selector: 'td:first-child'
			},
			iDisplayLength: displayLength,
			lengthMenu: [[10,15,20,50,75,100],[10,15,20,50,75,100]],
			createdRow: function(row, data, dataIndex) {},
			initComplete: function(settings, json) {
				const wrapperEl = $(settings.nTableWrapper);

				wrapperEl.find('.dataTables_length select').addClass('select2');
				wrapperEl.find('.dataTables_filter input').unbind().bind('keyup', function(e) {
					const pattern = /^[가-힣0-9a-zA-Z\s~!@#$%^&*()_+|<>?:{}]+$/;
					const keyword = this.value;

					if (keyword.length < 1 || (keyword.length > 1 && pattern.test(keyword)) || e.keyCode == 13) {
						settings.oInstance.api().search(keyword).draw();
					}
				});

				// 데이터테이블 limit 변경시 저장
				$('.datatable-header .dataTables_length').on('change', 'select', function() {
					window.sessionStorage.setItem('ui_datatable_length', $(this).val());
				});
			},
			fnPreDrawCallback: function(settings) {},
			drawCallback: function(settings) {
				// 렌더링 할때마다 실행하므로 trigger 이동 필요
				_componentSelect2();
			},
			language: {
				decimal: '',
				emptyTable: 'No data available in table',
				info: 'Showing _START_ to _END_ of _TOTAL_ entries',
				infoEmpty: 'Showing 0 to 0 of 0 entries',
				infoFiltered: '(filtered from _MAX_ total entries)',
				infoPostFix: '',
				thousands: ',',
				lengthMenu: '_MENU_',
				loadingRecords: 'Loading...',
				processing: 'Wait...',
				search: '',
				searchPlaceholder: 'Keyword...',
				zeroRecords: 'No matching records found',
				paginate: {
					first: 'First',
					last: 'Last',
					next: '&rarr;',
					previous: '&larr;',
				},
				aria: {
					sortAscending: ': activate to sort column ascending',
					sortDescending: ': activate to sort column descending',
				},
				select: {
					rows: {
						'0': '',
						'_': '_Select(<span id="tbody-select-row">%d</span>)',
					},
				},
			},
		});

		$.fn.dataTable.ext.errMode = 'throw';
	};

	return {
		initBeforeLoad: function() {
			_componentDropzone();
		},

		// Initialize all components
		initComponent : function() {
			_componentDropzone();
      _componentSelect2();
			_componentBlockUI();
			_componentLoadingButton();
			_componentLaddaButton();
			_componentVailidation();
			_componentDatatable();
		},

		// Enable transitions when page is fully loaded
		initAfterLoad: function() {
				//_searchFormValidation();
				//_displayCopyrightOnConsole();
				//setTimeout(function() {window.scrollTo(0, 1)}, 100);
      }
    };
}();

/*********************
 * Initialize module
 *********************/
CodePress.initBeforeLoad();

// When content is loaded
document.addEventListener('DOMContentLoaded', () => {
	CodePress.initComponent();
});

// When page is fully loaded
window.addEventListener('load', () => {
	CodePress.initAfterLoad();
});
