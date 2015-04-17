{{ get_doctype() }}
<html lang="en">
<head>
		{% block head %}
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		{% if meta_description is defined %}
			<meta name="description" content="{{ meta_description }}">
		{% endif  %}
		{% if meta_keywords is defined %}
			<meta name="keywords" content="{{ meta_keywords }}">
		{% endif  %}		
		{% if og_title is defined %}
			<meta property="og:title" content="{{og_title}}" />
		{% endif  %}
		{% if og_description is defined %}
			<meta property="og:description" content="{{og_description}}" />
		{% endif  %}
		{% if og_site_name is defined %}
			<meta property="og:site_name" content="{{og_site_name}}" />
		{% endif  %}
		{% if og_type is defined %}
			<meta property="og:type" content="{{og_type}}" />
		{% endif  %}
		{% if og_url is defined %}
			<meta property="og:url" content="{{og_url}}" />
		{% endif  %}
		{% if og_image is defined %}
			<meta property="og:image" content="{{og_image}}" />
		{% endif  %}
		{{ get_title() }}
		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		{{ stylesheet_link('css/bootstrap.min.css') }}
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		{{ stylesheet_link('plugins/font-awesome/css/font-awesome.min.css') }}
		{{ stylesheet_link('css/style.css') }}
		{{ stylesheet_link('css/style-responsive.css') }}
		
		{{ stylesheet_link('plugins/owl-carousel/owl.carousel.css') }}
		
		
		
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
	<body class="tooltips no-padding">
		<div class="wrapper">