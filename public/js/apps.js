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
	
	if($(window).width() > 640){
		if($(window).scrollTop() > 100){
			$('.navbar.navbar-default').addClass('makeheaderintera');
		}else{
			$('.navbar.navbar-default').removeClass('makeheaderintera');
		}
	}
	
});

$(window).load(function() {
	$(function () {
		$("#back-top").hide();
	});
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
	$( window ).resize(function() {
	  resizefeedimage();
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
			width = $(this).parent().parent().parent().width();
			height = $(this).parent().parent().parent().height();
		}
		$(this).height(($(this).width()));
	});

	//$(".defaultads img").css('width',width);
	//$(".defaultads img").css('height',height);

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
	var milliseconds = new Date().getTime();
	$.ajax({
		url:baseUrl+'/log/index/'+milliseconds,
		type:'GET',
		data:'entitytype='+server_variables.entitytype+'&entityid='+server_variables.entityid+'&request_uri='+server_variables.request_uri,
		success:function(data) {
		}
	});
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
