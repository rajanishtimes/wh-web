<!-- BEGIN TOP NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
	<div class="row">
		<div class="top-navbar">
		<!-- Begin logo -->
		<div class="logo">
			<a href="{{baseUrl}}{{city}}"><img src="{{baseUrl}}img/logo.png" alt="WhatsHot"></a>
		</div><!-- /.logo -->
		<!-- End logo -->
		
		<div class="searchbtn float-right"><a href="{{baseUrl}}search/search"><img src="{{baseUrl}}img/search.png"></a></div>
		<!-- Begin search nav id="searchbox" --
		<div id="searchboxmakeoverlay" class="nav-right-info">
			<form id="searchForm" method="POST" action="/search/search">
				<div id="expandable" class="input-group">
					<div id="searchinputform" class="textinput float-left"><input type="text" class="form-control" placeholder="Search..." id="searchtextinput" name="search"></div>
					<div class="searchinout float-right"><button class="input-group-addon"><i class="fa fa-search"></i></button></div>
				</div>
			</form>
		</div>
		<!-- End search nav -->
		
		<!-- Begin City Nav -->
			<ul class="nav-search navbar-right">
				<li class="dropdown">
					<i class="fa fa-map-marker makered"></i>
					<a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown">
						{% if(city | trim | lower == 'delhi') %}
							<span>Delhi NCR</span>
						{% else %}
							<span>{{city | capitalize}}</span>
						{% endif %}
						
						&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu square primary margin-list-rounded with-triangle">
						{% for cities in allcities['cities'] %}
							{% if(cities['name'] | trim | lower == 'delhi') %}
								<li><a href="{{baseUrl}}{{cities['name'] | trim | lower}}">Delhi NCR</a></li>
							{% else %}
								<li><a href="{{baseUrl}}{{cities['name'] | trim | lower}}">{{cities['name']}}</a></li>
							{% endif %}
						{% endfor  %}
					</ul>
				</li>
			</ul>
		<!-- End City Nav -->
		
	</div><!-- /.top-navbar -->
	</div>
</div><!-- /.container -->
</nav>
<!-- END TOP NAVBAR -->
<hr>