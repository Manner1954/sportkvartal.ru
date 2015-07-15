;(function($) {
		
	$.fn.MannerBox = function(options) {
		
		var mannerbox      = $('<div class="mannerbox-show"></div>'); 
		//var mannerboximg   = $('<img src="" class="mannerbox-current-img">');
		var mannerboxfulldesc   = $('<div class="mannerbox-current-fulldesc"></div>');
		var mannerboxclose = $('<div class="mannerbox-close"></div>');
		var mannerboxid = "id";
		var i = 0;
		var ithreebox = 0;
		var minusleft = -183;
		
		mannerbox.append(mannerboxfulldesc).append(mannerboxclose); //append(mannerboximg).
		
/*		$('.mannerbox').each(function() {
			$(this).addClass(mannerboxid+i);
			i++;
		})
*/
		$('.notleft').each(function() {
			$(this).addClass(mannerboxid+i);
			$(this).removeClass('notleft');	
		})

		$('.addleft').each(function() {
			if(ithreebox == 5) {
				ithreebox = 0;
			}
			else {
				$(this).addClass(mannerboxid+ithreebox);
				$(this).addClass('mannerbox-float');
				ithreebox++;
			}
			$(this).removeClass('addleft');
		})

		
			$('.mannerbox').on("click", '.mannerbox-list', function(e) {
				
				var currfulldesc = $(this).find('.fulldesc');
				
				if ($(this).next().hasClass('mannerbox-show')) {
					mannerbox.toggle();
				} else {
					mannerbox.insertAfter(this).css('display', 'block');
					mannerbox.insertAfter(this).css('left', minusleft*$(this).parent().attr('class')[12]+'px');
					$('.mannerbox-current-fulldesc').html(currfulldesc.html());
					//alert($(this).parent().attr('class')[12]);
				}
				
				if($('.mannerbox-current-fulldesc').css('opacity') == 0) {
				 	$('.mannerbox-current-fulldesc').animate({opacity: 1}, 500);
				 }

				$('html, body').animate({
					scrollTop:mannerbox.position().top + currfulldesc.height()
				}, 'medium');

				e.stopImmediatePropagation();
			});
						
			$('.mannerbox').on('click', '.mannerbox-close', function() {
				$('.mannerbox-current-fulldesc').animate({opacity: 0}, 200, function() {
					$('.mannerbox-show').slideUp();
				});
			});
	};
})(jQuery);