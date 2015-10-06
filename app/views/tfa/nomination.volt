<section class="share_data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 sponsor">
					<img src="{{baseUrl}}/img/tfa/sponsor.png">
				</div>
			</div>
		</div>
	</div>
</section>

<div class="clearfix"></div>
<section class="category-data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="category-block">
					<div class="category-head">
						SELECT YOUR CATEGORY AND VOTE
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
<section class="category-list-data">
	<div class="section">
		<div class="container">
			<div class="row">
				<?php if(count($tfacategorys['location']) > 1){ ?>
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="category-list">
							<ul class="list-inline text-center">
								{% for key, tfacategory in tfacategorys['location'] %}
									<li data-for="{{key}}">{{tfacategory['name']}}</li>
								{% endfor %}
							</ul>
						</div>
					</div>
				<?php } ?>

				<div class="col-sm-12 col-md-12 col-xs-12">
					<div class="category-list">
						{% for key, tfacategory in tfacategorys['location'] %}
							<ul class="list-inline list-{{key}}">
								{% for key1, event in tfacategory['events'][0]['categories'] %}
									{% for key2, category in event['child_category'] %}
										<li class="{{key2}}">{{category['name']}}</li>
									{% endfor %}
								{% endfor %}
							</ul>
						{% endfor %}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<section class="nomination_data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-xs-12">
					<div class="main-block">
						<div class="accordian-block">
							<div class="nomination-count float-left">
								FOUND-03
							</div>
							<div class="category-name-block float-left">
								<div class="category-name">
									BEST NORTH INDIAN
								</div>
								<div class="event-name">
									FINE DINE
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>			
			</div><div class="clearfix"></div>	
			<div class="row work-content allfeeds">	
				<div class="tfafeeds">
					<!-- Nomination blocks design -->
						<div class="col-sm-4 col-md-3 col-xs-6">
							<div class="work-item feeds-data">
								<a href="#">
									<div class="hover-container">
										<div class="hover-wrap">
											<i class="glyphicon glyphicon-plus bino"></i>
										</div>
										<div style="background-color:#ffdddd;">
											<img class="lazy " style="background-color: rgb(255, 221, 221); opacity: 1; height: 180px;" alt="6 Ways To Hit That Sweet Spot" src="http://im.whatshot.in/content/2015/Oct/1443696482-desserttrail.jpg?w=479&amp;h=180&amp;cc=1&amp;q=75">
										</div>
									</div>
								</a>
								<a href="#">
									<div class="the-box no-margin no-border">
										<div class="boundarea">
											<div title="6 Ways To Hit That Sweet Spot" class="feed-title">6 Ways To Hit That Sweet Spot</div>
											<div class="feed-short-desc">Lazy and obsessively eating everything in sight &ndash; that’s Garfield but that could so easily b...</div>
											</div>
									</div>
									<div class="ratings">
										<div class="float-left">
											FOOD <strong>3.5</strong>
										</div>
										<div class="float-left">
											SERVICE <strong>3.5</strong>
										</div>
										<div class="float-left">
											DECOR <strong>3.5</strong>
										</div>
										<div class="popup float-left">
											<img src="{{baseUrl}}/img/popup.png">
										</div>
									</div>
								</a>
								<div class="clearfix"></div>
								<div class="calls text-center">VOTE OR MISS CALL - 2340 233 456</div>
								<div class="votebtn">VOTE</div>
							</div>
						</div>


						<div class="col-sm-4 col-md-3 col-xs-6">
							<div class="work-item feeds-data">
								<div class="tfavotedhover">
									<div class="tickimg">
										Your Vote has been counted.
									</div>
									<hr>
									<div class="promote">
										Promote your favourite restaurant
										<div class="stro">The Kitchen for Best North Indian</div>
										<div class="social-icon float-left"><i class="fa fa-facebook"></i></div>
										<div class="social-icon float-left"><i class="fa fa-twitter"></i></div>
										<div class="social-icon float-left"><i class="fa fa-google-plus"></i></div>
										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
									<div class="share-vote">
										Share this direct vote link
										<div class="clearfix"></div><div class="sharebtn">COPY LINK <i class="fa fa-link"></i></div>
									</div>
									<div class="clearfix"></div>
									<hr>
									<div class="cvote">CANCEL VOTE</div>
								</div>
								<a href="#">
									<div class="hover-container">
										<div class="hover-wrap">
											<i class="glyphicon glyphicon-plus bino"></i>
										</div>
										<div style="background-color:#ffdddd;">
											<img class="lazy " style="background-color: rgb(255, 221, 221); opacity: 1; height: 180px;" alt="6 Ways To Hit That Sweet Spot" src="http://im.whatshot.in/content/2015/Oct/1443696482-desserttrail.jpg?w=479&amp;h=180&amp;cc=1&amp;q=75">
										</div>
									</div>
								</a>
								<a href="#">
									<div class="the-box no-margin no-border">
										<div class="boundarea">
											<div title="6 Ways To Hit That Sweet Spot" class="feed-title">6 Ways To</div>
											<div class="feed-short-desc">Lazy and obsessively eating everything in sight &ndash; that’s b...</div>
											</div>
									</div>
									<div class="ratings">
										<div class="float-left">
											FOOD <strong>3.5</strong>
										</div>
										<div class="float-left">
											SERVICE <strong>3.5</strong>
										</div>
										<div class="float-left">
											DECOR <strong>3.5</strong>
										</div>
										<div class="popup float-left">
											<img src="{{baseUrl}}/img/popup.png">
										</div>
									</div>
								</a>
								<div class="clearfix"></div>
								<div class="calls text-center">VOTE OR MISS CALL - 2340 233 456</div>
								<div class="votebtn">VOTE</div>
							</div>
						</div>
					<!-- Nomination blocks design end -->
				</div>
			</div>
		</div>
	</div>
</section>