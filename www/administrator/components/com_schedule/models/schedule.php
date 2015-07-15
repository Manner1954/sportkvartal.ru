<?php

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class ScheduleModelSchedule extends JModelAdmin
{
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_schedule.schedule', 'schedule', array('control'=>'jform', 'load_data'=>$loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    public function getTable($type = 'Schedule', $prefix = 'ScheduleTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_schedule.edit.schedule.data', array());

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
}