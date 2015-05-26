<?php if($isappclose == 0){ ?>
<div id="installer">
	<div id="iphone" class="row">
		<div class="col-xs-8 col-md-6 left-side">
			<i class="fa fa-times float-left close-time" onclick="closebanner()"></i>
			<img src="{{baseUrl}}/img/whatshot-l.jpg" class="float-left setmargin">
			<div class="float-left setmargin">for <span id="devicetype">IOS</span></div>
		</div>
		<div class="col-xs-4 col-md-6 text-right">
			<span class="input-group-btn installbtn">
				<a href="https://itunes.apple.com/in/app/timescity-food-restaurant/id636515332?mt=8"><button class="btn btn-primary" type="button">Install App</button></a>
			</span>
		</div>
	</div>
	<div id="android" class="row">
		<div class="col-xs-8 col-md-6 left-side">
			<i class="fa fa-times float-left close-time" onclick="closebanner()"></i>
			<img src="{{baseUrl}}/img/whatshot-l.jpg" class="float-left setmargin">
			<div class="float-left setmargin">for <span id="devicetype">Android</span></div>
		</div>
		<div class="col-xs-4 col-md-6 text-right">
			<span class="input-group-btn installbtn">
				<a href="https://play.google.com/store/apps/details?id=com.phdmobi.timescity"><button class="btn btn-primary" type="button">Install App</button></a>
			</span>
		</div>
	</div>
</div>
<?php } ?>
<!-- BEGIN TOP NAVBAR -->
<nav id="navbar-fixed-top" class="navbar navbar-default navbar-fixed-top">
<div class="container">
	<div class="row">
		<div class="top-navbar">
		<!-- Begin logo -->
		<div class="logo">
			<a href="{{baseUrl}}/{{city}}"><img src="{{baseUrl}}/img/logo.png" alt="WhatsHot"></a>
		</div>
		<div class="logo logo2">
			<a href="{{baseUrl}}/{{city}}"><img src="{{baseUrl}}/img/logo_white.png" alt="WhatsHot"></a>
		</div>
		<!-- /.logo -->
		<!-- End logo -->
		
		
		{% if(controllername == 'search') %}
			<div class="searchbtn searchpage float-right active">
				<a href="{{baseUrl}}/{{currentCity}}"><div class="madewidth active"><div class="searchclose"></div></div></a>
			</div>
		{% else %}
				<div class="searchbtn  float-right">
					<a href="{{baseUrl}}/{{currentCity}}/search/search"><div class="madewidth">
						<img src="{{baseUrl}}/img/search.png" alt="Search" id="search1">
						<img src="{{baseUrl}}/img/search_white.png" alt="Search" id="search2">
				</div></a>
			</div>
		{% endif %}
		
		<!-- Begin City Nav -->
			<ul class="nav-search navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle makeactive" data-toggle="dropdown">
						<span class	="youarehere">Discover In</span>
						{% if(currentCity | trim | lower == 'delhi') %}
							<span>Delhi NCR</span>
						{% elseif(currentCity | trim | lower == 'delhi-ncr' OR currentCity | trim | lower == 'delhi ncr' OR currentCity | trim | lower == 'delhi-ncr') %}
							<span>Delhi NCR</span>
						{% else %}
							<span>{{currentCity | capitalize}}</span>
						{% endif %}
						
						&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-down down-icon"></i>
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