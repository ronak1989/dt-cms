$(document).ready(function() {
	$('#q').bind("searchkey",function(e){
	   //do stuff here
	   $("#search").submit();
	});
	$('#q').keyup(function(e){
    if(e.keyCode == 13)
    {
        $(this).trigger("searchkey");
    }
	});
	header_height = $(".navigation").height();
	var menuSearchBtn = document.querySelector('#c-button--search');
	var menuSearchBtnMob = document.querySelector('#c-button--search-mob');
		menuSearchBtn.addEventListener('click', function(e) {
		    e.preventDefault;
		    menuSearch.open();
		});

		menuSearchBtnMob.addEventListener('click', function(e) {
		    e.preventDefault;
		    menuSearch.open();
		});

		var shareIcons = new Menu({
		    wrapper: '#body-container',
		    type: 'shareicons',
		    menuOpenerClass: '.c-button',
		    maskId: '#c-mask'
		});

		var shareIconsBtn = document.querySelector('#c-button--shareicons');
		var shareIconsBtnMobile = document.querySelector('#c-button--shareicons-mob');

		shareIconsBtn.addEventListener('click', function(e) {
		    e.preventDefault;
		    shareIcons.open();
		});
		shareIconsBtnMobile.addEventListener('click', function(e) {
		e.preventDefault;
		    shareIcons.open();
		});

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
	var $wWidth = $(window).width();
	var $wHeight = $(window).height();
	if($wWidth<780){
		$item.height($wHeight-65);
		$item.addClass('full-screen');
	}else{
		$item.height($wHeight);
		$item.addClass('full-screen');
	}


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
		/*var s = $("#news-widget");
		var header_height = $(".navigation").height();
		var floating_space =  $('.article-content').height();
		console.log(floating_space);
    var pos = s.offset();*/
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			if (scroll >= 20) {
				$('section.navigation').addClass('fixed');
				$('header').css({
					"border-bottom": "none",
					"padding": "10px 0"
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
					"padding": "10px 0"
				});
				$('header .member-actions').css({
					"top": "41px",
				});
				$('header .navicon').css({
					"top": "48px",
				});
			}

			/*if (scroll+header_height >= pos.top && header_height + s.height()+30 < floating_space) {
          s.addClass("stick");
          s.css({'top':header_height+30});
      } else {
      	 console.log(scroll+header_height)
          s.removeClass("stick");
          s.css({'top':''});
      }*/

		});
		$('#horizontal-nav-toggle').on('click',function(){
			var scroll = $(window).scrollTop();
			$('.bigmegamenu').toggle();
			var visible = $('.bigmegamenu').is(":visible");
			console.log(visible);
			var scroll = $(window).scrollTop();
			if(visible){
				if (scroll >= 20) {
					$('section.navigation').addClass('fixed');
					$('header').css({
						"border-bottom": "none",
						"padding": "10px 0"
					});
					$('header .member-actions').css({
						"top": "26px",
					});
					$('header .navicon').css({
						"top": "34px",
					});
				} else {
					$('section.navigation').addClass('fixed');
					$('header').css({
						/*"border-bottom": "solid 1px rgba(255, 255, 255, 0.2)",*/
						"padding": "10px 0"
					});
					$('header .member-actions').css({
						"top": "41px",
					});
					$('header .navicon').css({
						"top": "48px",
					});
				}
			}else{
				if (scroll >= 20) {
					$('section.navigation').addClass('fixed');
					$('header').css({
						"border-bottom": "none",
						"padding": "10px 0"
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
						"padding": "10px 0"
					});
					$('header .member-actions').css({
						"top": "41px",
					});
					$('header .navicon').css({
						"top": "48px",
					});
				}
			}
			shareIconsBtn.close();
			menuSearchBtn.close();
		});
	});
});
