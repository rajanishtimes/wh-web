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
<input id="ac-gn-menustate" class="ac-gn-menustate" type="checkbox">
<nav id="navbar-fixed-top" class="navbar navbar-default navbar-fixed-top makeheaderintera">
<div class="container">
	<div class="row">
		<div class="top-navbar">
			<!-- Begin logo -->
			<!--<div class="logo">
				<a href="{{baseUrl}}/{{city}}"><img src="{{baseUrl}}/img/logo03072015.png" alt="WhatsHot"></a>
			</div>-->
			<div class="logo logo2">
				<a href="{{baseUrl}}/{{city}}"><img src="{{baseUrl}}/img/logo_white03072015.png" alt="WhatsHot"></a>
			</div>
			<!-- /.logo -->

			<!-- Begin City Nav -->
			<ul class="nav-search navbar-right navbar-left">
				<li class="dropdown cities-dd">
					<a href="#" class="dropdown-toggle makeactive" data-toggle="dropdown">
						{% if(currentCity | trim | lower == 'delhi') %}
							<span>Delhi NCR</span>
						{% elseif(currentCity | trim | lower == 'delhi-ncr' OR currentCity | trim | lower == 'delhi ncr' OR currentCity | trim | lower == 'delhi-ncr') %}
							<span>Delhi NCR</span>
						{% else %}
							<span>{{currentCity | capitalize}}</span>
						{% endif %}
						&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-down down-icon"></i>
					</a>
					<ul class="dropdown-menu square primary margin-list-rounded fancy-dropdown" id="citieslist">
						{% for cities in allcities['cities'] %}
							{% if(cities['name'] | trim | lower == 'delhi') %}
								<li data-name="delhi"><a href="{{baseUrl}}/delhi" <?php echo (($currentCity == 'delhi') ? 'class="active"' : ''); ?>>Delhi NCR</a></li>
							{% elseif(cities['name'] | trim | lower == 'delhi-ncr' OR cities['name'] | trim | lower == 'delhi ncr' OR cities['name'] | trim | lower == 'delhincr') %}
								<li data-name="delhi-ncr"><a href="{{baseUrl}}/delhi-ncr" <?php echo (($currentCity == 'delhi-ncr') ? 'class="active"' : ''); ?>>Delhi NCR</a></li>
							{% else %}
								<li data-name="{{elements.create_slug(cities['name']) | trim | lower}}"><a href="{{baseUrl}}/{{elements.create_slug(cities['name']) | trim | lower}}" <?php echo ((strtolower($currentCity) == strtolower($cities['name'])) ? 'class="active"' : ''); ?>>{{cities['name']}}</a></li>
							{% endif %}
						{% endfor  %}
					</ul>
				</li>
			</ul>
			<!-- End City Nav -->

			<ul class="nav-search navbar-right right-responsive-menu">
				<li class="dropdown whresposive-menu">
					<a href="#" class="dropdown-toggle makeactive ellipses" data-toggle="dropdown">
						<div class="btn-collapse-sidebar-right">
							&#8226;&#8226;&#8226;
						</div>
					</a>
					<ul class="dropdown-menu square primary margin-list-rounded fancy-dropdown" id="citieslist">
						<li><a href="{{baseUrl}}/about-us">About us</a></li>
						<li><a href="{{baseUrl}}/policy">Privacy</a></li>
						<li><a href="{{baseUrl}}/terms">Terms</a></li>
						{% if(logged_user is empty) %}
							
						{% else %}
							<li><a href="{{baseUrl}}/profile/logout">Logout</a></li>
						{% endif %}

					</ul>
				</li>
				<!--<li class="resposive-menu">
					<div class="btn-collapse-sidebar-right">
						<i class="fa fa-bars"></i>
					</div>
				</li>-->
				<li class="resposive-menu ac-gn-item ac-gn-menuicon">
					<label class="ac-gn-menuicon-label" for="ac-gn-menustate" aria-hidden="true"> <span class="ac-gn-menuicon-bread ac-gn-menuicon-bread-top">
							<span class="ac-gn-menuicon-bread-crust ac-gn-menuicon-bread-crust-top"></span> </span> <span class="ac-gn-menuicon-bread ac-gn-menuicon-bread-bottom">
							<span class="ac-gn-menuicon-bread-crust ac-gn-menuicon-bread-crust-bottom"></span> </span>
					</label>
				</li>
			</ul>


			
			

			<ul class="nav-search navbar-right right-responsive-menu">
				<li class="whresposive-menu user-profile-menu">
					<a href="{{baseUrl}}/profile">
					{% if(logged_user is empty) %}
						<img src="{{baseUrl}}/img/looksy.jpg" alt="user" class="img-circle user-profile-img">
					{% else %}
						<img src="{{logged_user.image}}" alt="user" class="img-circle user-profile-img">
					{% endif %}
					</a>
				</li>
			</ul>

			{% if(controllername == 'search') %}
				<!--<div class="searchbtn searchpage float-right active">
					<a href="{{baseUrl}}/{{currentCity}}"><div class="madewidth active"><div class="searchclose"></div></div></a>
				</div>-->
			{% else %}
					<div class="searchbtn  float-right">
						<a href="{{baseUrl}}/{{currentCity}}/search/search"><div class="madewidth">
							<img src="{{baseUrl}}/img/search.png" alt="Search" id="search1">
							<img src="{{baseUrl}}/img/search_white.png" alt="Search" id="search2">
					</div></a>
				</div>
			{% endif %}

		<!-- BEGIN SIDEBAR RIGHT -->
		<ul class="ac-gn-list">
			<li class="ac-gn-item ac-gn-item-menu header">
				<a href="{{baseUrl}}/profile">
				{% if(logged_user is empty) %}
					<img src="{{baseUrl}}/img/looksy.jpg" alt="user" class="img-circle user-profile-img">&nbsp; <span class="ac-gn-link-text">You</span>
				{% else %}
					<img src="{{logged_user.image}}" alt="user" class="img-circle user-profile-img">&nbsp; <span class="ac-gn-link-text">{{logged_user.firstname}} {{logged_user.lastname}}</span>
				{% endif %}
				</a>
			</li>
			<li class="ac-gn-item ac-gn-item-menu"><a href="{{baseUrl}}/about-us"><span class="ac-gn-link-text">About us</span></a></li>
			<li class="ac-gn-item ac-gn-item-menu"><a href="{{baseUrl}}/policy"><span class="ac-gn-link-text">Privacy</span></a></li>
			<li class="ac-gn-item ac-gn-item-menu"><a href="{{baseUrl}}/terms"><span class="ac-gn-link-text">Terms</span></a></li>
			{% if(logged_user is empty) %}
			{% else %}
				<li class="ac-gn-item ac-gn-item-menu"><a href="{{baseUrl}}/profile/logout">Logout</a></li>
			{% endif %}
		</ul>
		<!-- END SIDEBAR RIGHT -->
	</div><!-- /.top-navbar -->
	</div>
</div><!-- /.container -->
</nav>
<!-- END TOP NAVBAR -->
<hr>