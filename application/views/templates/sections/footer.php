<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Footer -->
<div class="navbar navbar-sm navbar-footer border-top">
	<div class="container-fluid">
		<span>&copy; 2022 <a href="#">DEMO CO,.LTD.</a></span>
		<ul class="nav">
			<li class="nav-item">
				<div class="d-flex align-items-center mx-md-1">
					<code>
						<span class="d-none d-md-inline-block">
							<?php echo  (ENVIRONMENT === 'development') ?  'CI Version:' : '' ?>
						</span>
						<span>
							<?php echo  (ENVIRONMENT === 'development') ?  '<strong>' . CI_VERSION . '</strong>' : '' ?>
						</span>
					</code>
				</div>
			</li>
		</ul>
	</div>
</div>
<!-- /footer -->
