<?php if(!empty($allfeedslist['results'])){ ?>
	<?php //echo "<pre>"; print_r($allfeedslist);?>
	{{feeds.getfeedslist(baseUrl, allfeedslist, cityshown)}}
<-!-###@###->
<?php if($allfeedslist['meta']['match_count'] > ($start)){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{cities}}','{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '{{searchkeyword}}', '{{tags | trim}}', '{{bydate}}', 'search')" rel="{{start/limit}}">Load More</div>
<?php }?>
<?php }else{ ?>
	<div class=""></div>
	<-!-###@###->
	<div class=""></div>
<?php }?>