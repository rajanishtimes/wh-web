<section class="hp">
	<div class="item item-left"></div>
	<div class="item item-right"></div>
	<i class="overlay"></i>

	<div class="desc">
		<div class="contestlogo"><img src="{{baseUrl}}/img/biryani_and_haleem_contest_logo.png"></div>
		<div class="presents"><img src="{{baseUrl}}/img/presents.png"></div>
		<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
		<a href="#" class="scroll-down img-circle addscroll"><i class="fa fa-angle-down"></i></a>
	</div>
</section>

<section class="hp hp-mobile">
	<div class="item item-left">
		<div class="desc">
			<div class="contestlogo"><img src="{{baseUrl}}/img/biryani_and_haleem_contest_logo.png"></div>
			<div class="presents"><img src="{{baseUrl}}/img/presents.png"></div>
			<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
			<a href="#" class="scroll-down img-circle addscrollmobile"><i class="fa fa-angle-down"></i></a>
		</div>
		<i class="overlay"></i>
	</div>
</section>
<div class="clearfix"></div>
<section id="quizdata" class="quiz_data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="quiz_su text-center">
					<div class="head">Contest Details</div><br>
					<div class="contentarea">
						<div class="detail content">
							<p class="text-center">Calling Hyderabad foodies... it's that time of the year again, when you get to vote your favourite Biryani and Haleem Eatery to the Top 10 list of Times Biryani & Haleem Contest.</p><p class="text-center"><strong class="text-center">What are you waiting for. Vote Now!</strong></p>
						</div>
					</div>
				</div><div class="clearfix"></div>

				<div class="tabbed_group">
					<div class="biryani_nomination active" data-for="#biryaninomination">
						Biryani Nominations 2015
					</div>
					<div class="Haleem_nomination" data-for="#haleemnomination">
						Haleem Nominations 2015
					</div>
				</div><div class="clearfix"></div>
				<input type='hidden' value="{{iscontestrunning}}" id="iscontestruning">
				<div class="work-content contest">
					<div id="biryaninomination" class="biryani">
						<?php $isvotebir = $isvotedbiryani; ?>
						{{feeds.getcontest(baseUrl, biryaninominations, start, cityshown, 'biryani', isvotebir)}}
					</div>
					<div id="haleemnomination" class="haleem" style="display:none">
						{{feeds.getcontest(baseUrl, haleemnominations, start, cityshown, 'haleem', isvotedhaleem)}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
<hr>
<section class="quiz_data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="past_result">
					<div class="content">
						<div class="col-sm-4 col-md-3 col-xs-12 text-center">
							<img src="{{baseUrl}}/img/biryani_and_haleem_contest_logo.png">						
						</div>
						<div class="col-sm-8 col-md-9 col-xs-12">
							<p>Times Biryani and Haleem contest has been on since last 7 years and it started as an initiative to honor best Biryani and Haleem which are unique only to the Hyderabadi culture. </p>
							<strong>To check past winners of Biryani and Haleem Contest</strong><br>
							<div class="show_past"><a href="#">View past winners</a></div>
							<div class="past_results" style="display:none">
								<strong>Past winners under Biryani  Category are as follow</strong>
								<p>2011 Winner Hotel Golkonda,  1st Runner up Paradise, 2nd Runner Four Seasons<br>
								2012 Winner Kebabs N Kurries, 1st Runner up ITC Kakatiya Jewel of Nizam, Golconda, 2nd RunnerShah house<br>
								2014 Winner Bawarchi, 1st Runner up Shadab, 2nd Runner Paradise</p>
								<strong>Past winners under Haleem Category are as follow</strong>
								<p>2011 Winner Shah Ghouse, 1st Runner Sarvi,  2nd Runner Pista House<br>
								2012 Winner Paradise, 1st Runner Kholani's, 2nd Runner Sarvi<br>
								2014 Winner Shah Ghouse, 1st Runner Sarvi, 2nd Runner Pista House</p>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</section>
