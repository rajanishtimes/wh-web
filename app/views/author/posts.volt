<?php if(!empty($allfeedslist['results'])){ ?>
<div class="work-content allfeeds">
	{% for feed in allfeedslist['results'] %}
	<div class="col-sm-4 col-md-3 col-xs-6">
		<div class="work-item">
			<a href="{{baseUrl}}{{city}}/{{feed['slug']}}">
				{% if(feed['cover_image'] is empty) %}
					{{elements.imgnotfound(baseUrl, feed['title'])}}
				{% else %}
					<img src="{{feed['cover_image']}}" alt="{{feed['title']}}">
				{% endif %}
			</a>
			<div class="the-box no-margin">
				<div class="feed-title"><a href="{{baseUrl}}{{city}}/{{feed['slug']}}">{{feed['title']}}</a></div>
			</div>
		</div>
	</div>
	{% endfor  %}
</div>
<-!-###@###->
<?php if($allfeedslist['meta']['match_count'] > $start){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '{{authorid}}', '', '')">Load More</div>
<?php }?>

<?php } ?>