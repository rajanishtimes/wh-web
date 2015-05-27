<?php if(!empty($allfeedslist['results'])){ ?>
	<?php //echo "<pre>"; print_r($allfeedslist);?>
	{{feeds.getfeeds(baseUrl, allfeedslist, start, cityshown)}}
<-!-###@###->

<?php if($allfeedslist['meta']['match_count'] > ($start)){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '{{searchkeyword}}', '{{tags | trim}}', '{{bydate}}')" rel="{{start/limit}}">Load More</div>
<?php }?>
<?php }else{ ?>
	{% if(start < 1) %}
		<div class="container"><div class="alert alert-info in">No Result(s) Found</div></div>
	{% endif %}
	<-!-###@###->
	<div class=""></div>
<?php }?>