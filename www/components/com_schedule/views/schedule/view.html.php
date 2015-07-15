<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class ScheduleViewSchedule extends JView
{
    // Overwriting JView display method
    public function display($tpl = null) 
    {
        $items = $this->get('Items'); 

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
        
        $this->menu = JFactory::getApplication()->getMenu()->getActive();
        
        $groupids = $this->get('GroupId');
        $this->groupids = $groupids;
        // Display the view
        parent::display($tpl);

        return true;
    }
    
    public function shotTime($time)
    {
        $data = explode(':', $time);
        unset($data[2]);
        return implode(':', $data);         
    }
}