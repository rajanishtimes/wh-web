{{ get_doctype() }}
<html lang="en">
<head>
		{% block head %}
		<link rel="shortcut icon" type="image/png" href="{{baseUrl}}/favicon.png"/>
		<meta name="apple-touch-icon" type="image/png" href="{{baseUrl}}/favicon.png">
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<meta http-equiv="X-Frame-Options" content="sameorigin">
		<meta name="apple-mobile-web-app-capable" content="yes" />
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

		{% if (deep_link != '') %}
			{% if(controllername != 'venue' AND controllername != 'location' AND controllername != 'critic') %}
				<?php $deepl = explode('://', $deep_link); ?>
				<link rel="alternate" href="android-app://com.phdmobi.timescity/{{deepl[0]}}/{{deepl[1]}}" />
				<!--<link rel="alternate" href="{{deep_link}}" />-->
			{% endif  %}
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

		<link rel='alternate' type='application/rss+xml' title='RSS' href='{{baseUrl}}/{{city}}/feed'>

		{% if meta_og_author != '' %}
			<meta name="author" content="{{meta_og_author}}">
		{% endif  %}

	    <meta name="apple-itunes-app" content="app-id=636515332">
		<meta name="google-play-app" content="app-id=com.phdmobi.timescity">
		
		{{ get_title() }}
		
		
		<?php if($this->config->application->environment == 'local'){?>
			{{ assets.outputCss('header') }}
			{{ assets.outputCss('main') }}
		<?php } ?>

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/css/header.css" />
		{% if(controllername == 'quiz' or controllername == 'tfa' or controllername == 'badapav'  or controllername == 'pavbhaji') %}
			<link rel="stylesheet" type="text/css" href="{{baseUrl}}{{elements.auto_version('/css/quiz.css')}}" />
		{% endif %}
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}{{elements.auto_version('/css/main.css')}}" />

		
		
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
	
		<?php
			if(empty($logged_user)){
				$islogin = 0;
			}else{
				$islogin = 1;
			}
		?>

		<script type="text/javascript">
			var baseUrl = '{{baseUrl}}',_city = '{{city}}',_crrentCity = '{{currentCity}}';
			var server_variables = {
				city: '{{city}}',
				current_city: '{{currentCity}}',
				default_city: '{{defaultCity}}',
				controllername: '{{controllername}}',
				actionname: '{{actionname}}',
				request_uri: '{{request_uri}}',
				entityid: '{{entityid}}',
				entitytype: '{{entitytype}}',
				deep_link: '{{deep_link}}',
				facebook_app_id: '<?php echo $this->config->facebook->appId; ?>',
				fbPermissions: '<?php echo $this->config->facebook->fbPermissions; ?>',
				wishlistname : '<?php echo $this->config->application->wishlistname; ?>',
				islogin: '<?php echo $islogin; ?>'
			};
		</script>

		<?php
			/*$ua = $_SERVER["HTTP_USER_AGENT"];
			$issafari = strpos($ua, 'Safari') ? true : false;
			$ischrome = strpos($ua, 'Chrome') ? true : false;
			$isiPhone = strpos($ua, 'iPhone') ? true : false;
			$isAndroid = strpos($ua, 'Android') ? true : false;

			if(($issafari == true && $ischrome == false) || $isiPhone == true || ($issafari == true && $ischrome == true && $isAndroid == true)){
				//echo "<style>.dropdown-menu{display:none;}</style>";
			}*/
		?>

		{% endblock %}
	</head>
	<body class="tooltips no-padding">
		<!-- Begin comScore Tag -->
		<script>
		  var _comscore = _comscore || [];
		  _comscore.push({ c1: "2", c2: "6036484" });
		  (function() {
		    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
		    s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
		    el.parentNode.insertBefore(s, el);
		  })();
		</script>
		<noscript>
		  <img src="http://b.scorecardresearch.com/p?c1=2&c2=6036484&cv=2.0&cj=1" />
		</noscript>
		<!-- End comScore Tag -->

		<?php //echo $ua = $_SERVER["HTTP_USER_AGENT"]; exit;?>
		<!-- iframe used for attempting to load a custom protocol -->
		<iframe style="display:none" height="0" width="0" id="loader"></iframe>

		
		<div class="wrapper">