<!-- BEGIN TOP NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
	<div class="row">
		<div class="top-navbar">
		<!-- Begin logo -->
		<div class="logo">
			<a href="{{baseUrl}}/{{city}}"><img src="{{baseUrl}}/img/logo.png" alt="WhatsHot"></a>
		</div><!-- /.logo -->
		<!-- End logo -->
		
		
		{% if(controllername == 'search') %}
			<div class="searchbtn float-right active">
				<a href="{{baseUrl}}/{{city}}"><div class="madewidth active"><img src="{{baseUrl}}/img/search_close.png" alt="Go to Home"></div></a>
			</div>
		{% else %}
			<div class="searchbtn float-right">
				<a href="{{baseUrl}}/search/search"><div class="madewidth"><img src="{{baseUrl}}/img/search.png" alt="Search"></div></a>
			</div>
		{% endif %}
		
		<!-- Begin City Nav -->
			<ul class="nav-search navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle makeactive" data-toggle="dropdown">
						<i class="fa fa-map-marker makered"></i>
						{% if(city | trim | lower == 'delhi') %}
							<span>Delhi NCR</span>
						{% elseif(city | trim | lower == 'delhi-ncr' OR city | trim | lower == 'delhi ncr' OR city | trim | lower == 'delhi-ncr') %}
							<span>Delhi NCR</span>
						{% else %}
							<span>{{city | capitalize}}</span>
						{% endif %}
						
						&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu square primary margin-list-rounded with-triangle" id="citieslist">
						{% for cities in allcities['cities'] %}
							{% if(cities['name'] | trim | lower == 'delhi') %}
								<li data-name="delhi"><a href="{{baseUrl}}/delhi">Delhi NCR</a></li>
							{% elseif(cities['name'] | trim | lower == 'delhi-ncr' OR cities['name'] | trim | lower == 'delhi ncr' OR cities['name'] | trim | lower == 'delhincr') %}
								<li data-name="delhi-ncr"><a href="{{baseUrl}}/delhi-ncr">Delhi NCR</a></li>
							{% else %}
								<li data-name="{{elements.create_slug(cities['name']) | trim | lower}}"><a href="{{baseUrl}}/{{elements.create_slug(cities['name']) | trim | lower}}">{{cities['name']}}</a></li>
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