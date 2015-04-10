<?php if(!empty($allfeedslist['results'])){ ?>
<div class="work-content allfeeds">
	<?php //echo "<pre>"; print_r($allfeedslist);?>
	{% for feed in allfeedslist['results'] %}
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
</div>
<-!-###@###->
<?php if($allfeedslist['meta']['match_count'] > ($start*$limit)){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '{{searchkeyword}}', '{{tags}}', '{{bydate}}')">Load More</div>
<?php }?>
<?php }else{ ?>
	<div class="container"><div class="alert alert-info in">No Result Found</div></div>
<?php }?>