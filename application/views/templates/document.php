<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, shrink-to-fit=no">
	<meta name="HandheldFriendly" content="true">
	<meta name="theme-color" content="<?php echo html_escape($theme_color); ?>">
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">

	<title><?php echo $page_title; ?></title>

	<!-- Stylesheets -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('template/assets/fonts/inter/inter.css'); ?>" />
	<link type="text/css" rel="stylesheet" id="icomoon-css" href="<?php echo base_url('template/assets/icons/phosphor/styles.min.css'); ?>" media="all">
	<link type="text/css" rel="stylesheet" id="all-css" href="<?php echo base_url('template/' . $layout_num . $theme . 'full/assets/css/' . $direction . 'all.min.css'); ?>" media="all">
	<link type="text/css" rel="stylesheet" id="core-css" href="<?php echo base_url('assets/css/codepress.css'); ?>" type="text/css" media="all">
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.ico'); ?>" />
	<?php $this->document->output_css(); ?>
	<!-- /Stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url('template/assets/js/jquery/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('template/assets/js/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
	<!-- /Core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/axios/axios.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/codepress.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('template/' . $layout_num . $theme . 'full/assets/js/app.js'); ?>"></script>
	<?php $this->document->output_js(); ?>
	<!-- /Theme JS files -->
</head>

<body class="<?php echo html_escape($body_class); ?>">

	<?php echo $section__header; ?>

	<div class="page-content <?php echo html_escape($page_class);?>">

		<?php echo $section__left_sidebar; ?>

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<?php if ( !empty($section__page_title) || !empty($section__breadcrumb) ) : ?>
			<div class="page-header page-header-light page-header-static shadow">
				<?php if ( strpos($_SERVER['REQUEST_URI'], 'auth') ) : ?>
				<?php else : ?>
					<?php echo $section__page_title; ?>
				<?php endif; ?>
				<?php echo $section__breadcrumb; ?>
			</div>
			<?php endif; ?>
			<!-- /page header -->

			<!-- Inner content -->
			<div class="content-inner">
				<div id="content" class="content <?php echo html_escape($content_class); ?>">
					<?php echo $section__content; ?>
				</div>
				<?php echo $section__footer; ?>
			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

		<?php echo $section__right_sidebar; ?>

	</div>
	<!-- /page-content -->

	<?php $this->document->output_js(true); ?>

</body>
</html>
