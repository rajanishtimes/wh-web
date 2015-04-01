<!DOCTYPE html>
<html lang="en">
<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $meta_description; ?>">
		<meta name="keywords" content="<?php echo $meta_keywords; ?>">
		<meta name="author" content="<?php echo $meta_author; ?>">
		<?php echo $this->tag->getTitle(); ?>
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<?php echo $this->tag->stylesheetLink('plugins/font-awesome/css/font-awesome.min.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style-responsive.css'); ?>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
			var baseUrl = '<?php echo $baseUrl; ?>';
		</script>
		
		
	</head>
	<body>