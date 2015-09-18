{% block footer %}
</div>
<!-- BEGIN FOOTER -->
<div class="clearfix"></div>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="foot_head">
					<div class="foot_head1">What's Hot on the go!</div>
					<div class="foot_head2">Discover new Events, Restaurents & curated Articles in your city.</div>
					<div class="app_option large">
						<a href="https://play.google.com/store/apps/details?id=com.phdmobi.timescity" target="_blank"><div class="android_app_large float-left"></div></a>&nbsp;&nbsp;
						<a href="https://itunes.apple.com/in/app/timescity-food-restaurant/id636515332?mt=8" target="_blank"><div class="iphone_app_large float-left"></div></a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 text-right">
				<img src="{{baseUrl}}/img/mobile-foot.png">
			</div>
		</div><!-- /.row -->
	</div><!-- /.container -->
	<div class="clearfix"></div>
</footer><!-- /.section -->

<!--<div class="col-xs-12 col-sm-6 col-md-3">
	<h2 class="footerstyle">COMPANY</h2>
	{{ elements.getStaticpages(baseUrl, city) }}
	{% if(isdeep_link == true) %}
		&nbsp;&nbsp;<li class="view_on_app text-left" style="display:none">See In App</li>
	{% endif %}
</div>
<div class="col-xs-12 col-sm-6 col-md-3">
	<h2 class="footerstyle">WHAT'S HOT IN</h2>
	<ul class="list">
		{% for cities in allcities['cities'] %}
			{% if(cities['name'] | trim | lower == 'delhi') %}
				<li><a href="{{baseUrl}}/delhi">Delhi NCR</a></li>
			{% elseif(cities['name'] | trim | lower == 'delhi-ncr' OR cities['name'] | trim | lower == 'delhi ncr' OR cities['name'] | trim | lower == 'delhi-ncr') %}
				<li><a href="{{baseUrl}}/delhi-ncr">Delhi NCR</a></li>
			{% else %}
				<li><a href="{{baseUrl}}/{{cities['name']|lower|trim}}">{{cities['name']}}</a></li>
			{% endif %}
		{% endfor  %}
	</ul>
</div>
<div class="col-xs-12 col-sm-6 col-md-3">
	<h2 class="footerstyle">TOP EVENTS</h2>
	<ul class="list">
		{% for cities in allcities['cities'] %}
			{% if(cities['name'] | trim | lower == 'delhi') %}
				<li><a href="{{baseUrl}}/delhi/events">Events in Delhi NCR</a></li>
			{% elseif(cities['name'] | trim | lower == 'delhi-ncr' OR cities['name'] | trim | lower == 'delhi ncr' OR cities['name'] | trim | lower == 'delhi-ncr') %}
				<li><a href="{{baseUrl}}/delhi-ncr/events">Events in Delhi NCR</a></li>
			{% else %}
				<li><a href="{{baseUrl}}/{{cities['name']|lower|trim}}/events">Events in {{cities['name']}}</a></li>
			{% endif %}
		{% endfor  %}
	</ul>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 text-right">
	<div class="setbottom">
		<div class="app_option">
			<a href="https://itunes.apple.com/in/app/timescity-food-restaurant/id636515332?mt=8" target="_blank"><div class="iphone_app float-right"></div></a>&nbsp;&nbsp;
			<a href="https://play.google.com/store/apps/details?id=com.phdmobi.timescity" target="_blank"><div class="android_app float-right"></div></a>
		</div>
		<img src="{{baseUrl}}/img/footer_app.png">
	</div>
</div><!-- /.col-sm-2 -->
<?php  //echo "<pre>"; print_r($dataforfooter); echo "</pre>"; exit;?>
<div class="footer">
	<div class="container">
		<div class="row">
			<div class="makeblock">
				<div class="col-sm-2 col-xs-12 text-left">
					<div class="footer_list_head">Latest Stories</div>
				</div>
				<div class="col-sm-10 col-xs-12 text-left">
					<ul class="list-inline makebullet">
						{% for lateststoriesfeeds in dataforfooter.lateststoriesfeeds.results %}
							<li><a href="{{baseUrl}}{{lateststoriesfeeds.url}}">{{lateststoriesfeeds.title}}</a></li>
						{% endfor  %}
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="makeblock">
				<div class="col-sm-2 col-xs-12 text-left">
					<div class="footer_list_head">Event Today</div>
				</div>
				<div class="col-sm-10 col-xs-12 text-left">
					<ul class="list-inline makebullet">
						{% for todaysfeed in dataforfooter.todaysfeeds.results %}
							<li><a href="{{baseUrl}}{{todaysfeed.url}}">{{todaysfeed.title}}</a></li>
						{% endfor  %}
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="makeblock">
				<div class="col-sm-2 col-xs-12 text-left">
					<div class="footer_list_head">Upcoming Events</div>
				</div>
				<div class="col-sm-10 col-xs-12 text-left">
					<ul class="list-inline makebullet">
						{% for upcomingfeed in dataforfooter.upcomingfeeds.results %}
							<li><a href="{{baseUrl}}{{upcomingfeed.url}}">{{upcomingfeed.title}}</a></li>
						{% endfor  %}
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="makeblock">
				<div class="col-sm-2 col-xs-12 text-left">
					<div class="footer_list_head">Top Events</div>
				</div>
				<div class="col-sm-10 col-xs-12 text-left">
					<ul class="list-inline makebullet">
						{% for cities in allcities['cities'] %}
							{% if(cities['name'] | trim | lower == 'delhi') %}
								<li><a href="{{baseUrl}}/delhi/events">Events in Delhi NCR</a></li>
							{% elseif(cities['name'] | trim | lower == 'delhi-ncr' OR cities['name'] | trim | lower == 'delhi ncr' OR cities['name'] | trim | lower == 'delhi-ncr') %}
								<li><a href="{{baseUrl}}/delhi-ncr/events">Events in Delhi NCR</a></li>
							{% else %}
								<li><a href="{{baseUrl}}/{{cities['name']|lower|trim}}/events">Events in {{cities['name']}}</a></li>
							{% endif %}
						{% endfor  %}
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="makeblock">
				<div class="col-sm-2 col-xs-12 text-left">
					<div class="footer_list_head">What'sHot.in</div>
				</div>
				<div class="col-sm-10 col-xs-12 text-left">
					<ul class="list-inline makebullet">
						{% for cities in allcities['cities'] %}
							{% if(cities['name'] | trim | lower == 'delhi') %}
								<li><a href="{{baseUrl}}/delhi">Delhi NCR</a></li>
							{% elseif(cities['name'] | trim | lower == 'delhi-ncr' OR cities['name'] | trim | lower == 'delhi ncr' OR cities['name'] | trim | lower == 'delhi-ncr') %}
								<li><a href="{{baseUrl}}/delhi-ncr">Delhi NCR</a></li>
							{% else %}
								<li><a href="{{baseUrl}}/{{cities['name']|lower|trim}}">{{cities['name']}}</a></li>
							{% endif %}
						{% endfor  %}
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div id="fb-root"></div>
		<div class="row">
			<div class="col-xs-12 text-center social-group">
				<div class="social-share-widget">
					<div class="fb-like" data-href="https://www.facebook.com/whatshot?fref=ts" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
				</div>
				<div class="social-share-widget">
					<a href="https://twitter.com/WhatsHot_IN" class="twitter-follow-button" data-show-count="false">Follow @WhatsHot_IN</a>
				</div>
				<!-- Place this tag where you want the share button to render. -->
				<div class="social-share-widget">
					<div class="g-plus" data-action="share" data-annotation="bubble" data-href="https://plus.google.com/u/0/+timescity/posts"></div>
				</div>
			</div>
			<div class="col-xs-12 text-center margin-top-40">
				{{ elements.getStaticpages(baseUrl, city) }}
			</div>
			<div class="col-xs-12 text-center lineheight">
				&copy; 2015 <a href="{{baseUrl}}">WhatsHot.in</a> &ndash; Indiatimes Lifestyle Network. All rights reserved.
			</div><!-- /.col-sm-5 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
	<div class="clearfix"></div>
</div><!-- /.footer -->
<!-- END FOOTER -->


<!-- BEGIN BACK TO TOP BUTTON -->
<div id="back-top">
	<i class="fa fa-angle-up fa-stack-1x fa-inverse"></i>
</div>
<!-- END BACK TO TOP -->


<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
    FB.init({
        appId: '<?php echo $this->config->facebook->appId; ?>',
        cookie: true,xfbml: true,
        oauth: true,
        version: 'v2.4'
        });
    };
(function() {
    var e = document.createElement('script');
    e.async = true;e.src = document.location.protocol +'//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);}());
</script>

{% endblock %}