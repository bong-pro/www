<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$group_permission = explode(',', str_replace('"', '', $this->user->item('group_permission')));
array_push($group_permission, '/dashboard');
$title_permission = array('main');
foreach ($group_permission as $value) {
	$array = explode('/', $value);
	array_push($title_permission, $array[1]);
}
$title_permission = array_unique($title_permission);
?>
<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Header -->
		<div class="sidebar-section">
			<div class="sidebar-section-body d-flex justify-content-center">
				<div class="sidebar-resize-hide flex-grow-1 my-auto">
					<div class="hstack gap-2 flex-grow-1">
						<a href="#" class="mr-3">
						<?php echo $this->user->get_avatar(array(
							'class'	=> 'status-indicator-container rounded-pill border',
							'width'	=> 32,
						)); ?>
						</a>
						<div class="me-auto">
							<div class="fs-sm text-white opacity-75"><?php echo $this->user->item('name'); ?></div>
							<div class="fw-semibold"><?php echo $this->user->item('email'); ?></div>
						</div>
					</div>
				</div>

				<div>
					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
						<i class="ph-arrows-left-right"></i>
					</button>

					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
						<i class="ph-x"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /header -->

		<!-- Main navigation -->
		<?php if (!empty($nav_data)) : ?>
		<div class="sidebar-section">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<?php foreach ($nav_data as $item) : ?> 
				<?php if (in_array(strtolower($item['name']), $title_permission)) : ?>
				<li class="nav-item-header" <?php echo html_escape($item['link_class']); ?>>
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">
						<?php echo $item['before_html'] . '<span>' . $item['name'] . '</span>' . $item['after_html']; ?>
					</div>
					<i class="ph-dots-three sidebar-resize-show" title="<?php echo html_escape($item['name']); ?>"></i>
				</li>
				<?php echo doc_generate_nav($item['_children'], $document_ID, null, $group_permission); ?>
				<?php endif; ?>
				<?php endforeach; ?>

			</ul>
		</div>
		<?php endif; ?>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>
<!-- /main sidebar -->
