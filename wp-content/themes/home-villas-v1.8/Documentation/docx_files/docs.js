/*! fluent-docs 1.0.1 docs.min.js 2014-07-31 1:27:18 PM */
//!function(a){"use strict";a.fluentdocs=a.fluentdocs||{},a(document).on("click",".documentation-contents-sections > li > a",function(){var b=a(this).closest("li");return b.hasClass("active")||(b.closest("ul").find(".active").removeClass("active").find("ul").slideUp(),b.addClass("active").find("ul").first().slideDown()),a.fluentdocs.scroll(),!1}),a(document).on("click",".documentation-contents-section-articles > li > a",function(){var b=a(this).closest("li");return 0!==b.find("ul").first().length?b.find("ul").first().slideDown():a("html, body").animate({scrollTop:a(a(this).attr("href")).position().top-10}),a.fluentdocs.scroll(),!1}),a(document).on("click",".documentation-content-wrapper .top",function(){return a("html, body").animate({scrollTop:a(".documentation-contents-wrapper").position().top-10}),!1}),a(document).on("click",".documentation-likes a",function(){if(a(this).closest("p").hasClass("done"))return!1;a(this).closest("p").addClass("done").find("a").addClass("disabled"),a(this).removeClass("disabled").addClass("clicked"),a(this).closest("p").find("a.disabled").fadeOut();var b=this;return a.post(a(this).attr("href"),function(c){console.log(c),console.log(this),"1"==c?a(b).closest("p").find(".response.good").fadeIn():"2"==c&&a(b).closest("p").find(".response.bad").fadeIn()}),!1});var b=document.URL.substr(document.URL.indexOf("#")+1);""!==b?a('.documentation-contents-sections a[href="#'+b+'"]').closest(".section").find("a").trigger("click"):a(".documentation-contents-sections > li > a").first().trigger("click");var c=a(".documentation-contents-scroll-wrapper").css({position:"absolute",display:"block",width:"100%"});c.parent().css({position:"relative",height:a(".documentation-content-wrapper").height()});var d=c.offset().top-50;a(window).scroll(function(){a.fluentdocs.scroll()}),a.fluentdocs.scroll=function(){var a=window.pageYOffset||document.documentElement.scrollTop;if(d>a)c.stop().animate({top:0},500);else{var b=a-d,e=c.parent().height()-c.height();b>e&&(b=e),c.stop().animate({top:b},500)}}}(jQuery);

var $ = jQuery;
$(window).scroll(function() {
if ($(this).scrollTop() > 210){  
    $('.documentation-contents-wrapper').addClass("sticky");
  }
  else{
    $('.documentation-contents-wrapper').removeClass("sticky");
  }
});



(function($) {
    'use strict';
    
    $.fluentdocs = $.fluentdocs || {};

	$(document).on('click', '.documentation-contents-sections > li > a', function(){
		var li = $(this).closest('li');
		if(!li.hasClass('active')){
			li.closest('ul').find('.active').removeClass('active').find('ul').slideUp();
			li.addClass('active').find('ul').first().slideDown();
		}
		$.fluentdocs.scroll();
		return false;
	});

	$(document).on('click', '.documentation-contents-section-articles > li > a', function(){
		var li = $(this).closest('li');
		if(li.find('ul').first().length !== 0){
			li.find('ul').first().slideDown();
		}else{
			$('html, body').animate({scrollTop: ($($(this).attr('href')).position().top - 10)});
		}
		$.fluentdocs.scroll();
		return false;
	});

	$(document).on('click', '.documentation-content-wrapper .top', function(){
		$('html, body').animate({scrollTop: ($('.documentation-contents-wrapper').position().top - 10)});
		return false;
	});

	$(document).on('click', '.documentation-likes a', function(){
		if($(this).closest('p').hasClass('done')){
			return false;
		}
		$(this).closest('p').addClass('done').find('a').addClass('disabled');
		$(this).removeClass('disabled').addClass('clicked');
		$(this).closest('p').find('a.disabled').fadeOut();
		var $this = this;
		$.post($(this).attr('href'), function(response){
			console.log(response);
			console.log(this);
			if(response == '1'){
				$($this).closest('p').find('.response.good').fadeIn();
			}else if(response == '2'){
				$($this).closest('p').find('.response.bad').fadeIn();
			}
		});
		return false;
	});

	var hash = document.URL.substr(document.URL.indexOf('#')+1);

	if(hash !== ''){
		$('.documentation-contents-sections a[href="#'+hash+'"]').closest('.section').find('a').trigger('click');
	}else{
		$('.documentation-contents-sections > li > a').first().trigger('click');
	}

	var el=$('.documentation-contents-scroll-wrapper').css({position: 'relative'});
	el.parent().css({position: 'relative'});
	var elpos=el.offset().top - 50;
	$(window).scroll(function () {
		$.fluentdocs.scroll();
	});

	$.fluentdocs.scroll = function(){
		var top = window.pageYOffset || document.documentElement.scrollTop;
		if(top<elpos){
			el.stop().animate({'top':0},500);
		}else{
			var newpos = top-elpos;
			var maxpos = el.parent().height() - el.height();
			if(newpos > maxpos){
				newpos = maxpos;
			}
			el.stop().animate({'top':newpos},500);
		}
	};

})(jQuery);
