<?php

defined('_JEXEC') or die;

abstract class MannerfolioHelper
{
	
	private static $actions;

	public static function addSubmenu($submenu)
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_MANNERFOLIO_SUBMENU_CARD'),
			'index.php?option=com_mannerfolio&view=mannerfolios',
			$submenu == 'mannerfolios'
			);

		JSubMenuHelper::addEntry(
			JText::_('COM_MANNERFOLIO_SUBMENU_CATEGORIES'),
			'index.php?option=com_mannerfolio&view=categories',
			$submenu == 'categories'
			);

		$document = JFactory::getDocument();

		if($submenu == 'categories')
		{
			$document->setTitle(JText::_('COM_MANNERFOLIO_ADMINISTRATOR_CATEGORIES'));
		}
	}

	public static function getActions($categoryId = 0, $cardId = 0)
	{
		if(empty($cardId) && empty($categoryId))
		{
			$assetName = 'com_mannerfolio';
			$section = 'component';
		}
		elseif(empty($cardId))
		{
			$assetName = 'com_mannerfolio.category' . (int) $categoryId;
			$section = 'category';
		}
		else
		{
			$assetName = 'com_mannerfolio.card' . (int) $cardId;
			$section = 'card';
		}

		if(empty(self::$actions))
		{
			$accessFile = JPATH_ADMINISTRATOR . '/components/com_mannerfolio/access.xml';
			$actions = JAccess::getActionsFromFile($accessFile, "/access/section[@name='" . $section . "']/");

			if($section == 'card')
			{
				$adminAction = new StdClass;
				$adminAction->name = 'core.admin';
				array_push($actions, $adminAction);
			}

			self::$actions = new JObject;

			foreach ($actions as $action) 
			{
				self::$actions->set($action->name, JFactory::getUser()->authorise($action->name, $assetName));	
			}
		}

		return self::$actions;
	}


	/**
	 * Get a list of filter options for the state of a module.
	 *
	 * @return	array	An array of JHtmlOption elements.
	 */
	static function getStateOptions()
	{
		// Build the filter options.
		$options	= array();
		$options[]	= JHtml::_('select.option',	'1',	JText::_('JPUBLISHED'));
		$options[]	= JHtml::_('select.option',	'0',	JText::_('JUNPUBLISHED'));

		return $options;
	}	

		/**
	 * Get a list of filter options for the state of a module.
	 *
	 * @return	array	An array of JHtmlOption elements.
	 */
	static function getCategoryOptions()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id, name')->from('#__mannerfolio_cat');
		$db->setQuery($query);
		$categories = $db->loadObjectList();

		$options = array();
		if($categories)
		{
			foreach ($categories as $category) 
			{
				$options[] = JHtml::_('select.option', $category->id, $category->name);
			}
		}
		//$options = array_merge(parent::getOptions(), $options);

		return $options;
	}	
}