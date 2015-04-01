<div class="col-sm-6 col-md-6 col-lg-6">
	<div class="right-side">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h2 class="top_feeds_head">TOP FEEDS</h2>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right selectcity">
			<select>
				<?php foreach($allcities->cities as $allcity){ ?>
					<option value="<?php echo strtolower($allcity->name);?>" <?php if(strtolower($allcity->name) == $city){ echo "selected='selected'";} ?>><?php echo ucwords($allcity->name);?></option>
				<?php } ?>
			</select>
		</div>
		<div class="clearfix"></div>
		<?php //echo "<pre>"; print_r($allfeeds); echo "</pre>";?>
		<div class="feeds-container">
			<div class="section">
				<ul id="feeds-list" class="media-list feed-list">
					<form id="formfeeds" type="POST">
						<input type="hidden" value="{{allfeeds.meta.match_count}}" name="total_feeds">
						<input type="hidden" value="0" name="start_feeds">
						<input type="hidden" value="10" name="limit_feeds">
						<input type="hidden" value="{{city}}" name="city_feeds">
						<input type="hidden" value="{{getfeedsUrl}}" name="url_feeds">
					</form>
					
					
					
				</ul>
				<div class="primary"></div>
			</div>
		</div>
		
		<div class="align-center">
			<button class="btn btn-primary">Load More</button>
		</div>
		
	</div>
</div>