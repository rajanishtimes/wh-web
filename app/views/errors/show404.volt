{{ get_doctype() }}
<html lang="en">
<head>
		{% block head %}
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		{{ get_title() }}
		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		{{ stylesheet_link('css/bootstrap.min.css') }}
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		{{ stylesheet_link('plugins/font-awesome/css/font-awesome.min.css') }}
		{{ stylesheet_link('css/style.css') }}
		{{ stylesheet_link('css/style-responsive.css') }}
		
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
				<h1>404</h1>
				<div class="text">Oh! No, It&apos;s Raining</div>
				<p>The page you were looking for cannot be found.</p>
				<a href="{{baseUrl}}"><div class="btn btn-primary errorbtn">Go To Home</div></a>
			</div>
			<div class="clearfix"></div>
			<div class="buildings"></div>
		</div>
		
		{{ javascript_include('js/jquery.js') }}
		{{ javascript_include('js/rain.js') }}
    </body>
</html>