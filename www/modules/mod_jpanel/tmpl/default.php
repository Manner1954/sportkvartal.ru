<?php
/**
 * @package		mod_jpanel
 * @copyright	Copyright (C) 2012 Girolamo Tomaselli All rights reserved.
 * @email		girotomaselli@gmail.com
 * @website		http://bygiro.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="<?php echo $moduleclass_sfx ?> jPanelModule" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
	<div id="jPanel_<?php echo $module->id ; ?>" data-jpanel-side="<?php echo $side; ?>" class="jPanel">
	<?php if ($side == 'bottom' AND $button != ''){?>	
		<div style="margin: 0;" class="jpanelHandle"><?php echo $button; ?></div>
	<?php } ?>

		<div class="jpanelContent">
	<?php 
	
		if($modorart == 0){
	
			jimport( 'joomla.application.module.helper' );
		
			$document = JFactory::getDocument();
			$renderer = $document->loadRenderer('module');
    
			echo '<ul class="modulelist">';
    		foreach($mods as $moddy){
    			//just to get rid of that stupid php warning
    			$moddy->user = '';
    			$parameters = array('style'=>'xhtml');
    			echo '<li class="jpanelMod">'.$renderer->render($moddy, $parameters).'</li>';
    		}
  			echo '</ul>';
  		
		}
		
		if($modorart == 1){		
			$itemID = $arts['id'];
			$url = JRoute::_('index.php?option=com_content&view=article&id='.$itemID, false);
			$title = $arts['title'];
			$intro = $arts['introtext'];
			$full = $arts['fulltext'];
			
			echo '<div>';
			//echo '<h2>'.$title.'</h2>';
			echo $intro;
			if($full != ''){
				echo '<a href="'. $url .'">'. JText::_("MOD_JPANEL_READ_MORE") .'</a>';
			}
			echo '</div>'; 
		}
	?>
	<?php if($params->get('show_bygiro_link',1)){ ?> 
		<p style="text-align: center; margin: 10px 0 0 0; padding: 0; color: #000000; font-size:8px;">
		powered <a href="http://bygiro.com">ByGiro.com</a>
		</p>
	<?php } ?>
		</div>
	<?php if ($side != 'bottom' AND $button != ''){?>	
		<div style="margin: 0;" class="jpanelHandle"><?php echo $button; ?></div>
	<?php } ?>
	</div>
</div>