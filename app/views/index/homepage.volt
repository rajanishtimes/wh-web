<div class="section">
	<div class="container">
		<div class="row">
			<!--<h1>Hey! Top Things to do today</h1>-->
			<h1>Discover best things to do in {{city}} including all the events taking place in {{city}}</h1>
			<div class="work-content resize">
			{% if(topfeeds | length > 0) %}
				{% for topfeed in topfeeds['results'] %}
					<div class="col-sm-6 col-md-4 col-xs-6">
						<a href="{{baseUrl}}{{topfeed['url']}}">
							<div class="work-item">
								<div class="the-box full no-border transparent no-margin make-up">
									<p class="feed-name">{{topfeed['title']}}</p>
								</div>
								{% if(topfeed['image']['uri'] is empty) %}
									{{feeds.imagenotfound(baseUrl, topfeed['title'])}}
								{% else %}
									<img src="{{topfeed['image']['uri']}}" alt="{{topfeed['title']}}">
								{% endif %}
							</div>
						</a>
					</div>
				{% endfor  %}
			{% endif  %}
			</div>
			<div class="clearfix"></div>
			<hr>
			<input id="tags" type="hidden" value="">
			<input id="bydatefeed" type="hidden" value="">
			
			<div class="work-content">						
				<h2 class="heading">Popular Tips</h2>
				<!--<ul id="populartag" class="work-category-wrap">-->
				<ul class="work-category-wrap">
					<?php if(!empty($populartags['popular_tags'])){ ?>
						{% for populartag in populartags['popular_tags'] %}
							<li class="filter" ><a href="{{baseUrl}}tag/{{populartag}}">
							{{populartag}}
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
					<li><a href="javascript:void(0)" rel="Today">TODAY</a></li>
					<li><a href="javascript:void(0)" rel="Tomorrow">TOMORROW</a></li>
					<li><a href="javascript:void(0)" rel="Week">WEEKEND</a></li>
					<li><a href="javascript:void(0)" rel="Month">MONTH</a></li>
					<li class="active"><a href="javascript:void(0)" rel="All">ALL</a></li>
				</ul>
			</div><div class="clearfix"></div>
			
			{% if(allfeedslist | length > 0) %}
			<div class="work-content allfeeds">
				<div id="getallfeeds">					
					{{feeds.getfeeds(baseUrl, allfeedslist)}}
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