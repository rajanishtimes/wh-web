<div class="section grayed">
	<div class="container profile-container">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3">
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
							<div class="sign-in-block text-center">
								<div class="wishlist-default">
									<img src="{{baseUrl}}/img/wishlist_default.png">
								</div>
								<div class="wishlist-default-text">Your Wishlist</div>
								<span class="small-login">Go ahead, Add your first wishlist.</span>
							</div>
						{% endif %}
						
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3">
				<div class="right-profile-column">
					{{ partial('partials/profile-right')}}
				</div>
			</div>
		</div>
	</div>
</div>

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

function CallAfterLogin(){
    FB.login(function(response) {      
        if (response.status === "connected")
        {
            LodingAnimate();
            var access_token = FB.getAuthResponse()['accessToken'];
            FB.api('/me', function(data) {
	            if(data.email == null){
	                alert("You must allow us to access your email id!");
	                ResetAnimate();
	            }else{
	            	var hometown = '';
	            	if(data.hometown != undefined){
	            		hometown = data.hometown.name;
	            	}

	            	var location = '';
	            	if(data.location != undefined){
	            		location = data.location.name;
	            	}
	                AjaxResponse(access_token, hometown, location);
	            }
			});
        }
    },
    {scope:'<?php echo $this->config->facebook->fbPermissions; ?>'});
}
</script>