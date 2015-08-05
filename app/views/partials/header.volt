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
					<ul class="dropdown-menu square primary margin-list-rounded with-triangle" id="citieslist">
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
							&#8226;&nbsp;&#8226;&nbsp;&#8226;
						</div>
					</a>
					<ul class="dropdown-menu square primary margin-list-rounded with-triangle" id="citieslist">
						<li>
							Account Setting
						</li>
					</ul>
				</li>
				<li class="resposive-menu">
					<div class="btn-collapse-sidebar-right">
						<i class="fa fa-bars"></i>
					</div>
				</li>
			</ul>

			<ul class="nav-search navbar-right right-responsive-menu">
				<li class="whresposive-menu user-profile-menu">
					<a href="#"><img src="{{baseUrl}}/img/avatar-12.jpg" alt="user" class="img-circle user-profile-img"></a>
				</li>
			</ul>

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

		
		<!-- BEGIN SIDEBAR RIGHT -->
			<div class="sidebar-right sidebar-nicescroller">
				<div class="tab-pane" id="setting-sidebar">
					<ul class="sidebar-menu">
						<li class="static">ACCOUNT SETTING</li>
						<li class="text-content">
							<div class="switch">
								<div class="onoffswitch blank">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="onlinestatus" checked>
									<label class="onoffswitch-label" for="onlinestatus">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							Online status
						</li>
						<li class="text-content">
							<div class="switch">
								<div class="onoffswitch blank">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="offlinecontact" checked>
									<label class="onoffswitch-label" for="offlinecontact">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							Show offline contact
						</li>
						<li class="text-content">
							<div class="switch">
								<div class="onoffswitch blank">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="invisiblemode">
									<label class="onoffswitch-label" for="invisiblemode">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							Invisible mode
						</li>
						<li class="text-content">
							<div class="switch">
								<div class="onoffswitch blank">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="personalstatus" checked>
									<label class="onoffswitch-label" for="personalstatus">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							Show my personal status
						</li>
						<li class="text-content">
							<div class="switch">
								<div class="onoffswitch blank">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="deviceicon">
									<label class="onoffswitch-label" for="deviceicon">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							Show my device icon
						</li>
						<li class="text-content">
							<div class="switch">
								<div class="onoffswitch blank">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="logmessages">
									<label class="onoffswitch-label" for="logmessages">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							Log all message
						</li>
					</ul>
				</div>
			</div>
		<!-- END SIDEBAR RIGHT -->
	</div><!-- /.top-navbar -->
	</div>
</div><!-- /.container -->
</nav>
<!-- END TOP NAVBAR -->
<hr>