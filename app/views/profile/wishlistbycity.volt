<?php if(!empty($wishlistbycity['results'])){ ?>
{% for key, wishlist in wishlistbycity['results'] %}
	<li id="wishlist_{{wishlist['id']}}" class="media searchlist">
		<a href="#" class="pull-left">
			<div style="background-color:#ffdddd;width:100%">
				{{feeds.getimage(baseUrl, wishlist['image']['uri'], 80, 80, wishlist['title'], '', '', 'img-detail', key+1)}} 
			</div>
		</a>
		<div class="media-body">
			<h4 class="media-heading">{{wishlist['title']}}</h4>
			<?php if(!empty($wishlist['tip'])){ ?>
				<div class="tiphead">TIP:</div>
				<p class="feed-short-desc">{{wishlist['tip']}}</p>
			<?php } ?>
			<div class="date_added float-left">
				On {{wishlist['added_on']}}
			</div>
			<div class="options float-left">
				<a href="javascript:void(0)" onclick="archievewishlist('{{wishlist['id']}}')"><div class="option-archive"><i class="fa fa-trash"></i> Remove</div></a>
			</div>
		</div>
	</li>
{% endfor  %}
<-!-###@###->
<?php
if($wishlistbycity['total_count'] > $start){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '', '', '{{userid}}', 'wishlist')">Load More</div>
<?php }} ?>