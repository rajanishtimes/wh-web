{% block footer %}
</div>
<!-- BEGIN FOOTER -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4 extrapaddright">
				<p>We deliver. Get the best of What's HOT Today in your inbox.</p>
				{{ partial('partials/newsletter')}}
				<p><small>You can opt-out at any time. Please refer to our privacy policy for contact information.</small></p>
				<hr style="border-color: #ccc;">
				<div class="social-icon">
					<div class="shareon float-left">
						Share on:
					</div>
					<div class="social_icon facebook float-left"><a target="_blank" href="{{constants['constants']['facebook_url']}}"><i class="fa fa-facebook"></i></a></div>
					<div class="social_icon twitter float-left"><a target="_blank" href="{{constants['constants']['twitter_url']}}"><i class="fa fa-twitter"></i></a></div>
					<div class="social_icon google-plus float-left"><a target="_blank" href="{{constants['constants']['google_url']}}"><i class="fa fa-google-plus"></i></a></div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6 col-md-2">
				{{ elements.getStaticpages(baseUrl) }}
			</div><!-- /.col-sm-4 -->
			<div class="col-xs-12 col-sm-6 col-md-3">
				<ul class="list citylist">
					{% for cities in allcities['cities'] %}
						{% if(cities['name'] | trim | lower == 'delhi') %}
							<li><a href="{{baseUrl}}{{cities['name']|lower|trim}}">Delhi NCR</a></li>
						{% else %}
							<li><a href="{{baseUrl}}{{cities['name']|lower|trim}}">{{cities['name']}}</a></li>
						{% endif %}
					{% endfor  %}
				</ul>
			</div><!-- /.col-sm-3 -->
			<div class="clearfix visible-sm"></div>
			<div class="col-xs-12 col-sm-6 col-md-3 text-right">
				<div class="setbottom">
					<div class="app_option">
						<a href=""><div class="iphone_app float-right"></div></a>&nbsp;&nbsp;
						<a href=""><div class="android_app float-right"></div></a>
					</div>
					<img src="{{baseUrl}}img/mobiles.png">
				</div>
			</div><!-- /.col-sm-2 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</footer><!-- /.section -->

<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				&copy; 2015 <a href="#fakelink">WhatsHot.com</a> &ndash; all rights reserved.
			</div><!-- /.col-sm-5 -->
			<div class="col-sm-7 text-right">
				{{ elements.getMenu(baseUrl) }}
			</div><!-- /.col-sm-7 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.footer -->
<!-- END FOOTER -->


<!-- BEGIN BACK TO TOP BUTTON -->
<div id="back-top">
	<i class="fa fa-chevron-up"></i>
</div>
<!-- END BACK TO TOP -->
{% endblock %}