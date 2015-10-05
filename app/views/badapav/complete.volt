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
<section id="quizdata" class="quiz_data vadapav">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="quiz_su text-center">
					<div class="head" style="font-size:21px; padding:0 20px;">Voting is Closed, Winners to be announced on 7<sup>th</sup> October</div><br><br><br>
					<div class="contentarea">
						<div class="detail content" style="padding:0 10px;">
							<p class="text-center"><small>Check Out nominations this year for King of Bhel</small></p>
						</div>
					</div>
				</div><div class="clearfix"></div>

				<input type='hidden' value="{{iscontestrunning}}" id="iscontestruning">
				<div class="work-content contest bhel">
					<div id="biryaninomination" class="bhel">
						<?php $isvotebir = $isvotedbiryani; ?>
						{{feeds.getcontest(baseUrl, biryaninominations, start, cityshown, 'bhel', isvotebir)}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="haleemoverlay"><img src="{{baseUrl}}/img/ajax-loader.gif"></div>

<style type="text/css">
.voted, .voted:hover {
    border: 1px solid #bbb;
    color: #bbb;
}
</style>