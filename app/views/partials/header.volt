<!-- BEGIN TOP NAVBAR -->
<div class="container">
	<div class="row">
		<div class="top-navbar">
		<!-- Begin logo -->
		<div class="logo">
			<a href="{{baseUrl}}"><img src="{{baseUrl}}img/logo.png" alt="WhatsHot"></a>
		</div><!-- /.logo -->
		<!-- End logo -->
		
		<!-- Begin search nav -->
		<div id="searchbox" class="nav-right-info">
			<form role="form">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
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
						<li><a href="#fakelink">{{cities['name']}}</a></li>
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