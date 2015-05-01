{% if((topfeeds is defined AND topfeeds | length > 0) OR (populartags['popular_tags'] is defined AND populartags['popular_tags'] | length > 0) OR (allfeedslist is defined AND allfeedslist | length > 0)) %}
<div class="section">
	<div class="container">
		<div class="row">
			<!--<h1>Hey! Top Things to do today</h1>-->
			{% if(topfeeds | length > 0) %}
				<h1>Discover best things to do in {{cityshown}} including all the events taking place in {{cityshown}}</h1>
				<div class="work-content resize">
					{% for key, topfeed in topfeeds['results'] %}
						<div class="col-sm-6 col-md-4 col-xs-6">
								<div class="work-item topthing">
									<a href="{{baseUrl}}{{topfeed['url']}}" data-ga-cat="topToday" data-ga-action="{{baseUrl}}{{topfeed['url']}}" data-in-label="pos_{{key+1}}">
									<div class="the-box full no-border transparent no-margin make-up">
										<p class="feed-name">{{topfeed['title'] | stripslashes}}</p>
									</div>
									{{feeds.getimage(baseUrl, topfeed['image']['uri'], 480, 480, topfeed['title'], topfeed['image'])}}
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
					<h2 class="heading">Popular Tips</h2>
					<ul class="work-category-wrap">
						{% for populartag in populartags['popular_tags'] %}
							<li class="filter" ><a href="{{baseUrl}}/tag/{{elements.create_slug(populartag)}}">
							{{populartag}}
							</a></li>
						{% endfor  %}
					</ul><div class="clearfix"></div>
				</div><div class="clearfix"></div><hr>
			{% endif %}
			
			{% if(allfeedslist | length > 0) %}
				<div class="col-sm-5 col-md-6 col-xs-12 no-padding">
					<h2 class="yfeeds">Your Feeds</h2>
				</div>
				<div class="col-sm-7 col-md-6 col-xs-12 no-padding">
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
							<div class="btn btn-primary" onclick="view_feed_with_ajax('{{currentCity}}', '{{baseUrl}}/search/index', '{{start}}', '{{limit}}', 'getallfeeds', '', '', 'all')">Load More</div>
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