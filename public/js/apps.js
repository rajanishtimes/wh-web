var feed_with_ajax_running = false;
var $sidebar = $('.sidebar'),HomeCityName = _city, CurrentCity = _crrentCity,
$window = $(window),
previousScroll = 0;

$window.on('scroll', function (e) {
	if ($window.scrollTop() - previousScroll > 0) {
		$sidebar.css({
			'top': Math.max($window.scrollTop() + $window.height() - $sidebar.outerHeight(true), parseInt($sidebar.css('top'))) + 'px'
		});
	} else {
		$sidebar.css({
			'top': Math.min($window.scrollTop(), parseInt($sidebar.css('top'))) + 'px'
		});
	}
	previousScroll = $window.scrollTop();
});


$window.on('scroll', function (e) {
	var elem = $('.loadmore .btn.btn-primary');
	if(elem.length > 0){
		if($('.profile-container').length == 0){
			if ($(window).scrollTop() + $(window).height() > $('.loadmore').position().top){
				var attr = elem.attr('rel');
				if (typeof attr !== typeof undefined && attr !== false) {
					if(attr < 3){
						elem.trigger('click');
					}
				}else{
					elem.trigger('click');
				} 
			}	
		}
	}
	
	/*if($(window).width() > 640){
		if($(window).scrollTop() > 100){
			$('.navbar.navbar-default').addClass('makeheaderintera');
		}else{
			$('.navbar.navbar-default').removeClass('makeheaderintera');
		}
	}*/
	
});

$(window).load(function() {
	
	jQuery("#back-top").hide();
	
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});
		
		$(document.body).on('click', '#back-top', function(){
		"use strict";
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
	resizefeedimage();
	setquizheight();
	$(window).resize(function() {
	  resizefeedimage();
	  setquizheight();
	});
	
	//fbandtwitter();
});

function searchValid(){
	var searchVal=$('#searchtextinput').val();
	if(searchVal=='')
		$('.searchbox').addClass('redborder');
	else
		$('.searchbox').removeClass('redborder');
	
	if(searchVal=='')
		return false;
	
}


function ajax_feed_filter_type(){
	if(feed_with_ajax_running === false){
		$('#getallfeeds').empty();
	}
	view_feed_with_ajax(server_variables.current_city, baseUrl+'/search/index', 0, 11, 'getallfeeds', '', $('#tags').val(), $('#bydatefeed').val(), 'feed');
}


$.fn.center = function () {
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}


$(document).ready(DOMReady);

function resizefeedimage(){
	var width = 0;
	var height = 0;
	$(".work-item img").each(function( index ) {
		if($(this).parent().parent().find('.make-up').length == 0){
			width = $(this).parent().parent().parent().parent().width();
			height = $(this).parent().parent().parent().parent().height();
		}
		$(this).height(($(this).width()));
	});

	$(".defaultads").css('width',width+2);
	$(".defaultads").css('height',height+3);
	$(".defaultads > div > div").find('iframe').css('height', height+1);
	$(".defaultads > div > div").find('iframe').css('width', width);

	/* $(".withmask").each(function( index ) {
		$(this).height(width+147);
	});  */
}

function view_feed_with_ajax(city, mainURL, start, limit, parentId, searchval, tags, bydate, type, spstart, splimit){
	var spstart = spstart || start;
	var splimit = splimit || limit;

	if(feed_with_ajax_running === false){
		//console.log("starting ....");
		$.ajax( {
			url:mainURL,
			type:'POST',
			//async:false,
			data: 'city='+city+'&searchkeyword='+searchval+'&start='+start+'&limit='+limit+'&tags='+tags+'&bydate='+bydate+'&mainurl='+mainURL+'&parentid='+parentId+'&type='+type+'&spstart='+spstart+'&splimit='+splimit,
			beforeSend: function(){
				feed_with_ajax_running = true;
				//console.log("sending request ... ");
				$('#'+parentId).append('<div class="loader"><div class="clearfix"></div><img src="'+baseUrl+'/img/ajax-loader.gif"></div>');
				$('#'+parentId).parent().find('.loadmore .btn').addClass('visibilityhide');
			},
			success:function(data) {
				var splitdata = data.split("<-!-###@###->");
				$('#'+parentId).parent().find('.loader').remove();
				$('#'+parentId).append(splitdata[0]);
				$('#'+parentId).parent().find('.loadmore').html(splitdata[1]);
				resizefeedimage();
				setTimeout(function(){ resizefeedimage(); }, 1000);
				if($('.seach-overlay-box').css('display') == 'block'){
					$('.seach-overlay-box').height($(document).height());
				}
				feed_with_ajax_running = false;
				$("img.lazy").unveil(200, function() {
				  $(this).load(function() {
				    this.style.opacity = 1;
				  });
				});

				//$("img.lazy").lazyload({effect : "fadeIn"});
				//console.log("request complete ....");
			}
		});

	}
}

function manageCityCookie(){
    expOn = new Date();
    expOn.setTime(new Date().getTime() + 3600000 * 24 * 365);
	
	if(cookies.get('uniquekey') == null){
		cookies.set('uniquekey', 'uuqid'+new Date().getTime() + 3600000 * 24 * 365, {path: '/',expires:expOn});
	}

	if(HomeCityName != "" && HomeCityName != undefined){
        cookies.set('city',_city, {path: '/',expires:expOn});
    }
    else{
        cookies.set('city', server_variables.default_city, {path: '/',expires:expOn});
    }
	
    if(CurrentCity != "" && CurrentCity != undefined){
        cookies.set('currentCity', _crrentCity, {path: '/',expires:expOn});
    }
    else{
        cookies.set('currentCity', server_variables.default_city, {path: '/',expires:expOn});
    }
	
    if(cookies.get('city').length > 15){
		cookies.set('city', server_variables.default_city, {path: '/',expires:expOn});
	}
}
function DOMReady(){
	$.smartbanner();

	var milliseconds = new Date().getTime();

	if (baseUrl == 'http://www.whatshot.in') {
		$.ajax({
			url:baseUrl+'/log/index/'+milliseconds,
			type:'GET',
			data:'entitytype='+server_variables.entitytype+'&entityid='+server_variables.entityid+'&request_uri='+server_variables.request_uri,
			success:function(data) {
			}
		});
	}
	manageCityCookie();

	$("img.lazy").unveil(200, function() {
	  $(this).load(function() {
	    this.style.opacity = 1;
	  });
	});
	
	$('.swipebox').swipebox();
	
	$("select").each(function(){
		$(this).wrap("<span class='select-wrapper'></span>");
		$(this).after("<span class='holder'></span>");
	});
	$("select").change(function(){
		var selectedOption = $(this).find(":selected").text();
		$(this).next(".holder").text(selectedOption);
	}).trigger('change');
	
	$('#searchformbtn').click(function(){
		$('#searchForm').submit();
	});
	
	$('.seach-overlay-box .close-icon').click(function(){
		$('.seach-overlay-box').hide();
	});
	
	$('#searchtextinput').typeahead({
		name: 'country',
		remote : baseUrl+'/search/autosuggestion?search=%QUERY',
		limit: 25
	});
	
	$('#bydate li > a').click(function(){
		$('#bydate li > a').parent().removeClass('active');
		$(this).parent().addClass('active');
		$('#bydatefeed').val($(this).attr('rel'));
		ajax_feed_filter_type();
	});
	
	$(".owl-carousel").owlCarousel({
		navigation : false,
		slideSpeed : 400,
		paginationSpeed : 400,
		singleItem:true,
		autoPlay : true,
		stopOnHover : true,
	});
	
	$("#similar_content_slider").owlCarousel({
		items : 3,
		navigation : true,
		slideSpeed : 400,
		paginationSpeed : 400,
		autoPlay : false,
		stopOnHover : true,
		singleItem: false,
	});
	

	$('#searchinputform').click(function(){
		$('#expandable').animate({ width: 320 }, 'slow');
		$('.overlay-search').remove();
		$('body').append('<div class="overlay-search"></div>');
		$('#searchinputform').focus();
	});
	
	$( "body" ).on( "click", ".overlay-search", function() {
		$('#expandable').animate({ width: 220 }, 'slow');
		$('.overlay-search').remove();
	});
	
	$("#searchtextinput").focus(function(){
		$('.searchbox').addClass('active');
	}).focusout(function() {
		$('.searchbox').removeClass('active');
	});
	
	$('#citieslist li').click(function(){
		var C = $(this);
		expOn = new Date();
		expOn.setTime(new Date().getTime() + 3600 * 24 * 365);
		cookies.set('city', C.attr('data-name'), {path: '/',expires:expOn});
		cookies.set('currentCity', C.attr('data-name'), {path: '/',expires:expOn});
		window.location.href = C.find('a').attr('href');
		return false;
	});
	
	$('.view_on_app').click(function(){
		send_deeplink();
	});

	$('.gotoleft').click(function(){
		var gotoleft = -($(".view_overlay").width() - 22);
		$( ".view_overlay" ).animate({
			left: gotoleft
		}, 1000, function() {
			$(this).find('i').addClass('fa-angle-double-right');
			$('.gotoleft').addClass('gotoright').removeClass('gotoleft');
		});
	});

	$(document.body).on('click', '.gotoright', function(){
		var gotoright = ($(".view_overlay").width() - 22);
		$( ".view_overlay" ).animate({
			left: 0
		}, 1000, function() {
			$(this).find('i').removeClass('fa-angle-double-right');
			$('.gotoright').addClass('gotoleft').removeClass('gotoright');
		});
	});


	if($('.view_gallery').length > 0){
		$( '.view_gallery' ).click( function( e ) {
			e.preventDefault();
			eventimages();
		});
	}

	$('.addscroll').click(function(){
		$('body,html').animate({
			scrollTop: $('.hp .item').height()
		}, 800);
		return false;
	});

	$('.addscrollmobile').click(function(){
		$('body,html').animate({
			scrollTop: $('.hp-mobile .item').height() + $('.navbar').height()
		}, 800);
		return false;
	});

	$('.tabbed_group > div').click(function(){
		var elem = $(this);
		var id = elem.attr('data-for');
		$('.tabbed_group > div').removeClass('active');
		elem.addClass('active');
		$('.contest > div').hide();
		$(id).fadeIn();	
		resizefeedimage();
	});

	$('.voted').click(function(){
		if(!$(this).hasClass('votedone')){
			var elem = $(this);
			var id = elem.attr('rel');
			if($('#iscontestruning').val() == 1){				
				if(cookies.get('isvotedbiryani') == null && elem.attr('data-for') == 'biryani'){
					voting(elem, 'isvotedbiryani');
				}else if(cookies.get('isvotedhaleem') == null && elem.attr('data-for') == 'haleem'){
					voting(elem, 'isvotedhaleem');
				}else{
					if(cookies.get('isvotedbiryani') != null && cookies.get('isvotedbiryani') != id && elem.attr('data-for') == 'biryani'){
						voting(elem, 'isvotedbiryani');	
					}else if(cookies.get('isvotedhaleem') != null && cookies.get('isvotedhaleem') != id && elem.attr('data-for') == 'haleem'){
						voting(elem, 'isvotedhaleem');	
					}
				}
			}
		}
		return false;
	});

	$('.show_past').click(function(){
		$('.past_results').slideToggle();
		return false;
	});

	$("#ac-gn-menustate").change(function() {
		if($('#smartbanner').length > 0){
			if(this.checked) {
				$('#smartbanner').css('position', 'fixed');
			}else{
				$('#smartbanner').css('position', 'static');
			}
		}
		if(this.checked) {
			$('html, body').css('overflow-x', 'hidden');
			$('html, body').css('overflow-y', 'hidden');
			$('html, body').css('height', '100%');
		}else{
			$('html, body').css('overflow-x', 'hidden');
			$('html, body').css('overflow-y', 'auto');
			$('html, body').css('height', 'auto');
		}
	});


	$(document.body).one('focus.textarea', '.tiptext', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
    })
    .on('input.textarea', '.tiptext', function(){
        var minRows = this.getAttribute('data-min-rows')|0,
            rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
        this.rows = minRows + rows;
    });

    $(document.body).on('keyup', '.tiptext', function(e){
		$(".char-remain").text((140 - $(this).val().length));
	});
}


( function( $, window, document, undefined ){
	'use strict';

	var elSelector		= '#navbar-fixed-top',
		$element		= $( elSelector );

	if( !$element.length ) return true;

	var elHeight		= 0,
		elTop			= 0,
		$document		= $( document ),
		dHeight			= 0,
		$window			= $( window ),
		wHeight			= 0,
		wScrollCurrent	= 0,
		wScrollBefore	= 0,
		wScrollDiff		= 0;

	$window.on( 'scroll', function()
	{
		elHeight		= $element.outerHeight();
		dHeight			= $document.height();
		wHeight			= $window.height();
		wScrollCurrent	= $window.scrollTop();
		wScrollDiff		= wScrollBefore - wScrollCurrent;

		elTop			= parseInt( $element.css( 'top' ) ) + wScrollDiff;
		var top = 0;
		if($('.android.shown').length > 0){
			top = 77;
		}
		
		if($(window).width() > 767){

			if( wScrollCurrent <= 0 ) // scrolled to the very top; element sticks to the top
				$element.css( 'top', top );

			else if( wScrollDiff > 0 ) // scrolled up; element slides in
				$element.css( 'top', elTop > 0 ? 0 : elTop );

			else if( wScrollDiff < 0 ) // scrolled down
			{
				if( wScrollCurrent + wHeight >= dHeight - elHeight )  // scrolled to the very bottom; element slides in
					$element.css( 'top', ( elTop = wScrollCurrent + wHeight - dHeight ) < 0 ? elTop : 0 );

				else // scrolled down; element slides out
					$element.css( 'top', Math.abs( elTop ) > elHeight ? -elHeight : elTop );
			}	
		}
		

		wScrollBefore = wScrollCurrent;
	});

})( jQuery, window, document );


var votesend = 0;
function voting(elem, cookiesname){
	if(votesend == 0){
		$('.'+elem.attr('data-for') + ' .lazy').removeClass('grayscale');
		$('.'+elem.attr('data-for') + ' .voted').html('VOTE NOW');
		$('.'+elem.attr('data-for') + ' .voted').removeClass('votedone');

		elem.html('VOTING...');
		$.ajax({
			url:baseUrl+'/quiz/voting',
			type:'POST',
			data:'nominationid='+elem.attr('rel')+'&category='+elem.attr('data-for'),
			beforeSend: function(){
				votesend = 1;
			},
			success:function(data) {
				votesend = 0;
				expOn = new Date();
				expOn.setTime(new Date().getTime() + 3600 * 3600 * 24 * 45);
				elem.attr('rel')
				cookies.set(cookiesname, elem.attr('rel'), {path: '/',expires:expOn});
				elem.addClass('votedone');
				elem.html('VOTED');
				var thanks_msg = elem.parent().parent().parent().find('.thanks_msg');
				thanks_msg.removeClass('dnone');
				elem.parent().parent().parent().find('.lazy').addClass('grayscale');
				setTimeout(function(){ thanks_msg.addClass('dnone'); }, 2000);
			}
		});
	}
}

function setquizheight(){
	if($('.hp .item').length > 0){
		var height = $(window).height() - $('.navbar').height();
		$('.hp .item').height(height);
		$('.haleemoverlay').addClass('dnone');
	}
}

function slideframeclosed(){
	$(".item-left").css('left', -50+'%');
	$(".item-right").css('right', -50+'%');
	$(".item-left").parent().addClass('dnone');
	$('.item-left').animate({
		left: 0
	}, 1000);
	$('.item-right').animate({
		right: 0
	}, 1000);	
}

function fbandtwitter(){
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=117653771586254";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');	
}

function closebanner(){
	$('#installer').css('display', 'none');
	$('#iphone').css('display', 'none');
	$('#android').css('display', 'none');
	$('#navbar-fixed-top').css('top', 0);
	
	expOn = new Date();
	expOn.setTime(new Date().getTime() + 3600 * 24 * 15);
	cookies.set('isappclose', 1, {path: '/',expires:expOn});
	return false;
}

function send_deeplink(){
	//var isiOS = navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod');
	var isiOS = false;
    var isAndroid = navigator.userAgent.match('Android');
	if (isiOS) {
		document.getElementById('loader').src = server_variables.deep_link;
	}else if (isAndroid) {
		window.location = server_variables.deep_link;
	}
    if (isiOS || isAndroid) {
    	fallbackLink = isAndroid ? 'https://play.google.com/store/apps/details?id=com.phdmobi.timescity' :
											 'https://itunes.apple.com/in/app/timescity-food-restaurant/id636515332?mt=8' ;
        window.setTimeout(function (){
        	//window.location.replace(fallbackLink);
			//setheader();
		}, 1);
    }
}

function setheader(){
	//var isiOS = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod'),
	var isiOS = false,
	isAndroid = navigator.userAgent.match('Android');

	if(isiOS){
		$('#iphone').css('display', 'block');
		$('#android').css('display', 'none');
	}else if (isAndroid) {
		$('#iphone').css('display', 'none');
		$('#android').css('display', 'block');
	}

	if (isiOS || isAndroid) {
		$('#installer').css('display', 'block');
		$('#navbar-fixed-top').css('top', 60);

		if($('.view_on_app').length > 0){
			$('.view_on_app').show();
		}
	}
}

function AjaxResponse(access_token, hometown, location){
    exptime = new Date();
    exptime.setTime(new Date().getTime() + 3600000 * 24 * 365);

	$.ajax( {
		url:baseUrl+'/profile/facebooklogin',
		type:'POST',
		data: 'access_token='+access_token+'&hometown='+hometown+'&location='+location,
		success:function(data) {
			var results = eval( '(' + data + ')' );
			if(results.status == 'sucess'){
				//cookies.set('whatshotuserkey', results.userkey, {path: '/',expires:exptime});
				document.location.reload();
			}else{
				ResetAnimate();
			}
		}
	});
}

function LodingAnimate(){
    $("#LoginButton").hide();
    $("#results").html('<img src="img/ajax-loader.gif" /> Please Wait Connecting...');
}

function ResetAnimate()
{
    $("#LoginButton").show();
    $("#results").html('');
}

function ajaxlogout(){
	
	$.ajax( {
		url:baseUrl+'/profile/facebooklogout',
		async : false,
		type:'POST',
		data: 'whatshotuserkey='+whkey,
		success:function(data) {
			document.location.reload();
		}
	});
}

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
    {scope: server_variables.fbPermissions});
}


function addtowishlistwithlogin(entityid, city, entitytype, title, entity_title){
	FB.login(function(response) {      
        if (response.status === "connected")
        {
        	$("#wishlist"+entityid+" .resetdimenstion").removeClass('dnone');
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
	                wishlistAjaxResponse(access_token, hometown, location, entityid, city, entitytype, title, entity_title);
	            }
			});
        }
    },
    {scope: server_variables.fbPermissions});
}

function wishlistAjaxResponse(access_token, hometown, location, entityid, city, entitytype, title, entity_title){
    exptime = new Date();
    exptime.setTime(new Date().getTime() + 3600000 * 24 * 365);
	$.ajax({
		url:baseUrl+'/profile/facebooklogin',
		type:'POST',
		data: 'access_token='+access_token+'&hometown='+hometown+'&location='+location,
		success:function(data) {
			var results = eval( '(' + data + ')' );
			if(results.status == 'sucess'){
				//cookies.set('whatshotuserkey', results.userkey, {path: '/',expires:exptime});
				showishlist(results.ssoid, entityid, city, entitytype, title, entity_title, 1);
			}else{
			}
			//$(".resetdimenstion").addClass('dnone');
		}
	});
}

function showishlist(userid, entityid, city, entitytype, title, entity_title, islogin){
	var islogin = islogin || 0;
	if(islogin == 1){
		//$("#wishlist"+entityid+" .resetdimenstion").removeClass('dnone');
		$.ajax({
			url:baseUrl+'/profile/getwishliststatus',
			type:'POST',
			data: 'userid='+userid+'&entityid='+entityid+'&entitytype='+entitytype,
			success:function(data) {
				var results = eval( '(' + data + ')' );
				if(results.status != 1){
					generatewishlistpopup(userid, entityid, city, entitytype, title, entity_title, islogin);
				}else{
					$("#wishlist"+entityid+" .wishlist-wrapper").removeClass('add-wishlist');
					$("#wishlist"+entityid+" .wishlist-wrapper").addClass('added-wishlist');
					$("#wishlist"+entityid+" .wishlist_add_btn").parent().addClass('dnone');
					$("#wishlist"+entityid+" .wishlist_added_btn").parent().removeClass('dnone');
					$("#wishlist"+entityid+" .resetdimenstion").addClass('dnone');
					document.location.reload();
				}
			}
		});
	}else{
		generatewishlistpopup(userid, entityid, city, entitytype, title, entity_title, islogin);
	}
}

function generatewishlistpopup(userid, entityid, city, entitytype, title, entity_title, islogin){
	var html = '<div class="wishlist-lightbox lightbox"><div class="wishlist-add"><div class="tiphead">NOTE:</div><div class="wihlist-title">Add <span>'+entity_title+'</span> to my '+server_variables.wishlistname+'.<br><textarea class="tiptext border-bottom" rows="1" data-min-rows="1" maxlength="140" placeholder="Because I Like"></textarea><div class="char-remain">140</div></div><div class="btn-group float-right"><div class="btn btn-primary cancel" onclick="cancelwishlist(\''+islogin+'\')">CANCEL</div><div class="resetdimenstion dnone float-right"><img src="'+ baseUrl +'/img/ajax-loader.gif"></div><div class="btn btn-primary add" onclick="addwishlist(\''+userid+'\', \''+entityid+'\', \''+city+'\', \''+entitytype+'\', \''+title+'\', \''+entity_title+'\', \''+islogin+'\')">ADD</div></div></div><div class="overlay"></div></div>';

	$('#wishlist'+entityid).append(html);
	$("html, body").animate({scrollTop: $(".wishlist-lightbox").offset().top-100}, 1000); 
}


function cancelwishlist(islogin){
	$(".resetdimenstion").addClass('dnone');
	$('.wishlist-container .wishlist-lightbox').remove();
	if(islogin == 1){
		document.location.reload();
	}
}

function addwishlist(userid, entityid, city, entitytype, title, entity_title, islogin){
	$(".resetdimenstion").addClass('dnone');
	$("#wishlist"+entityid+" .wishlist-lightbox .resetdimenstion").removeClass('dnone');
	$.ajax({
		url:baseUrl+'/profile/addwishlist',
		type:'POST',
		data: 'userid='+userid+'&entityid='+entityid+'&city='+city+'&entitytype='+entitytype+'&tip='+$(".tiptext").val(),
		success:function(data) {
			var results = eval( '(' + data + ')' );
			if(results.status == 1){
				$('.wishlist-container .wishlist-add').html('<div class="successmsg"><div class="successarea"><img src="'+baseUrl+'/img/tip-success.png"></div><div class="sucess-msg"><strong>Awesome!</strong><br><span>'+entity_title+'</span> is added to your '+server_variables.wishlistname+'. You can find all items of your '+server_variables.wishlistname+' on your profile.</div><div class="btn-group makecenter"><div class="btn btn-primary cancel" onclick="cancelwishlist(\''+islogin+'\')">OK</div></div></div>');
				
			}else{
				$('.wishlist-container .wishlist-add').html('<div class="successmsg"><div class="successarea"><img src="'+baseUrl+'/img/tip-success.png"></div><div class="sucess-msg"><strong>Oops!</strong><br><span>'+entity_title+'</span> is already added to your '+server_variables.wishlistname+'. You can find all items of your '+server_variables.wishlistname+' on your profile.</div><div class="btn-group makecenter"><div class="btn btn-primary cancel" onclick="cancelwishlist(\''+islogin+'\')">CANCEL</div></div></div>');
			}
			$("#wishlist"+entityid+" .wishlist-wrapper").removeClass('add-wishlist');
			$("#wishlist"+entityid+" .wishlist-wrapper").addClass('added-wishlist');
			$("#wishlist"+entityid+" .wishlist_add_btn").parent().addClass('dnone');
			$("#wishlist"+entityid+" .wishlist_added_btn").parent().removeClass('dnone');
			$("#wishlist"+entityid+" .resetdimenstion").addClass('dnone');
		}
	});
}

function archievewishlist(id){
	if(confirm('Are you sure you want to remove this item from your '+server_variables.wishlistname+'?')){
		var upperparentid = $("#wishlist_"+id).attr('data-rel');
		var countvalue = $('#count'+upperparentid).html();
		$("#wishlist_"+id+" .resetdimenstion").removeClass('dnone');
		$.ajax({
			url:baseUrl+'/profile/removewishlist',
			type:'POST',
			data: 'id='+id,
			success:function(data) {
				var results = eval( '(' + data + ')' );
				if(results.status == 1){
					if(countvalue > 1){
						$('#count'+upperparentid).html(countvalue-1)		
						$("#wishlist_"+id).slideUp();	
					}else{
						$('#getwishlist'+upperparentid).slideUp();
					}
				}else{
					alert('There is some problem to removing from '+server_variables.wishlistname+'. Please try again');
				}
			}
		});
	}
}
