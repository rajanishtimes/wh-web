<div class="left-profile-section text-center">
    <div class="profile-img">
    	{% if(logged_user is empty) %}
			<img src="{{baseUrl}}/img/looksy.jpg" alt="user" class="profile-img img-circle">
		{% else %}
			<img src="{{logged_user.image}}" alt="{{logged_user.firstname}}" class="profile-img img-circle">
		{% endif %}
    </div>
    <div class="profile-name">
    	{% if(logged_user is empty) %}
			<span>You</span>
		{% else %}
			<span>{{logged_user.firstname}} {{logged_user.lastname}}</span>
		{% endif %}
    </div>
</div>