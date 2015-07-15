<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Lines View
 */
class ScheduleViewLines extends JView
{
    function display($tpl = null) 
    {
        $items = $this->get('Items');

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
        JToolBarHelper::title(JText::_('Lines')); 
               
        JToolBarHelper::addNewX('line.add');
        JToolBarHelper::editListX('line.edit');        
        JToolBarHelper::divider();                
        JToolBarHelper::publishList('lines.publish','JTOOLBAR_PUBLISH');
        JToolBarHelper::unpublishList('lines.unpublish','JTOOLBAR_UNPUBLISH');
        JToolBarHelper::divider();         
        JToolBarHelper::deleteListX('', 'lines.delete');
    }
}