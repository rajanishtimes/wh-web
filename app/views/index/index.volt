{% if(currentCity == 'hyderabad') %}
<!--<div class="section topbiryanistrip">
	<div class="container">
		<div class="row contestdata">
			<a href="{{baseUrl}}/hyderabad/biryanihaleem">
				<div class="contestimg"><img src="{{baseUrl}}/img/biryani_and_haleem_contest_logo.png"></div>
				<div class="contestdesc">Times Biryani & Haleem Contest. Vote Now!</div>
			</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>-->
{% endif %}

{% if((topfeeds is defined AND topfeeds | length > 0) OR (populartags['popular_tags'] is defined AND populartags['popular_tags'] | length > 0) OR (allfeedslist is defined AND allfeedslist | length > 0)) %}
<div class="section">
	<div class="container">
		<div class="row">
			<?php  //echo "<pre>"; print_r($topfeeds); echo "</pre>"; ?>
			<!--<h1>Hey! Top Things to do today</h1>-->
			{% if(topfeeds | length > 0) %}
				<h1>Discover {{cityshown}} with our curated features, events and guides</h1>
				<div class="row work-content resize">
					{% for key, topfeed in topfeeds %}
						<div class="col-sm-6 col-md-4 col-xs-6">
								<div class="work-item topthing">
									<a href="{{baseUrl}}{{topfeed['url']}}" data-ga-cat="Top 3 Events {{cityshown}} Home" data-ga-action="{{topfeed['title'] | stripslashes}}" data-ga-label="top_3_eve_pos_{{key+1}}">
									<div class="overlay_top"></div>
									<div class="the-box full no-border transparent no-margin make-up">
										<div class="top_feed feed-name">
											<p>{{topfeed['title'] | stripslashes}}</p>

											{% if(topfeed['type'] == 'EVENT') %}
												<?php  $timees = explode(', ', $topfeed['time']) ?>
												<div class="col-sm-6 col-md-6 col-xs-12 no-padding"><div class="top_calender"></div> {{timees['0']}}</div>
												<div class="col-sm-6 col-md-6 col-xs-12 no-padding"><div class="top_times"></div> {{timees['1']}}</div>
												<div class="col-sm-12 col-md-12 col-xs-12 no-padding"><div class="top_location"></div>{{topfeed['venueDetail']['zone']}}, {{topfeed['venueDetail']['city']}}</div>
											{% else %}
												<div class="col-sm-12 col-md-12 col-xs-12 no-padding">{{topfeed['description']}}</div>
											{% endif %}
										</div>
									</div>
									{{feeds.getimage(baseUrl, topfeed['image']['uri'], 480, 480, topfeed['title'], topfeed['image'], '', '', key+1)}}
									</a>
								</div>
						</div>
					{% endfor  %}
				</div>
				<div class="clearfix"></div>
				<hr>
			{% endif  %}
			
			<input id="tags" type="hidden" value="">
			<input id="bydatefeed" type="hidden" value="">
			
			{% if(populartags['popular_tags'] is defined AND populartags['popular_tags'] | length > 0) %}
				<div class="work-content">						
					<h2 class="heading">Popular Tags</h2>
					<ul class="work-category-wrap tagsblack">
						{% for key, populartag in populartags['popular_tags'] %}
							<li class="filter" ><a href="{{baseUrl}}/{{currentCity}}/tag/{{elements.create_slug(populartag)}}" data-ga-cat="Popular Tags - {{cityshown}}" data-ga-action="{{populartag}}" data-ga-label="popular_tag_pos_{{key+1}}">
							{{populartag}}
							</a></li>
						{% endfor  %}
					</ul><div class="clearfix"></div>
				</div><div class="clearfix"></div><hr>
			{% endif %}
			
			{% if(allfeedslist | length > 0) %}
				<div class="col-xs-12 no-padding text-center">
					<h2 class="yfeeds">Your Feed</h2>
				</div>
				<div class="col-xs-12 no-padding text-center">
					<ul id="bydate" class="filter_type">
						<li class="active"><a href="javascript:void(0)" rel="All">ALL</a></li>
						<li><a href="javascript:void(0)" rel="Today">TODAY</a></li>
						<li><a href="javascript:void(0)" rel="Tomorrow">TOMORROW</a></li>
						<li><a href="javascript:void(0)" rel="Week">THIS WEEK</a></li>
						<li><a href="javascript:void(0)" rel="Month">THIS MONTH</a></li>
					</ul>
				</div><div class="clearfix"></div>
			
				<div class="row work-content allfeeds">
					<div id="getallfeeds">					
						{{feeds.getfeeds(baseUrl, allfeedslist, 0, cityshown, 'feed')}}
					</div><div class="clearfix"></div>
					<div class="loadmore">
						<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
							<div class="btn btn-primary" onclick="view_feed_with_ajax('{{currentCity}}', '{{baseUrl}}/search/index', '{{start}}', '{{limit}}', 'getallfeeds', '', '', 'all', 'feed', '{{spstart}}', '{{splimit}}')">Load More</div>
						<?php }?>
					</div>
				</div>
			{% endif %}
		</div>
	</div>
</div>
{% else %}
<div class="section">
	<div class="container">
		<div class="row notfound">
			<div class="col-sm-3 col-md-3 col-xs-12 text-center">
				<img src="{{baseUrl}}/img/no-feed.png">
			</div>
			<div class="col-sm-9 col-md-9 col-xs-12">
				<h1>Oops!</h1>
				Unfortunately, We could not find any results matching your search. We tried really hard. We looked all over the place and frankly, We just couldn't find anything good.
				<div style="height:100px"></div>
			</div>
		</div>
	</div>
</div>
{% endif %}

