
</div>
<!-- BEGIN FOOTER -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4 extrapaddright">
				<p>We deliver. Get the best of What's HOT Today in your inbox.</p>
				<?php echo $this->partial('partials/newsletter'); ?>
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
			
			<div class="col-xs-12 col-sm-6 col-md-2">
				<h4>Our Story</h4>
				<?php echo $this->elements->getStaticpages(); ?>
			</div><!-- /.col-sm-4 -->
			<div class="col-xs-12 col-sm-6 col-md-3">
				<ul class="list citylist">
					<?php foreach ($allcities['cities'] as $cities) { ?>
						<li><a href="<?php echo $baseUrl; ?><?php echo trim(Phalcon\Text::lower($cities['name'])); ?>"><?php echo $cities['name']; ?></a></li>
					<?php } ?>
				</ul>
			</div><!-- /.col-sm-3 -->
			<div class="clearfix visible-sm"></div>
			<div class="col-xs-12 col-sm-6 col-md-3 text-right">
				<div class="setbottom">
					<div class="app_option">
						<a href=""><div class="iphone_app float-right"></div></a>&nbsp;&nbsp;
						<a href=""><div class="android_app float-right"></div></a>
					</div>
					<img src="<?php echo $baseUrl; ?>img/mobiles.png">
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
				<?php echo $this->elements->getMenu(); ?>
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
