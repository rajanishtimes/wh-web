<?php if(!empty($allfeedslist['results'])){ ?>
<div class="work-content allfeeds">
	<?php //echo "<pre>"; print_r($allfeedslist);?>
	<?php foreach ($allfeedslist['results'] as $feed) { ?>
	<div class="col-sm-4 col-md-3 col-xs-6">
		<div class="work-item">
			<a href="<?php echo $baseUrl; ?><?php echo $city; ?>/<?php echo $feed['slug']; ?>"><img src="<?php echo $feed['image']['uri']; ?>" alt="<?php echo $feed['title']; ?>"></a>
			<div class="the-box no-margin">
				<div class="feed-title"><a href="<?php echo $baseUrl; ?><?php echo $city; ?>/<?php echo $feed['slug']; ?>"><?php echo $feed['title']; ?></a></div>
				<p class="feed-short-desc"><?php echo $feed['description']; ?></p>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<-!-###@###->
<?php if($allfeedslist['meta']['match_count'] > ($start)){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('<?php echo $mainurl; ?>', '<?php echo $start; ?>', '<?php echo $limit; ?>', '<?php echo $parentid; ?>', '<?php echo $searchkeyword; ?>', '<?php echo trim($tags); ?>', '<?php echo $bydate; ?>')">Load More</div>
<?php }?>
<?php }else{ ?>
	<div class="container"><div class="alert alert-info in">No Result Found</div></div>
	<-!-###@###->
	<div class=""></div>
<?php }?>