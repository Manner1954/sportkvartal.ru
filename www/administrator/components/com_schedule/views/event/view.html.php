<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');

require_once JPATH_COMPONENT.'/helpers/fields.php';
 
/**
 * Event View
 */
class ScheduleViewEvent extends JView
{
    /**
     * Questions view display method
     * @param string $tpl
     * @return void
     */
    public function display($tpl = null) 
    {        
        $item = $this->get('Item');
		    $form = $this->get('Form');	
        
        if (count($errors = $this->get('Errors'))) 
		{		  
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
        
        $this->item = $item;
        $this->form = $form;
        
        $this->addToolBar();

        $this->subfields = new FieldsSheduleHelper($item, $form);

        // Display the template
        parent::display($tpl);
    }
    
    protected function addToolBar()
    {
        JRequest::setVar('hidemainmenu', true);
        
        $isNew = $this->item->id == 0;
        JToolBarHelper::title(JText::_('Event') .': '. ($isNew ? JText::_('NEW_EVENT') : JText::_('EDIT_EVENT')));
		JToolBarHelper::apply('event.apply');
		// If an existing item, can save to a copy only if we have create rights.
        JToolBarHelper::save('event.save');
		if (!$isNew) {
			JToolBarHelper::save2copy('event.save2copy');
		}
    
    //JToolBarHelper::save('event.save');
        JToolBarHelper::cancel('event.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'); 
    
    }
    
    protected function setDocument() 
    {
        
    }
}