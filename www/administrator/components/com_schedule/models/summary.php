<?php

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class ScheduleModelSummary extends JModelAdmin
{
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_schedule.summary', 'summary', array('control'=>'jform', 'load_data'=>$loadData));
                
		if (empty($form)) {
			return false;
		}
        
		return $form;
	}

	public function getTable($type = 'Summary', $prefix = 'ScheduleTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	protected function loadFormData()
	{
        $context = $this->getName();

        $app = JFactory::getApplication();
               
        $id      = $this->getState($context.'.id');
        $day_id  = $this->getState($context.'.day_id');
        $line_id = $this->getState($context.'.line_id');                                       
       
        if ($id < 1 && (!$day_id && !$line_id)) {
            JError::raiseWarning(500, JText::_('COM_SCHEDULE_ADD_CELL_ERROR'));
            $app->redirect(JRoute::_('index.php?option=com_schedule'));               
        }       
       
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_schedule.edit.summary.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}        
                
		return $data;
	}

	protected function prepareTable(&$table)
	{
        if ((int)$table->id < 1) {
            $context = strtolower($this->text_prefix).'.schedules.schedule_id';
            $table->schedule_id = (int) JFactory::getApplication()->getUserState($context);
        }
	}
    
    protected function populateState()
    {        
        $app = JFactory::getApplication();
        $context = 'com_schedule.edit.summary';
        $params  = $app->getUserState($context.'.data');                                     
        
        $this->setState($this->getName().'.day_id', $params['day_id']);
        $this->setState($this->getName().'.line_id', $params['line_id']);
        
        parent::populateState();                        
    }
}