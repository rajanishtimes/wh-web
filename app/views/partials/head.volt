{{ get_doctype() }}
<html lang="en">
<head>
		{% block head %}
		<link rel="shortcut icon" type="image/png" href="{{baseUrl}}/favicon.png"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		{% if meta_description != '' %}
			<meta name="description" content="{{ meta_description }}">
		{% endif  %}
		{% if meta_keywords != '' %}
			<meta name="keywords" content="{{ meta_keywords }}">
		{% endif  %}		
		{% if og_title != '' %}
			<meta property="og:title" content="{{og_title}}" />
		{% endif  %}
		{% if og_description != '' %}
			<meta property="og:description" content="{{og_description}}" />
		{% endif  %}
		{% if og_site_name != '' %}
			<meta property="og:site_name" content="{{og_site_name}}" />
		{% endif  %}
		{% if og_type != '' %}
			<meta property="og:type" content="{{og_type}}" />
		{% endif  %}
		{% if og_url != '' %}
			<meta property="og:url" content="{{og_url}}" />
		{% endif  %}
		{% if og_image != '' %}
			<meta property="og:image" content="{{og_image}}" />
		{% endif  %}
		
		{% if og_site_name != '' %}
			<meta name="twitter:card" content="og_site_name" />
		{% endif  %}
		{% if og_title != '' %}
		<meta name="twitter:title" content="{{og_title}}" />
		{% endif  %}
		{% if og_description != '' %}
		<meta name="twitter:description" content="{{og_description}}" />
		{% endif  %}
		{% if og_image != '' %}
		<meta name="twitter:image" content="{{og_image}}" />
		{% endif  %}
		{% if canonical_url != '' %}
		<link rel="canonical" href="{{canonical_url}}" />
		{% endif  %}
		{% if deep_link != '' %}
		<link rel="alternate" href="{{deep_link}}" />
		{% endif  %}
		
		
		{{ get_title() }}
		
		{% if(isdebug == 'debug') %}
			<?php $time = '?'.time();?>
		{% else %}
			<?php $time = '';?>
		{% endif %}
		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/css/bootstrap.min.css" />
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/plugins/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/css/style.css{{time}}" />
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/css/style-responsive.css{{time}}" />
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/plugins/owl-carousel/owl.carousel.css" />
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/plugins/swipebox/src/css/swipebox.css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
			var baseUrl = '{{baseUrl}}';
		</script>
		
		{% endblock %}
	</head>
	<body class="tooltips no-padding">
		<div class="wrapper">