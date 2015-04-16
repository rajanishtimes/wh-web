<!-- BEGIN TOP NAVBAR -->
<div class="container">
	<div class="row">
		<div class="top-navbar">
		<!-- Begin logo -->
		<div class="logo">
			<a href="{{baseUrl}}{{city}}"><img src="{{baseUrl}}img/logo.png" alt="WhatsHot"></a>
		</div><!-- /.logo -->
		<!-- End logo -->
		
		<!-- Begin search nav id="searchbox" -->
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
				  <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown">
					<span>{{city | capitalize}}</span>&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
				  </a>
				  <ul class="dropdown-menu square primary margin-list-rounded with-triangle">
					{% for cities in allcities['cities'] %}
						<li><a href="{{baseUrl}}{{cities['name'] | trim | lower}}">{{cities['name']}}</a></li>
					{% endfor  %}
				  </ul>
				</li>
			</ul>
		<!-- End City Nav -->
		
	</div><!-- /.top-navbar -->
	</div>
</div><!-- /.container -->
<!-- END TOP NAVBAR -->
<hr>