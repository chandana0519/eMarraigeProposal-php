$(document).ready(function() {
	
	$(".js-section-editable").mouseenter(function() {
		var btn =  jQuery(this).find(".ui-icon");
		if (!btn.hasClass('ui-icon-active')) {
			btn.addClass("ui-icon-hover");
		}
	});

	$(".js-section-editable").mouseleave(function() {
		var btn = jQuery(this).find(".ui-icon");
		if (!btn.hasClass('ui-icon-active')) {
			if ( btn.hasClass('ui-icon-hover') ) {
				btn.removeClass("ui-icon-hover");
			}
		}
	});

	$(".js-section-editable").click(function() {
		var btn =  jQuery(this).find(".ui-icon");
		if (!btn.hasClass('ui-icon-active')) {
			btn.removeClass("ui-icon-hover").addClass("ui-icon-active");
			jQuery(this).find(".section-editable-view").removeClass("view-mode").addClass("hidden-mode");
			jQuery(this).find(".section-editable-edit").removeClass("hidden-mode").addClass("view-mode");
		}				
    });

    $(".js-section-editable-btn").click(function() {
    	var btn = jQuery(this).find(".ui-icon");
		if (btn.hasClass('ui-icon-active')) {
			btn.removeClass("ui-icon-active");
			jQuery(this).parent().find(".section-editable-view").removeClass("hidden-mode").addClass("view-mode");
			jQuery(this).parent().find(".section-editable-edit").removeClass("view-mode").addClass("hidden-mode");
		}else{
			btn.removeClass("ui-icon-hover").addClass("ui-icon-active");
			jQuery(this).parent().find(".section-editable-view").removeClass("view-mode").addClass("hidden-mode");
			jQuery(this).parent().find(".section-editable-edit").removeClass("hidden-mode").addClass("view-mode");
		}
		return false;
    });

});