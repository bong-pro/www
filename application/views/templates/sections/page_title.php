<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="page-header-content d-lg-flex">

	<div class="d-flex">
		<h4 class="page-title mb-0">
			<span>
				<?php echo !empty($page_link) ? $page_link : 'HOME'; ?> -
			</span>
			<span class="fw-normal"> <?php echo !empty($page_title) ? $page_title : 'Dashboard'; ?></span>
		</h4>
		<?php if ( !empty($nav_data) ) : ?>
		<a href="#" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse"><i class="ph-caret-down collapsible-indicator ph-sm m-1"></i></a>
		<?php endif; ?>
	</div>
</div>

<?php if ( !empty($nav_data) ) : ?>
<div class="page-header-content d-lg-flex border-top">
	<div class="d-flex">
		<div class="breadcrumb py-2">
			<?php foreach ( $nav_data AS $item ) : ?>
			<a href="<?php echo $item['link']; ?>" class="breadcrumb-item <?php echo html_escape($item['link_class']); ?>">
				<?php echo $item['before_html'] . '<span>HOME</span> - ' . $item['name'] . $item['after_html']; ?>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>
