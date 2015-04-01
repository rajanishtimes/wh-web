<!DOCTYPE html>
<html lang="en">
<head>
		{% block head %}
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="{{ meta_description }}">
		<meta name="keywords" content="{{ meta_keywords }}">
		<meta name="author" content="{{ meta_author }}">
		{{ get_title() }}
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		{{ stylesheet_link('plugins/font-awesome/css/font-awesome.min.css') }}
		{{ stylesheet_link('css/style.css') }}
		{{ stylesheet_link('css/style-responsive.css') }}
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
			var baseUrl = '<?php echo $baseUrl; ?>';
		</script>
		
		{% endblock %}
	</head>
	<body>