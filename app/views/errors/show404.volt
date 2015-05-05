{{ get_doctype() }}
<html lang="en">
<head>
		{% block head %}
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Page Not Found | WhatsHot</title>
		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/css/bootstrap.min.css" />
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/plugins/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/css/style.css" />
		<link rel="stylesheet" type="text/css" href="{{baseUrl}}/css/style-responsive.css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		{% endblock %}
	</head>
	<body class="tooltips no-padding errorpage">
		<div class="wrapper">
			<section class="rain"></section>
			<div class="cloud"></div>
			<div class="clearfix"></div>
			<div class="box404">
				<h1>Doh!</h1>
				<div class="text">What you were looking for is not available.</div>
				<p>Check below instead.</p>
				<a href="{{baseUrl}}/"><div class="btn btn-primary errorbtn">TAKE ME HOME</div></a>
			</div>
			<div class="clearfix"></div>
			<div class="buildings"></div>
		</div>
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/rain.js"></script>
    </body>
</html>