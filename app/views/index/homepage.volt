<div class="section">
	<div class="container">
		<div class="row">
			<h1>Hey! Top Things to do today</h1>
			<div class="work-content">
				{% for topfeed in topfeeds['results'] %}
					<div class="col-sm-6 col-md-4 col-xs-6">
						<a href="{{baseUrl}}{{city}}/{{topfeed['slug']}}">
							<div class="work-item">
								<div class="the-box full no-border transparent no-margin make-up">
									<p class="feed-name">{{topfeed['title']}}</p>
								</div>
								<img src="{{topfeed['image']['uri']}}" alt="{{topfeed['title']}}">
							</div>
						</a>
					</div>
				{% endfor  %}
			</div>
			<div class="clearfix"></div>
			<hr>
			<input id="tags" type="hidden" value="">
			<input id="bydatefeed" type="hidden" value="">
			
			<div class="work-content">						
				<h2 class="heading">Popular Tips</h2>
				<ul id="populartag" class="work-category-wrap">
					<?php if(!empty($populartags['popular_tags'])){ ?>
						{% for populartag in populartags['popular_tags'] %}
							<li class="filter" ><a href="javascript:void(0)">
							{{populartag | capitalize}}
							</a></li>
						{% endfor  %}
					<?php } ?>
				</ul><div class="clearfix"></div>
			</div><div class="clearfix"></div><hr>
			<div class="col-sm-6 col-md-6 col-xs-12 no-padding">
				<h2>Your Feeds</h2>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<ul id="bydate" class="filter_type text-right">
					<li><a href="javascript:void(0)">TODAY</a></li>
					<li><a href="javascript:void(0)">TOMMORROW</a></li>
					<li><a href="javascript:void(0)">THIS WEEKEND</a></li>
					<li class="active"><a href="javascript:void(0)">ALL</a></li>
				</ul>
			</div><div class="clearfix"></div>
			
			
			<div class="work-content allfeeds">
				<div id="getallfeeds">					
					{% for feed in allfeedslist['results'] %}
					<?php //echo "<pre>"; print_r($feed); ?>
					<div class="col-sm-4 col-md-3 col-xs-6">
						<div class="work-item">
							<a href="{{baseUrl}}{{city}}/{{feed['slug']}}"><img src="{{feed['image']['uri']}}" alt="{{feed['title']}}"></a>
							<div class="the-box no-margin">
								<div class="feed-title"><a href="{{baseUrl}}{{city}}/{{feed['slug']}}">{{feed['title']}}</a></div>
								<p class="feed-short-desc">{{feed['description']}}</p>
							</div>
						</div>
					</div>
					{% endfor  %}
				</div><div class="clearfix"></div>
				<div class="loadmore">
					<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
						<div class="btn btn-primary" onclick="view_feed_with_ajax('{{baseUrl}}search/index', '{{start}}', '{{limit}}', 'getallfeeds', '', '', 'all')">Load More</div>
					<?php }?>
				</div>
			</div>
			
		</div>
	</div>
</div>