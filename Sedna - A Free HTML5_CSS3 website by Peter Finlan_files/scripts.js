$(document).ready(function() {

	/***************** Nav Transformicon ******************/
	
	/* When user clicks the Icon */
	$('.nav-toggle').click(function() {
		$(this).toggleClass('active');
		$('.header-nav').toggleClass('open');
		event.preventDefault();
	});
	/* When user clicks a link */
	$('.header-nav li a').click(function() {
		$('.nav-toggle').toggleClass('active');
		$('.header-nav').toggleClass('open');

	});
	
	/****************** HP Slider ***************/
	$('.carousel').carousel({
	  interval: 6000,
	  pause: "true"
	});
	var $item = $('.carousel .item');
	var $wHeight = $(window).height();
	
	$item.height($wHeight);
	$item.addClass('full-screen');
	
	$('.carousel img').each(function() {
	  var $src = $(this).attr('src');
	  var $color = $(this).attr('data-color');
	  $(this).parent().css({
		'background-image' : 'url(' + $src + ')',
		'background-color' : $color
	  });
	  $(this).remove();
	});
	
	$(window).on('resize', function (){
	  $wHeight = $(window).height();
	  $item.height($wHeight);
	});

	/***************** Header BG Scroll ******************/

	$(function() {
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();

			if (scroll >= 20) {
				$('section.navigation').addClass('fixed');
				$('header').css({
					"border-bottom": "none",
					"padding": "0"
				});
				$('header .member-actions').css({
					"top": "26px",
				});
				$('header .navicon').css({
					"top": "34px",
				});
			} else {
				$('section.navigation').removeClass('fixed');
				$('header').css({
					/*"border-bottom": "solid 1px rgba(255, 255, 255, 0.2)",*/
					"padding": "0"
				});
				$('header .member-actions').css({
					"top": "41px",
				});
				$('header .navicon').css({
					"top": "48px",
				});
			}
		});
	});
});
