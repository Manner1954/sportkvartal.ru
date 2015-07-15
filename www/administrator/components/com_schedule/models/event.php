<?php

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class ScheduleModelEvent extends JModelAdmin
{
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_schedule.event', 'event', array('control'=>'jform', 'load_data'=>$loadData));
                
		if (empty($form)) {
			return false;
		}
        
		return $form;
	}

	public function getTable($type = 'Event', $prefix = 'ScheduleTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_schedule.edit.event.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

	protected function prepareTable(&$table)
	{
		//jimport('joomla.filter.output');        
        $table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);
	}

    public function save($data)
    {
        $save = parent::save($data);
     	if ($save) {
            require_once JPATH_COMPONENT.'/helpers/fields.php';

            $input = JFactory::getApplication()->input;
  			$data  = $input->post->get('jform', array(), 'array');
                //var_dump($data);
        		//stop();  
            $subfields = new FieldsSheduleHelper($data);          
            $subfields->saveItemValues();

            //FieldsSheduleHelper::saveItemValues($data);
        }

        return $save;
    }

    public function delete($pks)
    {
        if (parent::delete($pks)) {

        }

        return true;
    }
}