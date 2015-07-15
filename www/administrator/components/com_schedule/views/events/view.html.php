<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view'); 
 
/**
 * Events View
 */
class ScheduleViewEvents extends JView
{
    /**
     * Questions view display method
     * @return void
     */
    function display($tpl = null) 
    {
        $items = $this->get('Items');
     		$this->pagination	= $this->get('Pagination');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) 
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        
        $this->items = $items; 
             
        $this->addToolbar();
        // Display the template
        parent::display($tpl);
    }
    
    protected function addToolbar()
    {
        JToolBarHelper::title(JText::_('Events')); 
               
        JToolBarHelper::addNewX('event.add');
        JToolBarHelper::editListX('event.edit');        
        JToolBarHelper::divider();        
        JToolBarHelper::deleteListX('', 'events.delete');   
    }
}