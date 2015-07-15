<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Questions View
 */
class ScheduleViewGroups extends JView
{
    /**
     * Questions view display method
     * @return void
     */
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
        JToolBarHelper::title(JText::_('Groups')); 
               
        JToolBarHelper::addNewX('group.add');
        JToolBarHelper::editListX('group.edit');        
        JToolBarHelper::divider();                
        JToolBarHelper::publishList('groups.publish','JTOOLBAR_PUBLISH');
        JToolBarHelper::unpublishList('groups.unpublish','JTOOLBAR_UNPUBLISH');
        JToolBarHelper::divider();         
        JToolBarHelper::deleteListX('', 'groups.delete');
    }
}