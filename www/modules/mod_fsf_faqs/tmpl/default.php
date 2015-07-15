<?php
/**
 * @package Freestyle Joomla
 * @author Freestyle Joomla
 * @copyright (C) 2013 Freestyle Joomla
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
?>


<?php if ($maxheight > 0): ?>
<script>

jQuery(document).ready(function () {
	setTimeout("faqsmod_scrollDown()",3000);
});

function faqsmod_scrollDown()
{
	var settings = { 
		direction: "down", 
		step: 40, 
		scroll: true, 
		onEdge: function (edge) { 
			if (edge.y == "bottom")
			{
				setTimeout("faqsmod_scrollUp()",3000);
			}
		} 
	};
	jQuery(".fsf_mod_faqs_scroll").autoscroll(settings);
}

function faqsmod_scrollUp()
{
	var settings = { 
		direction: "up", 
		step: 40, 
		scroll: true,    
		onEdge: function (edge) { 
			if (edge.y == "top")
			{
				setTimeout("faqsmod_scrollDown()",3000);
			}
		} 
	};
	jQuery(".fsf_mod_faqs_scroll").autoscroll(settings);
}
</script>

<style>
.fsf_mod_faqs_scroll {
	max-height: <?php echo $maxheight; ?>px;
	overflow: hidden;
}
</style>


<?php endif; ?>

<div id="fsf_mod_faqs_scroll" class="fsf_mod_faqs_scroll">

<?php if ($mode == "" || $mode == "newpage"): ?>
	<?php foreach ($data as $row) :?>
		<div class='fsf_mod_faqs_cont'>
			<div class='fsf_mod_faqs_title'>
				<a href='<?php echo FSFRoute::_('index.php?option=com_fsf&view=faq&faqid=' . $row->id); ?>'>
					<?php echo $row->question; ?>
				</a>
			</div>
		</div>
	<?php endforeach;?>
	
<?php elseif ($mode == "popup") : ?>
	<?php foreach ($data as $row) :?>
	<div class='fsf_mod_faqs_cont'>
	<div class='fsf_mod_faqs_title'>
				<a href='#' onclick='TINY.box.show({iframe:"<?php echo FSFRoute::_('index.php?option=com_fsf&view=faq&tmpl=component&faqid=' . $row->id); ?>", width:630,height:440});return false;'>
					<?php echo $row->question; ?>
				</a>
			</div>
		</div>
	<?php endforeach;?>

<?php elseif ($mode == "accordion") : ?>
	<?php foreach ($data as $row) :?>
		<div class='fsf_mod_faqs_cont'>
			<div class='fsf_mod_faqs_title accordion_toggler_1'>
				<a href="#" onclick='return false;'>
					<?php echo $row->question; ?>
				</a>
			</div>
			<div class="fsf_mod_faqs_answer accordion_content_1">
				<?php echo $row->answer; ?>
			</div>
		</div>
	<?php endforeach;?>

<?php endif; ?>


</div>

<?php if ($mode == "accordion"): ?>
<?php $scrollf = FSF_Helper::Is16() ? "start" : "scrollTo"; ?>
	
<script>
jQuery(document).ready(function () {
	
	if(window.ie6) var heightValue='100%';
	else var heightValue='';
	
	var togglerName='div.accordion_toggler_';
	var contentName='div.accordion_content_';
	
	var acc_elem = null;
	var acc_toggle = null;
	
	var counter=1;	
	var toggler=$$(togglerName+counter);
	var content=$$(contentName+counter);
	
	while(toggler.length>0)
	{
		// Accordion anwenden
<?php if (FSFJ3Helper::IsJ3()): ?>
		new Fx.Accordion(toggler, content, {
<?php else: ?>
		new Accordion(toggler, content, {
<?php endif; ?>
		opacity: false,
		alwaysHide: true,
		display: -1,
		onActive: function(toggler, content) {
				acc_elem = content;
				acc_toggle = toggler;
			},
			onBackground: function(toggler, content) {
			},
			onComplete: function(){
				var element=jQuery(this.elements[this.previous]);
				if(element && element.offsetHeight>0) element.setStyle('height', heightValue);			

				if (!acc_elem)
					return;

				var  scroll =  new Fx.Scroll(window,  { 
					wait: false, 
					duration: 250, 
					transition: Fx.Transitions.Quad.easeInOut
				}); 
			
				var window_top = window.pageYOffset;
				var window_bottom = window_top + window.innerHeight;
				var elem_top = acc_toggle.getPosition().y;
				var elem_bottom = elem_top + acc_elem.offsetHeight + acc_toggle.offsetHeight;

				// is element off the top of the displayed windows??
				if (elem_top < window_top)
				{
					scroll.<?php echo $scrollf; ?>(window.pageXOffset,acc_toggle.getPosition().y);
				} else if (elem_bottom > window_bottom)
				{
					var howmuch = elem_bottom - window_bottom;
					if (elem_top - howmuch > 0)
					{
						scroll.<?php echo $scrollf; ?>(window.pageXOffset,window_top + howmuch + 22);				
					} else {
						scroll.<?php echo $scrollf; ?>(window.pageXOffset,acc_toggle.getPosition().y);
					}
				}
			}
		});
		
		counter++;
		toggler=$$(togglerName+counter);
		content=$$(contentName+counter);
	}
});
</script>
<?php endif; ?>
