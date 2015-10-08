<section class="hp vadapav">
	<div class="item item-left"></div>
	<!--<div class="item item-right"></div>-->
	<!--<i class="overlay"></i>-->

	<div class="desc">
		<div class="contestlogo bhel-logo"><img src="{{baseUrl}}/img/paw-wow.png"></div>
		<div class="presents">in association with :</div>
		<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
		<a href="#" class="scroll-down img-circle addscroll"><i class="fa fa-angle-down"></i></a>
	</div>
</section>

<section class="hp hp-mobile vadapav">
	<div class="item item-left">
		<div class="desc">
			<div class="contestlogo bhel-logo"><img src="{{baseUrl}}/img/paw-wow.png"></div>
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
					<div class="head">Contest Details</div><br>
					<div class="contentarea">
						<div class="detail content">
							<p class="text-center">Calling all Mumbaikers to vote for their favourite Pav Bhaji joint to be proclaimed as the Best Pav Bhaji in Bombay Times Pav Wow Contest 2015. What are you waiting for?. Vote Now!</p>
						</div>
					</div>
				</div><div class="clearfix"></div>

				<input type='hidden' value="{{iscontestrunning}}" id="iscontestruning">
				<div class="work-content contest pavbhaji">
					<div id="biryaninomination" class="pavbhaji">
						<?php $isvotebir = $isvotedbiryani; ?>
						{{feeds.getcontest(baseUrl, biryaninominations, start, cityshown, 'pavbhaji', isvotebir)}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
<!--<hr>
<section class="quiz_data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="past_result">
					<div class="content">
						<div class="col-sm-3 col-md-3 col-xs-12 text-center">
							<img src="{{baseUrl}}/img/biryani_and_haleem_contest_logo.png">						
						</div>
						<div class="col-sm-6 col-md-6 col-xs-12">
							<p>Times Biryani and Haleem contest has been on since last 7 years and it started as an initiative to honor best Biryani and Haleem which are unique only to the Hyderabadi culture. </p>
							<div class="show_past"><a href="#">View past winners of Biryani and Haleem Contest</a></div>
							<div class="past_results" style="display:none">
								<strong>Past winners under Biryani  Category are as follow</strong>
								<p>2011 Winner Hotel Golkonda,  1st Runner up Paradise, 2nd Runner Four Seasons<br>
								2012 Winner Kebabs N Kurries, 1st Runner up ITC Kakatiya Jewel of Nizam, Golconda, 2nd RunnerShah house<br>
								2014 Winner Bawarchi, 1st Runner up Shadab, 2nd Runner Paradise</p><br/>
								<strong>Past winners under Haleem Category are as follow</strong>
								<p>2011 Winner Shah Ghouse, 1st Runner Sarvi,  2nd Runner Pista House<br>
								2012 Winner Paradise, 1st Runner Kholani's, 2nd Runner Sarvi<br>
								2014 Winner Shah Ghouse, 1st Runner Sarvi, 2nd Runner Pista House</p>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-xs-12">
							<div class="freedomlogo">
								Times Biryani & Haleem<br>contest 2015 Presented by<br><br>
								<img src="{{baseUrl}}/img/freedom.png"><br><br>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</section>-->
<div class="haleemoverlay"><img src="{{baseUrl}}/img/ajax-loader.gif"></div>