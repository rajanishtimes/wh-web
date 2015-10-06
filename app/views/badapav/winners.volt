<section class="hp vadapav">
	<div class="item item-left"></div>
	<!--<div class="item item-right"></div>-->
	<!--<i class="overlay"></i>-->

	<div class="desc">
		<div class="contestlogo"><img src="{{baseUrl}}/img/bombaytimes-logo.png"></div>
		<div class="contestlogo bhel-logo"><img src="{{baseUrl}}/img/bhel-logo.png"></div>
		<div class="presents">in association with :</div>
		<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
		<a href="#" class="scroll-down img-circle addscroll"><i class="fa fa-angle-down"></i></a>
	</div>
</section>

<section class="hp hp-mobile vadapav">
	<div class="item item-left">
		<div class="desc">
			<div class="contestlogo"><img src="{{baseUrl}}/img/bombaytimes-logo.png"></div>
			<div class="contestlogo  bhel-logo"><img src="{{baseUrl}}/img/bhel-logo.png"></div>
			<div class="presents">in association with :</div>
			<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
			<a href="#" class="scroll-down img-circle addscrollmobile"><i class="fa fa-angle-down"></i></a>
		</div>
		<!--<i class="overlay"></i>-->
	</div>
</section>
<div class="clearfix"></div>
<section id="quizdata" class="quiz_data winnerspage">
	<div class="section">
		<div class="container">
			<div class="row">
				<input type='hidden' value="{{iscontestrunning}}" id="iscontestruning">
				<div class="work-content contest winner contentarea text-center">
						<p class="text-center">Top 10 Bhelpuri joints in Mumbai - 2015</p>
						{{feeds.getcontestwinner(baseUrl, biryaniwinners, start, cityshown, 'bhel')}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
<div class="haleemoverlay"><img src="{{baseUrl}}/img/ajax-loader.gif"></div>