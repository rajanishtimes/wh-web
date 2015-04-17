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
				<h1>Page not found</h1>
				<p>Sorry, you have accesed a page that does not exist or was moved</p>
			</div>
			<div class="clearfix"></div>
			<div class="buildings"></div>
		</div>
		
		{{ javascript_include('js/jquery.js') }}
		{{ javascript_include('js/rain.js') }}
    </body>
</html>