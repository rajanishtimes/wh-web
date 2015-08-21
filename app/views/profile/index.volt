<div class="section grayed">
	<div class="container profile-container">
		<div class="">
			<div class="col-xs-12 col-sm-3 col-md-3 no-padding">
				<div class="left-profile-column">
					{{ partial('partials/profile-left')}}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="middle-profile-column">
					<div class="profile-main-container">
						{% if(logged_user is empty) %}
							<div class="sign-in-block text-center">
								<div class="sign-in-text">Create your profile and easily check <br> your Wishlist here!</div>
								<div id="results"></div>
								<div id="LoginButton" class="facebook-sign-in" onClick="javascript:CallAfterLogin();return false;">
									<img src="{{baseUrl}}/img/facebook-login.png">
								</div>
								<span class="small-login">we wouldn't post anything without your permission</span>
							</div>
						{% else %}
							{% if(allwishlistlist is empty) %}
							<div class="sign-in-block text-center">
								<div class="wishlist-default">
									<img src="{{baseUrl}}/img/wishlist_default.png">
								</div>
								<div class="wishlist-default-text">Your Wishlist</div>
								<span class="small-login">Go ahead, Add your first wishlist.</span>
							</div>
							{% else %}
							<div class="wishlist text-left">
								<div class="work-content allfeeds">
										<h1 class="searchheading">My Wishlist</h1>
										<?php //echo "<pre>"; print_r($allwishlistlist); echo "</pre>"; ?>

										{% for key, list in allwishlistlist %}
											<ul id="getwishlist{{key}}" class="media-list feed-list">
											<h2 class="cityheader"><span id="count{{key}}">{{list['total_count']}}</span> Item(s) in your <strong>{{list['city']}}</strong> Go-Do list</h2>
											{{feeds.getwishlist(baseUrl, list['list'], start, 'wishlist', key)}}
											
											</ul><div class="clearfix"></div>
											<?php if($list['total_count'] > ($limit)){ ?>
												<div class="loadmore margin-top-20">												
													<div class="btn btn-primary" onclick="view_feed_with_ajax('{{list['city_id']}}', '{{baseUrl}}/profile/wishlistbycity', '{{start}}', '{{limit}}', 'getwishlist{{key}}', '', '', '{{logged_user.sso_id}}', 'wishlist')">Load More</div>
												</div>
											<?php }?>
										{% endfor  %}
								</div>
							</div>
							<style>.middle-profile-column{padding: 1px 0px}</style>

							{% endif %}
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

<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
    FB.init({
        appId: '<?php echo $this->config->facebook->appId; ?>',
        cookie: true,xfbml: true,
        oauth: true,
        version: 'v2.4'
        });
    };
(function() {
    var e = document.createElement('script');
    e.async = true;e.src = document.location.protocol +'//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);}());
</script>