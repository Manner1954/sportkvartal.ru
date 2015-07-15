<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class MannerfolioControllerMannerfolio extends JControllerForm
{
	// Переопределение метода для проверки, есть ли права на добавление записи

	protected function allowAdd($data = array())	
	{
		$categoryId = JArrayHelper::getValue($data, 'catid', 0, 'int');

		if($categoryId)
		{
			return JFactory::getUser()->authorise('core.create', $this->option . '.category.' . $categoryId);
		}
		else
		{
			return parent::allowAdd($data);
		}
	}

	protected function allowEdit($data = array(), $key = 'id')
	{
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;
		if($recordId)
		{
			return JFactory::getUser()->authorise('core.edit', $this->option . '.card.' . $recordId);
		}
		else
		{
			return parent::allowEdit($data, $key);
		}
	}
}