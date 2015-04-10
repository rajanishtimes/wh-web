{% block footer %}
</div>
<!-- BEGIN FOOTER -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 extrapaddright">
				<p>We deliver. Get the best of What's HOT Today in your inbox.</p>
				{{ partial('partials/newsletter')}}
				<p><small>You can opt-out at any time. Please refer to our privacy policy for contact information.</small></p>
				<hr style="border-color: #ccc;">
				<div class="social-icon">
					<div class="shareon float-left">
						Share on:
					</div>
					<div class="social_icon facebook float-left"><i class="fa fa-facebook"></i></div>
					<div class="social_icon twitter float-left"><i class="fa fa-twitter"></i></div>
					<div class="social_icon google-plus float-left"><i class="fa fa-google-plus"></i></div>
				</div>
			</div>
			
			<div class="col-sm-6 col-md-2">
				<h4>Our Story</h4>
				<ul class="list">
					<li><a href="index.html">Site Map</a></li>
					<li><a href="index.html">Help</a></li>
					<li><a href="index.html">Carrers</a></li>
					<li><a href="index.html">User Agreement</a></li>
					<li><a href="index.html">Policy</a></li>
					<li><a href="index.html">Patent Info</a></li>
				</ul>
			</div><!-- /.col-sm-4 -->
			<div class="col-sm-6 col-md-3">
				<ul class="list citylist">
					{% for cities in allcities['cities'] %}
						<li><a href="#fakelink">{{cities['name']}}</a></li>
					{% endfor  %}
				</ul>
			</div><!-- /.col-sm-3 -->
			<div class="clearfix visible-sm"></div>
			<div class="col-sm-6 col-md-3 text-right">
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
				{{ elements.getMenu() }}
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