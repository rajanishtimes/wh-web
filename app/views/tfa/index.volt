<section class="hp tfa">
	<div class="mainback">
		<div class="bordered">
			<div class="desc">
				<!--<div class="contestlogo"><img src="{{baseUrl}}/img/tfa/groupp.png"></div>-->

				<div class="row">
					<ul class="list logos padding0">
						<li><img src="{{baseUrl}}/img/tfa/tfalogo.png"></li>
						<li><img src="{{baseUrl}}/img/tfa/and.png"></li>
						<li><img src="{{baseUrl}}/img/tfa/times_nightlife_awards.png"></li>
					</ul>
				</div>

				<div class="presents">Powered by</div>
				<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
				<div class="coming_text">COMING SOON
					<?php if(!empty($date)){ ?>
						<div class="voting-start">Voting starts on {{date}}</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section><div class="clearfix"></div>
<div class="clearfix"></div>
<!--<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 sponsor">
				<img src="{{baseUrl}}/img/tfa/sponsor.png">
			</div>
		</div>
	</div>
</div>-->

<section id="quizdata" class="quiz_data tfa">
		<div class="col-sm-12 col-md-12 timeline text-center">
			<div class="timeline-block">
				<div class="city">Bangalore</div>
				<div class="date">11 Dec 2015</div>
			</div>

			<div class="timeline-block">
				<div class="city">Chennai</div>
				<div class="date">18 Dec 2015</div>
			</div>

			<div class="timeline-block">
				<div class="city">Kolkata</div>
				<div class="date">23 Dec 2015</div>
			</div>

			<div class="timeline-block">
				<div class="city">Pune</div>
				<div class="date">13 Jan 2016</div>
			</div>

			<div class="timeline-block">
				<div class="city">Jaipur</div>
				<div class="date">18 Jan 2016</div>
			</div>

			<div class="timeline-block">
				<div class="city">Delhi NCR</div>
				<div class="date">03 Mar 2016</div>
			</div>
			
		</div>


		<div class="col-sm-12 col-md-12 emailer">
			<div class="text">Leave us your email, we'll inform you as voting starts</div>
			<div class="newsletter-box">
				<form role="form" method="POST" action="{{baseUrl}}/tfa/newsletter" id="newsletterform">
					<div class="input-group subscribe">
						<input type="hidden" value="{{currentCity}}" name="city">
						<input type="hidden" value="{{cityId}}" name="cityid">
						<input type="text" placeholder="email:" class="form-control" name="email" id="emailvalidate">
						<span class="input-group-btn">
							<input type="submit" value="SUBMIT" name="submit" class="btn btn-info">
						</span>
					</div><div class="clearfix"></div>
					{{ flash.output() }}
				</form>
			</div>
		</div>
		


		<div class="row">
		<div class="col-sm-12 col-md-12 no-padding">
			<div class="award-block">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 texting">
							<div class="award_head">Times Food & Nightlife Awards 2016</div>
							<div class="award_text">The country's oldest and most revered food & nightlife awards are back! Keep an eye out for your city's nominations, so you can start voting.
							<!--<br><br><strong>Nominations by star Critic Marryam H Reshii</strong>--></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-3 awardimg">
							<img src="{{baseUrl}}/img/tfa/times_food_b.png">				
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

		<!--<div class="col-sm-12 col-md-12 shareer">
			
		</div>-->
 
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="winnerforawrds">
					<div class="container">
							<div class="col-sm-12 col-md-12 padding0">
								WINNERS FOR TIMES FOOD AND NIGHTLIFE AWARDS 2015
							</div>
					</div><div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="winnerslist">
				<div class="container footerlist">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							{% for key, awards in allpastwinners['Food Awards'] %}
								<h2 class="footerstyle">(Food) {{key}} Awards<br>all cuisine</h2>
								<ul class="list">
									{% for key2, winner in awards %}	
										{% for key3, venue in winner %}
										<li>
											<?php if(!empty($venue['url'])){ ?>
												<a href="{{baseUrl}}{{venue['url']}}" target="_blank">
											<?php } ?>
												{{key2}} - {{venue['venue_name']}}
											<?php if(!empty($venue['url'])){ ?>
												</a>
											<?php } ?>
										</li>
										{% endfor  %}
									{% endfor  %}
								</ul>
							{% endfor  %}
						</div>

						<div class="col-xs-12 col-sm-6 col-md-6">
							{% for key, awards in allpastwinners['Nightlife Awards'] %}
								<h2 class="footerstyle">(Nightlife) {{key}} Awards<br>all cuisine</h2>
								<ul class="list">
									{% for key2, winner in awards %}	
										{% for key3, venue in winner %}
										<li>
											<?php if(!empty($venue['url'])){ ?>
												<a href="{{baseUrl}}{{venue['url']}}" target="_blank">
											<?php } ?>
												{{key2}} - {{venue['venue_name']}}
											<?php if(!empty($venue['url'])){ ?>
												</a>
											<?php } ?>
										</li>
										{% endfor  %}
									{% endfor  %}
								</ul>
							{% endfor  %}
						</div>

					</div>
				</div><div class="clearfix"></div>
			</div>
		</div>
		</div>
</section>
<!--<div class="haleemoverlay"><img src="{{baseUrl}}/img/ajax-loader.gif"></div>-->

