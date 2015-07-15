;(function($) {
		
	$.fn.SuperBox = function(options) {
		
		var superbox      = $('<div class="superbox-show"></div>');
		var superboximg   = $('<img src="" class="superbox-current-img">');
		var superboxname   = $('<div class="superbox-current-name"></div>');
		var superboxintodesc  = $('<div class="superbox-current-intodesc"></div>');
		var superboxfulldesc   = $('<div class="superbox-current-fulldesc"></div>');
		var superboxclose = $('<div class="superbox-close"></div>');
		
		superbox.append(superboximg).append(superboxname).append(superboxintodesc).append(superboxfulldesc).append(superboxclose);
		
		return this.each(function() {
			
			$('.superbox-list').click(function() {
		
				var currentimg = $(this).find('.superbox-img');
				var imgData = currentimg.data('img');
				superboximg.attr('src', imgData);

				var currname = $(this).find('#trainername');
				var currintodesc = $(this).find('#intodesc');
				var currfulldesc = $(this).find('#fulldesc');

				var currentWidth = currentimg.width();

				if(currentWidth > 225)
					currentWidth = currentWidth / 2;
				
				if($('.superbox-current-img').css('opacity') == 0) {
					$('.superbox-current-img').animate({opacity: 1});
				}
				
				if ($(this).next().hasClass('superbox-show')) {
					superbox.toggle();
				} else {
					superbox.insertAfter(this).css('display', 'block');
					$('.superbox-current-name').html(currname.text());
					$('.superbox-current-intodesc').html(currintodesc.text());
					$('.superbox-current-fulldesc').html(currfulldesc.html());
				}
				
				$('html, body').animate({
					scrollTop:superbox.position().top - currentWidth + 25
				}, 'medium');
			
			});
						
			$('.superbox').on('click', '.superbox-close', function() {
				$('.superbox-current-img').animate({opacity: 0}, 200, function() {
					$('.superbox-show').slideUp();
				});
			});
			
		});
	};
})(window.jq184 || jQuery);


/*;$(function(){
    $('.item').each(function(){
        if(!$(this).find('.summary').text().length){
            $(this).find('.summary').css('background-color', 'transparent');
        }
    });
});*/

/*var animateTime = 500;

$(document).ready(function() {
	$(".some-train-full").hide();	
	$(".some-train").click(function() {
	var h = $(this).next(".some-train-full").height();
	$(this).children().next(".some-train-full").height(h).slideToggle(400).parents().siblings().find("div.some-train-full:visible").slideUp(3000);
	
		//$(this).children().next(".some-train-full").addClass("openslide");
		//$(this).parent().parent().next("div").slideToggle("slow");
   	//var trigger = $(this), state = false, el = trigger.parent().parent().next('.some-train-full');
   	//trigger.click(function(){
    	//state = !state;
    	//el.slideToggle();
      //trigger.parent().parent().toggleClass('inactive');
		//});
	return false;
	});
})*/

/*function itemsMarginFix(){
    $('.item').each(function (index, item) {
        var $item = $(item),
            $summary = $item.find('.summary');
        $summary.css('font-family', 'Tahoma, sans-serif');
        var h = $item.find('.summary').outerHeight() + 4;
        $summary.removeAttr('style');
        if(!$summary.text().length){
            $summary.css('background-color', 'transparent');
        }
        $item.find('img').css({
            marginBottom: '-' + h + 'px'
        });
    });

	$('.content-short p .more').parent('p').css('cursor', 'pointer').click(function (e) {
        if (!$(e.currentTarget).parents('.item').is('.item-expanded')) {
            $(e.currentTarget).find('.more').trigger('click');
            return false;
        }
    });

    $('.more').click(function(){
		if($('.item-expanded').length > 0){
			backToDefault($('.item-expanded'));
		};                  
		expandItem($(this));
		return false;
	});

	$('body').click(function(){
		if($('.item-expanded').length > 0){
			backToDefault($('.item-expanded'))
		};
	
	});
	

	$('.item').hover(function(){
		$(this).addClass('b-shadow');
	},function(){
		if(!$(this).hasClass('item-expanded')){
			$(this).removeClass('b-shadow');
		}
	});
}

itemsMarginFix();

$(window).load(function(){
    itemsMarginFix();
});

var expandItem = function(el){

	var $el = $(el).closest('.item'),
        $item = $(el).closest('.item'),
        $content_wrap = $(el).closest('.item').find('.content_wrap'),
        $summary = $(el).closest('.item').find('.summary'),
        $summaryHeight = $summary.height() ? $summary.outerHeight() ? $summary.outerHeight() : $summary.height() : 0,
        $info = $(el).closest('.item').find('.info'),
        $infoHeight = $info.outerHeight() ? $info.outerHeight() : 0,
        infoBlockHeight = $summaryHeight + $infoHeight,
        newTop = $item.height() - $content_wrap.height() - infoBlockHeight;
	$el.find('.image').animate({opacity: 0.15}, animateTime);
	$el.find('.summary, .info, .content_wrap').animate({top: 0 + newTop}, animateTime, function(){
		el.hide();
		$el.find('.content-short span').fadeIn('slow').css('display', 'inline');
	});
	$el.addClass("item-expanded").addClass('hover');
	//css украшательства
	//$(el).find('#iDiv').addClass("itemidiv"); //animate({top: 0 + newTop}, animateTime); 	
	//var $eldiv = $(el).closest('#iDiv');
	//$eldiv.animate({top: 0 + newTop}, animateTime);
	$('.some-train').each(function() {
   var trigger = $(this), state = false, el = trigger.parent().parent().next('.some-train-full');
   trigger.click(function(){
      state = !state;
      el.slideToggle();
      //trigger.parent().parent().toggleClass('inactive');
	   });
	});
}

var backToDefault = function(el){
	var $el = $(el).closest('.item');
    $el.find('.content-short span').fadeOut('fast');

	$el.find('.summary, .info, .content_wrap').animate({top: 0}, animateTime, function(){
		el.find('.more').show();
        $el.find('.image').animate({opacity: 1}, animateTime);

        $el.removeClass("item-expanded").removeClass('hover');
	});

}*/