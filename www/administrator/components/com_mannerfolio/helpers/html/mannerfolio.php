<?php
/**
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	com_messages
 * @since		1.6
 */
class JHtmlMannerfolio
{
	/**
	 * @param	int $value	The state value
	 * @param	int $i
	 */
	public static function state($value = 0, $i, $canChange)
	{
		// Array of image, task, title, action.
		$states	= array(
			1	=> array('tick.png', 'mannerfolio.unpublish', 'JPUBLISHED', 'JPUBLISHED'),
			0	=> array('publish_x.png', 'mannerfolio.publish', 'JUNPUBLISHED', 'JUNPUBLISHED')
		);
		$state	= JArrayHelper::getValue($states, (int) $value, $states[0]);
		$html	= JHtml::_('image', 'admin/'.$state[0], JText::_($state[2]), NULL, true);
		if ($canChange) {
			$html = '<a href="#" onclick="return listItemTask(\'cb'.$i.'\',\''.$state[1].'\')" title="'.JText::_($state[3]).'">'
					.$html.'</a>';
		}

		return $html;
	}

}