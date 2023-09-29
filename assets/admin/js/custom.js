(function($) {
	"use strict";
	// ______________Full screen
	$("#fullscreen-button").on("click", function toggleFullScreen() {
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	})
	
	// ______________ Color-skin
	$(document).on("click", "a[data-theme]", function(e) {
        $("head link#theme").attr("href", $(this).data("theme"));
        $(this).toggleClass('active').siblings().removeClass('active');
    });
	
	
	// ______________Active Class
	$(document).ready(function() {
		$(".donately_menu-list li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
		$(".horizontal-megamenu li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().parent().parent().parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
		$(".donately_menu-list .sub-menu .sub-menu li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
	});
	
	
	// ______________ PAGE LOADING
	$(window).on("load", function(e) {
		$("#global-loader").fadeOut("slow");
	})
	
	// ______________ BACK TO TOP BUTTON
	$(window).on("scroll", function(e) {
		if ($(this).scrollTop() > 0) {
			$('#back-to-top').fadeIn('slow');
		} else {
			$('#back-to-top').fadeOut('slow');
		}
	});
	$("#back-to-top").on("click", function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	// ______________ COVER IMAGE
	$(".cover-image").each(function() {
		var attr = $(this).attr('data-image-src');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).css('background', 'url(' + attr + ') center center');
		}
	});

	var toggleSidebar = function() {
		var w = $(window);
		if(w.outerWidth() <= 1024) {
			$("body").addClass("sidebar-gone");
			$(document).off("click", "body").on("click", "body", function(e) {
				if($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
					$("body").removeClass("sidebar-show");
					$("body").addClass("sidebar-gone");
					$("body").removeClass("search-show");
				}
			});
		}else{
			$("body").removeClass("sidebar-gone");
		}
	}
	toggleSidebar();
	$(window).resize(toggleSidebar);
	
	/** Constant div card */
	const DIV_CARD = 'div.card';
	/** Initialize tooltips */
	$('[data-toggle="tooltip"]').tooltip();
	/** Initialize popovers */
	$('[data-toggle="popover"]').popover({
		html: true
	});
	
	// ______________ FUNCTION FOR REMOVE CARD
	$('[data-toggle="card-remove"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.remove();
		e.preventDefault();
		return false;
	});
	
	// ______________ FUNCTIONS FOR COLLAPSED CARD
	$('[data-toggle="card-collapse"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-collapsed');
		e.preventDefault();
		return false;
	});

	// ______________ CARD FULL SCREEN
	$('[data-toggle="card-fullscreen"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-fullscreen').removeClass('card-collapsed');
		e.preventDefault();
		return false;
	});
	
	

	/*Header Switcher*/
	$('#myonoffswitch').click(function () {    
		if (this.checked) {
			$('body').addClass('default-header');
			$('body').removeClass('light-header');
			localStorage.setItem("default-header", "True");
		}
		else {
			$('body').removeClass('default-header');
			localStorage.setItem("default-header", "false");
		}
	});
	$('#myonoffswitch1').click(function () {    
		if (this.checked) {
			$('body').addClass('light-header');
			$('body').removeClass('default-header');
			localStorage.setItem("light-header", "True");
		}
		else {
			$('body').removeClass('light-header');
			localStorage.setItem("light-header", "false");
		}
	});
	
	/*Horizontal-menu Switcher*/
	$('#myonoffswitch2').click(function () {    
		if (this.checked) {
			$('body').addClass('light-hor');
			$('body').removeClass('color-hor');
			$('body').removeClass('dark-hor');
			localStorage.setItem("light-hor", "True");
		}
		else {
			$('body').removeClass('light-hor');
			localStorage.setItem("light-hor", "false");
		}
	});
	$('#myonoffswitch3').click(function () {    
		if (this.checked) {
			$('body').addClass('color-hor');
			$('body').removeClass('default-hor');
			$('body').removeClass('dark-hor');
			localStorage.setItem("color-hor", "True");
		}
		else {
			$('body').removeClass('color-hor');
			localStorage.setItem("color-hor", "false");
		}
	});
	$('#myonoffswitch4').click(function () {    
		if (this.checked) {
			$('body').addClass('dark-hor');
			$('body').removeClass('color-hor');
			$('body').removeClass('light-hor');
			localStorage.setItem("dark-hor", "True");
		}
		else {
			$('body').removeClass('dark-hor');
			localStorage.setItem("dark-hor", "false");
		}
	});	
	
	/*Left-menu Switcher*/
	$('#myonoffswitch5').click(function () {    
		if (this.checked) {
			$('body').addClass('dark-leftmenu');
			$('body').removeClass('light-leftmenu');
			$('body').removeClass('color-leftmenu');
			$('body').removeClass('menu-style1');
			localStorage.setItem("dark-leftmenu", "True");
		}
		else {
			$('body').removeClass('dark-leftmenu');
			localStorage.setItem("dark-leftmenu", "false");
		}
	});	
	$('#myonoffswitch6').click(function () {    
		if (this.checked) {
			$('body').addClass('light-leftmenu');
			$('body').removeClass('dark-leftmenu');
			$('body').removeClass('color-leftmenu');
			$('body').removeClass('menu-style1');
			localStorage.setItem("light-leftmenu", "True");
		}
		else {
			$('body').removeClass('light-leftmenu');
			localStorage.setItem("light-leftmenu", "false");
		}
	});	
	$('#myonoffswitch7').click(function () {    
		if (this.checked) {
			$('body').addClass('color-leftmenu');
			$('body').removeClass('dark-leftmenu');
			$('body').removeClass('light-leftmenu');
			$('body').removeClass('menu-style1');
			localStorage.setItem("color-leftmenu", "True");
		}
		else {
			$('body').removeClass('color-leftmenu');
			localStorage.setItem("color-leftmenu", "false");
		}
	});	
	$('#myonoffswitch8').click(function () {    
		if (this.checked) {
			$('body').addClass('menu-style1');
			$('body').removeClass('dark-leftmenu');
			$('body').removeClass('light-leftmenu');
			$('body').removeClass('color-leftmenu');
			localStorage.setItem("menu-style1", "True");
		}
		else {
			$('body').removeClass('menu-style1');
			localStorage.setItem("menu-style1", "false");
		}
	});
	
})(jQuery);
