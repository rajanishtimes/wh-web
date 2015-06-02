{% block footer %}
</div>
<!-- BEGIN FOOTER -->
<footer>
	<div class="container">
		<div class="row">
			<!--<div class="col-xs-12 col-sm-6 col-md-3 extrapaddright">
				<p>We deliver. Get the best of What's HOT Today in your inbox.</p>
				{{ partial('partials/newsletter')}}
				<p><small>You can opt-out at any time. Please refer to our privacy policy for contact information.</small></p>
				<hr style="border-color: #ccc;">
				<div class="social-icon">
					<div class="social_icon facebook float-left"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></div>
					<div class="social_icon twitter float-left"><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></div>
					<div class="social_icon google-plus float-left"><a target="_blank" href="#"><i class="fa fa-google-plus"></i></a></div>
				</div>
			</div>-->
			
			<div class="col-xs-12 col-sm-6 col-md-3">
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
			
			<!--<div class="col-xs-12 col-sm-6 col-md-2">
				<h2 class="footerstyle">MOST POPULAR</h2>
				<ul class="list">
					
				</ul>
			</div>-->
			
			
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
						<a href="#"><div class="iphone_app float-right"></div></a>&nbsp;&nbsp;
						<a href="https://play.google.com/store/apps/details?id=com.phdmobi.timescity" target="_blank"><div class="android_app float-right"></div></a>
					</div>
					<img src="{{baseUrl}}/img/footer_app.png">
				</div>
			</div><!-- /.col-sm-2 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
	<div class="clearfix"></div>
</footer><!-- /.section -->

<div id="fb-root"></div>

<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xs-12 text-left">
				<div class="social-share-widget">
					<div class="fb-like" data-href="https://www.whatshot.com" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
				</div>
				
				<div class="social-share-widget">
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.whatshot.in">Tweet</a>
				</div>
				

				<!-- Place this tag where you want the share button to render. -->
				<div class="social-share-widget">
					<div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://www.whatshot.in"></div>
				</div>
				
			</div>
			<div class="col-sm-6 col-xs-12 text-right lineheight">
				&copy; 2015 <a href="{{baseUrl}}">WhatsHot.in</a> &ndash; all rights reserved
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
{% endblock %}