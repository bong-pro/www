<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->document->add_js('moment', base_url('template/assets/js/vendor/editors/ace/ace.js'));

$this->document->add_inline_style ("
.language-javascript { white-space: nowrap; overflow: auto; width: 500px; height: 500px; }
");
?>

<!-- Data log -->
<div class="card">
	<div class="card-header d-flex align-items-center">
		<h5 class="mb-0"><i class="ph-code me-1"></i><?php echo $page_title; ?></h5>
		<div class="d-inline-flex ms-auto">
			<a class="text-body me-2" data-card-action="reload"><i class="ph-arrows-clockwise"></i></a>
			<a class="text-body" data-card-action="fullscreen"><i class="ph-corners-out"></i></a>
		</div>
	</div>

	<form class="form" id="logs-form">
		<div class="card-header">
			<div class="d-flex justify-content-end">
				<a href="<?php echo base_url('preferences/data/logs/data_download'); ?>" class="btn btn-primary btn-download me-2"><i class="icon-file-download font-size-base mr-1"></i>Download</a>
				<button type="submit" class="btn btn-danger btn-delete"><i class="icon-trash font-size-base mr-1"></i>Delete</button>
			</div>
		</div>

		<div class="card-body">
			<div class="mb-3">
				<pre class="rounded border" id="json_editor"><?php echo $logs; ?></pre>
			</div>
		</div>
	</form>
</div>
<!-- /data log -->

<script type="text/javascript">
var data = function() {

	var _componentAce = function() {
		if (typeof ace == 'undefined') {
			console.warn('Warning - ace.js is not loaded.');
			return;
		}

		const php_editor = ace.edit('json_editor', {
			mode: 'ace/mode/json',
			readOnly: true
		});
	};

	var _componentDelete = function() {
		const modalEl = $('#logs-form');

		modalEl.on('click', '.btn-delete', function(e) {

			if (confirm('Are you sure you want to delete it?') == true) {
				$.ajax({
					dataType: 'json',
					url: cp_params.base_url + '/preferences/data/logs/data_delete',
					error: function(xhr, status, error) {
						alert(xhr.responseText);
					},
					success: function(data) {
						alert(data.message);
						location.reload();
					}
				});
				return false;
			} else {
				return false;
			}
		});
	};

	return {
		init: function() {
			_componentAce();
			_componentDelete();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
