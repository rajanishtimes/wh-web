<?php if(!empty($wishlistbycity['results'])){ ?>
{{feeds.getwishlist(baseUrl, wishlistbycity['results'], start, 'wishlist')}}
<-!-###@###->
<?php
if($wishlistbycity['total_count'] > $start){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '', '', '{{userid}}', 'wishlist')">Load More</div>
<?php }} ?>