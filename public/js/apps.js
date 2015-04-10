var $sidebar = $('.sidebar'),
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

$(window).load(function() {
	$("select").each(function(){
		$(this).wrap("<span class='select-wrapper'></span>");
		$(this).after("<span class='holder'></span>");
	});
	$("select").change(function(){
		var selectedOption = $(this).find(":selected").text();
		$(this).next(".holder").text(selectedOption);
	}).trigger('change');
	
	/** BEGIN BACK TO TOP **/
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
	/** END BACK TO TOP **/
	
	resizefeedimage();
	$( window ).resize(function() {
	  resizefeedimage();
	});
	
	$('#searchbox').click(function(){
		$('.seach-overlay-box').height($(document).height());
		$('.seach-overlay-box').show();
		$('#searchtextinput').focus();
	});
	
	$('#searchformbtn').click(function(){
		$('#searchForm').submit();
	});
	
	$('.seach-overlay-box .close-icon').click(function(){
		$('.seach-overlay-box').hide();
	});
	
	if($('#getallfeeds').length > 0){
		view_feed_with_ajax(baseUrl+'search/index', 0, 12, 'getallfeeds', '', '', 'all');
	}
	
	$('#searchtextinput').typeahead({
		name: 'country',
		remote : baseUrl+'search/autosuggestion?search=%QUERY'
	});	
	
	$('#searchForm').submit(function(){
		$('#searchallfeeds').html('');
		view_feed_with_ajax($('#mainUrl').val(), $('#start').val(), $('#limit').val(), 'searchallfeeds', $('#searchtextinput').val());
		return false;
	});
	
	$('#populartag li > a').click(function(){
		$('#populartag li > a').parent().removeClass('active');
		$(this).parent().addClass('active');
		$('#tags').val($(this).html());
		ajax_feed_filter_type();
	});
	
	$('#bydate li > a').click(function(){
		$('#bydate li > a').parent().removeClass('active');
		$(this).parent().addClass('active');
		$('#bydatefeed').val($(this).html());
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
	
	setTimeout(function(){
		$(".owl-item").owlCarousel({
			autoPlay: 3000, //Set AutoPlay to 3 seconds
			items: 1
		});
	}, 1000);
	
	$('.swipebox').swipebox();
	
});


function ajax_feed_filter_type(){
	$('#getallfeeds').html('');
	view_feed_with_ajax(baseUrl+'search/index', 0, 12, 'getallfeeds', '', $('#tags').val(), $('#bydatefeed').val());
}

function resizefeedimage(){
	$(".work-item img").each(function( index ) {
		$(this).height(($(this).width()));
	});
}

$.fn.center = function () {
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

function view_feed_with_ajax(mainURL, start, limit, parentId, searchval='', tags='', bydate=''){
	$('#'+parentId).append('<div class="loader"><img src="'+baseUrl+'img/ajax-loader.gif"></div>');
	$('.loadmore .btn').attr('disabled','disabled');
	$.ajax( {
		url:mainURL,
		type:'POST',
		data: 'searchkeyword='+searchval+'&start='+start+'&limit='+limit+'&tags='+tags+'&bydate='+bydate+'&mainurl='+mainURL+'&parentid='+parentId,
		success:function(data) {
			var splitdata = data.split("<-!-###@###->");
			$('.loader').remove();
			$('#'+parentId).append(splitdata[0]);
			$('#'+parentId).parent().find('.loadmore').html(splitdata[1]);
			resizefeedimage();
			setTimeout(function(){ resizefeedimage(); }, 1000);
			if($('.seach-overlay-box').css('display') == 'block'){
				$('.seach-overlay-box').height($(document).height());
			}
		}
	});
}