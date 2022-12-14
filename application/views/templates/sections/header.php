<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
	<div class="container-fluid">
		
		<!-- Mobile togglers -->
		<div class="d-flex d-lg-none me-2">
			<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
				<i class="ph-list"></i>
			</button>
		</div>
		<!-- /mobile togglers -->

		<!-- Navbar brand -->
		<div class="navbar-brand flex-1 flex-lg-0">
			<a href="/" class="d-inline-flex align-items-center">
				<span class="font-weight-bold text-white d-none d-sm-block" style="font-size:1.3rem">DEMO corp.</span>
				<span class="font-weight-bold text-white d-sm-none" style="font-size:1.4rem">DEMO</span>
			</a>
		</div>
		<!-- /navbar brand -->

		<!-- Left content -->
		<div class="flex-row">
		</div>
		<!-- left content -->

		<!-- Collapsible navbar content (center) -->
		<div class="navbar-collapse justify-content-center flex-lg-1 order-2 order-lg-1 collapse" id="navbar-mobile">
		</div>
		<!-- /collapsible navbar content (center) -->
	
		<!-- Right content -->
		<ul class="nav flex-row justify-content-end order-1 order-lg-2">
			<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
				<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown" aria-expanded="false">
					<?php echo $this->user->get_avatar(array(
						'class'	=> 'status-indicator-container rounded-pill border',
						'width' => 30
					)); ?>
					<span class="d-none d-lg-inline-block mx-lg-2"><?php echo $this->user->item('name'); ?></span>
				</a>
				
				<div class="dropdown-menu dropdown-menu-end">
					<a href="<?php echo base_url('/admin/profile'); ?>" class="dropdown-item"><i class="ph-user-circle me-2"></i>My profile</a>
					<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item"><i class="ph-gear me-2"></i>Account settings</a>
				<a href="<?php echo base_url('/auth/logout'); ?>" class="dropdown-item"><i class="ph-sign-out me-2"></i>Logout</a>
				</div>
			</li>
		</ul>
		<!-- /right content -->

	</div>
</div>
<!-- /main navbar -->
