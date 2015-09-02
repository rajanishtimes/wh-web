<div class="section grayed">
	<div class="container profile-container">
		<div class="">
			<div class="col-xs-12 col-sm-3 col-md-3 no-padding">
				<div class="left-profile-column">
					{{ partial('partials/profile-left-public')}}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="middle-profile-column">
					<div class="profile-main-container">
						{% if(allwishlistlist is empty) %}
							<div class="sign-in-block text-center">
								<div class="wishlist-default">
									<img src="{{baseUrl}}/img/wishlist_default.png">
								</div>
								<div class="wishlist-default-text">Duh!</div>
								<span class="small-login">Your Go-Do list is still empty! Check some content or event that you would like to add to your list and simply tap the + sign to have it added here.</span>

							</div>
						{% else %}
							<div class="wishlist text-left">
								<div class="work-content allfeeds">
										<h1 class="searchheading">My {{config.application.wishlistname}}</h1>
										<?php //echo "<pre>"; print_r($allwishlistlist); echo "</pre>"; ?>
										{% for key, list in allwishlistlist %}
											<ul id="getwishlist{{key}}" class="media-list feed-list">
											<h2 class="cityheader"><span id="count{{key}}">{{list['total_count']}}</span> Items in your <strong>{{list['city']}}</strong> {{config.application.wishlistname}}</h2>

											{% if(logged_user is empty) %}
												<?php $log_user = ''; ?>
											{% else %}
												<?php $log_user = $logged_user->sso_id; ?>
											{% endif %}

											{{feeds.getwishlist(baseUrl, list['list'], start, 'wishlist', key, profiledata['sso_id'], log_user)}}
											
											</ul><div class="clearfix"></div>
											<?php if($list['total_count'] > ($limit)){ ?>
												<div class="loadmore margin-top-20">												
													<div class="btn btn-primary" onclick="view_feed_with_ajax('{{list['city_id']}}', '{{baseUrl}}/profile/wishlistbycity', '{{start}}', '{{limit}}', 'getwishlist{{key}}', '', '{{profiledata['sso_id']}}', '{{log_user}}', 'wishlist')">Load More</div>
												</div>
											<?php }?>
										{% endfor  %}
								</div>
							</div>
							<style>.middle-profile-column{padding: 1px 0px}</style>
						{% endif %}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 no-padding">
				<div class="right-profile-column">
					{{ partial('partials/profile-right')}}
				</div>
			</div>
		</div>
	</div>
</div>
<style>.wrapper{background: #eaeced none repeat scroll 0 0;}</style>