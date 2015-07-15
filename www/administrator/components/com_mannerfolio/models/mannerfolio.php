<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class MannerfolioModelMannerfolio extends JModelAdmin
{
	public function getTable($type='Mannerfolio', $prefix='MannerfolioTable', $config=array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm($this->option . '.mannerfolio', 'mannerfolio', array('control' => 'jform', 'load_data' => $loadData));

		if(empty($form))
		{
			return false;
		}

		$id = JFactory::getApplication()->input->get('id', 0);
		$user = JFactory::getUser();

		// Изменяем форму исходя из доступов пользователя
		if($id != 0 && (!$user->authorise('core.edit.state', $this->option . '.card.' . (int) $id)) || ($id == 0 && !$user->authorise('core.edit.state', $this->option)))
		{
			// Модифицируем поле
			$form->setFieldAttribute('state', 'disabled', 'true');
		}

		return $form;
	}

	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState($this->option . '.edit.mannerfolio.data', array());

		if(empty($data))
		{
			$data = $this -> getItem();
		}

		return $data;
	}

	// Метод проверки возможности удалять запись

	protected function canDelete($record)
	{
		if(!empty($record->id))
		{
			return JFactory::getUser()->authorise('core.delete', $this->option . '.card.' . (int) $record->id);
		}
		else
		{
			return parent::canDelete($record);
		}
	}

	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		if(empty($record->id))
		{
			return $user->authorise('core.edit.state', $this->option . '.card.' . (int) $record->id);
		}
		elseif(!empty($record->catid))
		{
			return $user->authorise('core.edit.state', $this->option . '.card.' . (int) $record->catid);
		}
		else
		{
			return parent::cabEditState($record);
		}
	}
}