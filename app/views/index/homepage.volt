<div class="section">
	<div class="container">
		<div class="row">
			<!--<h1>Hey! Top Things to do today</h1>-->
			{% if(topfeeds | length > 0) %}
				<h1>Discover best things to do in {{city}} including all the events taking place in {{city}}</h1>
				<div class="work-content resize">
					{% for key, topfeed in topfeeds['results'] %}
						<div class="col-sm-6 col-md-4 col-xs-6 topthing">
							<a href="{{baseUrl}}{{topfeed['url']}}" data-ga-cat="topToday" data-ga-action="{{baseUrl}}{{topfeed['url']}}" data-in-label="pos_{{key+1}}">
								<div class="work-item">
									<div class="the-box full no-border transparent no-margin make-up">
										<p class="feed-name">{{topfeed['title']}}</p>
									</div>
									{{feeds.getimage(baseUrl, topfeed['image']['uri'], 480, 480, topfeed['title'], topfeed['image'])}}
								</div>
							</a>
						</div>
					{% endfor  %}
				</div>
				<div class="clearfix"></div>
				<hr>
			{% endif  %}
			
			<input id="tags" type="hidden" value="">
			<input id="bydatefeed" type="hidden" value="">
			
			{% if(populartags['popular_tags'] | length > 0) %}
				<div class="work-content">						
					<h2 class="heading">Popular Tips</h2>
					<ul class="work-category-wrap">
						{% for populartag in populartags['popular_tags'] %}
							<li class="filter" ><a href="{{baseUrl}}tag/{{populartag}}">
							{{populartag}}
							</a></li>
						{% endfor  %}
					</ul><div class="clearfix"></div>
				</div><div class="clearfix"></div><hr>
			{% endif %}
			
			{% if(allfeedslist | length > 0) %}
				<div class="col-sm-6 col-md-6 col-xs-12 no-padding">
					<h2 class="yfeeds">Your Feeds</h2>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12 no-padding">
					<ul id="bydate" class="filter_type text-right">
						<li class="active"><a href="javascript:void(0)" rel="All">ALL</a></li>
						<li><a href="javascript:void(0)" rel="Today">TODAY</a></li>
						<li><a href="javascript:void(0)" rel="Tomorrow">TOMORROW</a></li>
						<li><a href="javascript:void(0)" rel="Week">THIS WEEK</a></li>
						<li><a href="javascript:void(0)" rel="Month">MONTH</a></li>
					</ul>
				</div><div class="clearfix"></div>
			
			
				<div class="work-content allfeeds">
					<div id="getallfeeds">					
						{{feeds.getfeeds(baseUrl, allfeedslist, start)}}
					</div><div class="clearfix"></div>
					<div class="loadmore">
						<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
							<div class="btn btn-primary" onclick="view_feed_with_ajax('{{baseUrl}}search/index', '{{start}}', '{{limit}}', 'getallfeeds', '', '', 'all')">Load More</div>
						<?php }?>
					</div>
				</div>
			{% endif %}
		</div>
	</div>
</div>