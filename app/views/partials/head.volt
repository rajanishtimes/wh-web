{{ get_doctype() }}
<html lang="en">
<head>
		{% block head %}
		<link rel="shortcut icon" type="image/png" href="{{baseUrl}}/favicon.png"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		{% if meta_description != '' %}
			<meta name="description" content="{{ meta_description }}" />
		{% endif  %}
		{% if meta_keywords != '' %}
			<meta name="keywords" content="{{ meta_keywords }}" />
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
		
		<meta name="twitter:card" content="summary" />
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
		
		{% if(tagsfeedscount is defined) %}
			{% if(tagsfeedscount == 0) %}
				<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
			{% endif  %}
		{% endif  %}
		
		{% if(searchresultcount is defined) %}
			{% if(searchresultcount == 0) %}
				<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
			{% endif  %}
		{% endif  %}
		
		{% if(eventscount is defined) %}
			{% if(eventscount == 0) %}
				<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
			{% endif  %}
		{% endif  %}
		
		{% if(locationresultcount is defined) %}
			{% if(locationresultcount == 0) %}
				<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
			{% endif  %}
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
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/plugins/owl-carousel/owl.theme.css" />
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/plugins/swipebox/src/css/swipebox.css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		{% if canonical_url != '' AND deep_link != '' %}
			<script type="application/ld+json">
			{
			  "@context": "http://schema.org", 
			  "@type": "WebPage", 
			  "@id": "{{canonical_url}}", 
			  "potentialAction": {
				"@type": "ViewAction", 
				"target": "{{deep_link}}"
			  }
			}
			</script>
		{% endif  %}
		
		<script type="text/javascript">
			var baseUrl = '{{baseUrl}}',_city = '{{city}}',_crrentCity = '{{currentCity}}';
			var server_variables = {
				city: '{{city}}',
				current_city: '{{currentCity}}',
				default_city: '{{defaultCity}}',
				controllername: '{{controllername}}',
				actionname: '{{actionname}}',
				request_uri: '{{request_uri}}',
			};
		</script>
		
		{% endblock %}
	</head>
	<body class="tooltips no-padding">
		<!-- iframe used for attempting to load a custom protocol -->
		<iframe style="display:none" height="0" width="0" id="loader"></iframe>

		<script>
			(function(){
				var isiOS = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod'),
					isAndroid = navigator.userAgent.match('Android');
					
				if(baseUrl != 'http://www.whatshot.in'){
					if (isiOS || isAndroid) {
						document.getElementById('loader').src = '{{deep_link}}';
						fallbackLink = isAndroid ? 'https://play.google.com/store/apps/details?id=com.phdmobi.timescity' :
												 'https://itunes.apple.com/in/app/timescity-food-restaurant/id636515332?mt=8' ;
						window.setTimeout(function (){
								//window.location.replace(fallbackLink);
								setheader();
						}, 1);
					}
				}
			})();			
		</script>
		<div class="wrapper">