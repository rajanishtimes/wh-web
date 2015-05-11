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
		
		<script type="text/javascript">
			var baseUrl = '{{baseUrl}}',_city = '{{city}}',_crrentCity = '{{currentCity}}';
			var server_variables = {
				city: '{{city}}',
				current_city: '{{currentCity}}',
				default_city: '{{defaultCity}}'
			};
		</script>
		
		{% endblock %}
	</head>
	<body class="tooltips no-padding">
		<!-- iframe used for attempting to load a custom protocol -->
		<iframe style="display:none" height="0" width="0" id="loader"></iframe>

		<script>(function(){
			
			// For desktop browser, remember to pass though any metadata on the link for deep linking
			var fallbackLink = '{{canonical_url}}';


			// Simple device detection
			var isiOS = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod'),
				isAndroid = navigator.userAgent.match('Android');

			// Mobile
			if (isiOS || isAndroid) {
				// Load our custom protocol in the iframe, for Chrome and Opera this burys the error dialog (which is actually HTML)
				// for iOS we will get a popup error if this protocol is not supported, but it won't block javascript
				document.getElementById('loader').src = '{{deep_link}}';

				// The fallback link for Android needs to be https:// rather than market:// or the device will try to 
				// load both URLs and only the last one will win. (Especially FireFox, where an "Are You Sure" dialog will appear)
				// on iOS we can link directly to the App Store as our app switch will fire prior to the switch
				// If you have a mobile web app, your fallback could be that instead. 
				fallbackLink = isAndroid ? 'https://play.google.com/store/apps/details?id=com.phdmobi.timescity' :
										 'https://itunes.apple.com/in/app/timescity-food-restaurant/id636515332?mt=8' ;
				window.setTimeout(function (){ window.location.replace(fallbackLink); }, 1);
			}

			// Now we just wait for everything to execute, if the user is redirected to your custom app
			// the timeout below will never fire, if a custom app is not present (or the user is on the Desktop)
			// we will replace the current URL with the fallbackLink (store URL or desktop URL as appropriate)
			


			/*
			  Q&A

			  I have a native desktop app as well, how do I link to a custom protocol handler on the desktop?
				IE Only: http://msdn.microsoft.com/en-us/library/ms537512.aspx#Version_Vectors
				All Other Browsers: Use a custom plugin like iTunes does: http://ax.itunes.apple.com/detection/itmsCheck.js

			*/

			})();
		</script>
		<div class="wrapper">