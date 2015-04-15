<?php echo $this->tag->getDoctype(); ?>
<html lang="en">
<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if (isset($meta_description)) { ?>
			<meta name="description" content="<?php echo $meta_description; ?>">
		<?php } ?>
		<?php if (isset($meta_keywords)) { ?>
			<meta name="keywords" content="<?php echo $meta_keywords; ?>">
		<?php } ?>		
		<?php if (isset($meta_author)) { ?>
			<meta name="author" content="<?php echo $meta_author; ?>">
		<?php } ?>
		<?php if (isset($og_title)) { ?>
			<meta property="og:title" content="<?php echo $og_title; ?>" />
		<?php } ?>
		<?php if (isset($og_description)) { ?>
			<meta property="og:description" content="<?php echo $og_description; ?>" />
		<?php } ?>
		<?php if (isset($og_site_name)) { ?>
			<meta property="og:site_name" content="<?php echo $og_site_name; ?>" />
		<?php } ?>
		<?php if (isset($og_type)) { ?>
			<meta property="og:type" content="<?php echo $og_type; ?>" />
		<?php } ?>
		<?php if (isset($og_url)) { ?>
			<meta property="og:url" content="<?php echo $og_url; ?>" />
		<?php } ?>
		<?php if (isset($og_image)) { ?>
			<meta property="og:image" content="<?php echo $og_image; ?>" />
		<?php } ?>
		<?php echo $this->tag->getTitle(); ?>
		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<?php echo $this->tag->stylesheetLink('css/bootstrap.min.css'); ?>
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<?php echo $this->tag->stylesheetLink('plugins/font-awesome/css/font-awesome.min.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style-responsive.css'); ?>
		
		<?php echo $this->tag->stylesheetLink('plugins/owl-carousel/owl.carousel.css'); ?>
		
		
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
			var baseUrl = '<?php echo $baseUrl; ?>';
		</script>
		
		
	</head>
	<body class="tooltips no-padding">
		<div class="wrapper">