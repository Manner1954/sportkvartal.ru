<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class MannerfolioModelCategories extends JModelList
{
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		$query -> select('id, name');
		$query -> from('#__mannerfolio_cat');
		return $query;
	}
}