<?php
	defined('_JEXEC') or die;

	jimport('joomla.form.helper');
	JFormHelper::loadFieldClass('list');

	class JFormFieldCategories extends JFormFieldList
	{
		protected $type = 'categories';

		protected function getOptions()
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
			$options = array_merge(parent::getOptions(), $options);
			return $options;
		}
	}