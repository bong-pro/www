<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->document->add_js('gauge_basic', base_url('template/assets/js/vendor/visualization/echarts/echarts.min.js'));
?>

<!-- Dashboard -->
<div class="row">
	<div class="col-xl-6">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h5 class="mb-0">Server time</h5>
			</div>
			<div class="card-body">
				<div class="mb-1">
					<h1 class="" id="clock"><?php echo date("Y-m-d H:i:s", time()); ?></h1>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<h5>Welcome!</h5>
				<p>The page you are looking at is being generated dynamically by System.</p>
				<p>If you would like to edit this page you'll find it located at:</p>
				<code>application/views/page/dashboard.php</code>
				<p>The corresponding controller for this page is found at:</p>
				<code>application/controllers/Dashboard.php</code>
				<div id='ci_info'>
					<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CI Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h5 class="mb-0">Server info</h5>
			</div>

			<div class="card-body">
				<div class="mb-4">
					<div class="row mb-3">
						<label class="col-form-label col-lg-4">Server Name</label>
						<div class="col-lg-8">
							<input type="text" class="form-control-plaintext border-bottom p-1" value="<?php echo $_SERVER['SERVER_NAME']; ?>" disabled />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-4">Server Addr</label>
						<div class="col-lg-8">
							<input type="text" class="form-control-plaintext border-bottom p-1" value="<?php echo $_SERVER['SERVER_ADDR']; ?>" disabled />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-4">PHP Version</label>
						<div class="col-lg-8">
							<input type="text" class="form-control-plaintext border-bottom p-1" value="<?php echo phpversion(); ?>" disabled />
						</div>
					</div>

					<div class="fw-bold border-bottom pb-2 mb-3"></div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-4">CPU Usage percent</label>
						<div class="col-lg-8">
							<input type="text" class="form-control-plaintext border-bottom p-1" id="cpu_usage_percent" value="<?php echo $cpu_usage_percent; ?>" disabled />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-4">MEM Usage percent</label>
						<div class="col-lg-8">
							<input type="text" class="form-control-plaintext border-bottom p-1" id="memory_usage_percent" value="<?php echo $memory_usage_percent; ?>" disabled />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-4">DISK Usage percent</label>
						<div class="col-lg-8">
							<input type="text" class="form-control-plaintext border-bottom p-1" id="disk_usage_percent" value="<?php echo $disk_usage_percent; ?>" disabled />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /dashboard -->

<script type="text/javascript">
var data = function() {
	var _componentTime = function() {
		const clock = document.getElementById('clock');

		function getTime() {
			const time		= new Date();
			const year		= String(time.getFullYear()).padStart(2, "0");
			const month		= String((time.getMonth() + 1 )).padStart(2, "0");
			const today		= String(time.getDate()).padStart(2, "0");
			const hour		= String(time.getHours()).padStart(2, "0");
			const minutes	= String(time.getMinutes()).padStart(2, "0");
			const seconds	= String(time.getSeconds()).padStart(2, "0");

			clock.innerHTML = `${year}-${month}-${today} ${hour}:${minutes}:${seconds}`;
		}

		setInterval(getTime, 1000);
	};

	var _componentSystemInfo = function() {
		function getSystemInfo() {
			$.ajax({
				url: cp_params.base_url + '/dashboard/get_server_info/',
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				},
				success: function(data) {
					$('#cpu_usage_percent').val(data.cpu_usage_percent);
					$('#memory_usage_percent').val(data.memory_usage_percent);
					$('#disk_usage_percent').val(data.disk_usage_percent);
				}
			});
		}

		setInterval(getSystemInfo, 5000);
	};

	return {
		init: function() {
			_componentTime();
			_componentSystemInfo();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	data.init();
});
</script>
