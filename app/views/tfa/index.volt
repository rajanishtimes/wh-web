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
				<div class="date">01 Jan 2016</div>
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
					</div>
				</div>
			</div>
		</div>

		<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="winnerslist">
				<div class="container footerlist">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<!--<h2 class="footerstyle">Fine Dine (Food) all cuisines</h2>-->
							<ul class="list make2col">
								{% for key, winners in allpastwinners %}
									<li>
										<?php if(!empty($winners['url'])){ ?>
											<a href="{{baseUrl}}{{winners['url']}}" target="_blank">
										<?php } ?>
											{{winners['venue_name']}} - {{winners['category_name']}}
										<?php if(!empty($winners['url'])){ ?>
											</a>
										<?php } ?>
									</li>
								{% endfor  %}
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
</section>
<!--<div class="haleemoverlay"><img src="{{baseUrl}}/img/ajax-loader.gif"></div>-->

