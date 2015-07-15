<?php

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class ScheduleModelField extends JModelAdmin
{
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_schedule.field', 'field', array('control'=>'jform', 'load_data'=>$loadData));
                
		if (empty($form)) {
			return false;
		}
        
		return $form;
	}

	public function getTable($type = 'Field', $prefix = 'ScheduleTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_schedule.edit.field.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

	protected function prepareTable(&$table)
	{
		//jimport('joomla.filter.output');        
        //$table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);
	}

    protected function canDelete($record)
    {
        $canDelete = parent::canDelete($record);

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('count(id)');
        $query->from('#__schedule_field_value fv');
        $query->where('field_id = '. $record->id);

        $db->setQuery($query);

        return $canDelete && !(bool) $db->loadResult();
    }
}