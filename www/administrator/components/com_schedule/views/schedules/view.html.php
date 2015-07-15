<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Questions View
 */
class ScheduleViewSchedules extends JView
{
    /**
     * Questions view display method
     * @return void
     */
    function display($tpl = null) 
    {
        $items = $this->get('Items');           

        $schedules = $this->get('Schedules');
        
        $this->pagination	= $this->get('Pagination');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) 
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        
        $this->items = $items;
        $this->grid  = array(
            'cols'=>$this->get('Cols'),
            'rows'=>$this->get('Rows')
        );
        $this->schedules   = $schedules;
        $this->schedule_id = $this->get('ScheduleId');
        
        $this->addToolbar();
        // Display the template
        parent::display($tpl);
    }
    
    protected function addToolbar()
    {        
        JToolBarHelper::title(JText::_('COM_SCHEDULE'));
        JToolBarHelper::preferences('com_schedule');             
        //JToolBarHelper::addNewX('day.add');           
    }
}