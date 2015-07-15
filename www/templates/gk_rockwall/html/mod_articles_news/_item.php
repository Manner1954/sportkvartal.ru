<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_news
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$item_heading = $params->get('item_heading', 'h4');
?>
<?php if ($params->get('item_title')) :	?>
	<time class="newstime" pubdate="<?php echo JHtml::_('date', $item->modified, JText::_(DATE_W3C)); ?>">
		<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); echo "<BR>"?>
	</time>
	<<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($params->get('link_titles') && $item->link != '') : ?>
		<a href="<?php echo $item->link;?>">
			<?php echo $item->title;?></a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
	</<?php echo $item_heading; ?>>

<?php endif; ?>

<?php if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php echo strip_tags($item->introtext, "<p>"); ?>

<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) :
	echo '<a class="readmore" href="'.$item->link.'">'.$item->linkText.'</a>';
endif; ?>
