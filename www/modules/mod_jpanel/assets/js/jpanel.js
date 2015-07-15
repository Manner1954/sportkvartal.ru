/*
 * @package		mod_jpanel
 * @copyright	Copyright (C) 2012 Girolamo Tomaselli All rights reserved.
 * @email		girotomaselli@gmail.com
 * @website		http://bygiro.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

function openJpanel(jpanel_id){	
	var jPanel = jQuery(jpanel_id),
		side = jPanel.attr('data-jpanel-side');
	
	switch(side){
		case 'right':
			jPanel.stop(true, false).animate({
			   right: '0px'
			}, 900);	
		break;
		
		case 'left':
			jPanel.stop(true, false).animate({
			   left: '0px'
			}, 900);	
		break;
		
		case 'top':
			jPanel.stop(true, false).animate({
			   top: '0px'
			}, 900);	
		break;
		
		case 'bottom':
			jPanel.stop(true, false).animate({
			   bottom: '0px'
			}, 900);	
		break;
	}
	
	jPanel.addClass('jpanel_open');
}

function closeJpanel(jpanel_id){
	var jPanel = jQuery(jpanel_id),
		jPanel_content = jQuery(jpanel_id + ' .jpanelContent'),
		side = jPanel.attr('data-jpanel-side');
		
	switch(side){
		case 'right':
			jPanel.animate({
				right:  ((jPanel_content.width() + 11) * -1)+'px'
			}, 800);	
		break;
		
		case 'left':
			jPanel.animate({
				left:  ((jPanel_content.width() + 11) * -1)+'px'
			}, 800);	
		break;
		
		case 'top':
		   jPanel.animate({
				top: ((jPanel_content.height() + 1) * -1)+'px'
			}, 800);	
		break;
		
		case 'bottom':
		   jPanel.animate({
				bottom: ((jPanel_content.height() + 1) * -1)+'px'
			}, 800);	
		break;
	}

	jPanel.removeClass('jpanel_open');	
}

function toggleJpanel(jpanel_id){
	if(!jQuery(jpanel_id).hasClass('jpanel_open')){
		
		/* open the panel */
		openJpanel(jpanel_id);
		
	} else {
			
		/* close the panel */
		closeJpanel(jpanel_id);
	}
}

function clickJpanel(jpanel_id){
    jQuery(jpanel_id + ' .jpanelHandle').click(function() {
		toggleJpanel(jpanel_id);
    });		
}

function hoverJpanel(jpanel_id){
    jQuery(jpanel_id + ' .jpanelHandle').hover(function() {
		/* open the panel */
        openJpanel(jpanel_id);
    }, function() {
        /* Do nothing */
    });

    jQuery(jpanel_id).hover(function() {
        /* Do nothing */
    }, function() {

        /* close the panel */
		closeJpanel(jpanel_id);
    });	
}

function initjPanelHandle(jpanel_id){
		var jPanel = jQuery(jpanel_id),
		side = jPanel.attr('data-jpanel-side'),
		properties = {},
		handle = jQuery(jpanel_id).find(".jpanelHandle"),
		handleW = handle.outerWidth(),
		handleH = handle.outerHeight();
			
		properties.position = "absolute";
		switch(side){
			case "right":
				properties.top = "0";
				properties.left = - (handleW +11) +"px";
			break;
			
			case "left":
				properties.top = "0";
				properties.right = - (handleW +11) +"px";	
			break;
			
			case "top":
				properties.left = "0";
				properties.bottom = - handleH +"px";	
			break;
			
			case "bottom":
				properties.left = "0";
				properties.top = - handleH +"px";	
			break;
		}		

		handle.css(properties);
}

jQuery.fn.textWidth = function(){
  var html_org = jQuery(this).html();
  var html_calc = "<span>" + html_org + "</span>";
  jQuery(this).html(html_calc);
  var width = jQuery(this).find("span:first").width();
  jQuery(this).html(html_org);
  return width;
};

jQuery(document).ready(function(){
	jQuery('.jPanelModule').appendTo('body');
});