/* global jQuery */
/* global document */
jQuery(function() {
	'use strict';
	document.addEventListener("touchstart", function(e) {}, false);
	jQuery(function() {
		jQuery('body').wrapInner('<div class="donately_menu_container" />');
		jQuery('<div class="overlapblackbg"></div>').prependTo('.donately_menu');
		jQuery('#horizontal-navtoggle').on("click", function() {
			jQuery('body').toggleClass('active');
		});
		jQuery('#horizontal-navtoggle1').on("click", function(e) {
			jQuery('body').toggleClass('active');
		});
		jQuery('#horizontal-navtoggle2').on("click", function(e) {
			jQuery('body').toggleClass('active');
		});
		jQuery('.overlapblackbg').on("click", function(e) {
			jQuery("body").removeClass('active');
		});
		jQuery('.donately_menu > .donately_menu-list > li').has('.sub-menu').prepend('<span class="donately_menu-click"><i class="donately_menu-arrow fa fa-angle-down"></i></span>');
		jQuery('.donately_menu > .donately_menu-list > li').has('.horizontal-megamenu').prepend('<span class="donately_menu-click"><i class="donately_menu-arrow fa fa-angle-down"></i></span>');
		jQuery('.donately_menu-click').on("click", function(e) {
			jQuery(this).toggleClass('ws-activearrow').parent().siblings().children().removeClass('ws-activearrow');
			jQuery(".donately_menu > .donately_menu-list > li > .sub-menu, .horizontal-megamenu").not(jQuery(this).siblings('.donately_menu > .donately_menu-list > li > .sub-menu, .horizontal-megamenu')).slideUp('slow');
			jQuery(this).siblings('.sub-menu').slideToggle('slow');
			jQuery(this).siblings('.horizontal-megamenu').slideToggle('slow');
		});
		jQuery('.donately_menu > .donately_menu-list > li > ul > li').has('.sub-menu').prepend('<span class="donately_menu-click02"><i class="donately_menu-arrow fa fa-angle-down"></i></span>');
		jQuery('.donately_menu > .donately_menu-list > li > ul > li > ul > li').has('.sub-menu').prepend('<span class="donately_menu-click02"><i class="donately_menu-arrow fa fa-angle-down"></i></span>');
		jQuery('.donately_menu-click02').on("click", function(e) {
			jQuery(this).children('.donately_menu-arrow').toggleClass('donately_menu-rotate');
			jQuery(this).siblings('li > .sub-menu').slideToggle('slow');
		});
		jQuery(window).on('resize', function(e) {
			if (jQuery(window).outerWidth() < 992) {
				jQuery('.donately_menu').css('height', jQuery(this).height() + "px");
				jQuery('.donately_menu_container').css('min-width', jQuery(this).width() + "px");
			} else {
				jQuery('.donately_menu').removeAttr("style");
				jQuery('.donately_menu_container').removeAttr("style");
				jQuery('body').removeClass("active");
				jQuery('.donately_menu > .donately_menu-list > li > .horizontal-megamenu, .donately_menu > .donately_menu-list > li > ul.sub-menu, .donately_menu > .donately_menu-list > li > ul.sub-menu > li > ul.sub-menu, .donately_menu > .donately_menu-list > li > ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu').removeAttr("style");
				jQuery('.donately_menu-click').removeClass("ws-activearrow");
				jQuery('.donately_menu-click02 > i').removeClass("donately_menu-rotate");
			}
		});
		jQuery(window).trigger('resize');
	});
	//Mobile Search Box
	jQuery(window).on("load", function(e) {
		jQuery('.horizontal-header .wssearch').on("click", function(e) {
			jQuery(this).toggleClass("wsopensearch");
		});
		jQuery("body, .wsopensearch .fa.fa-times").on("click", function(e) {
			jQuery(".wssearch").removeClass('wsopensearch');
		});
		jQuery(".wssearch, .wssearchform form").on("click", function(e) {
			e.stopPropagation();
		});
	});
}());