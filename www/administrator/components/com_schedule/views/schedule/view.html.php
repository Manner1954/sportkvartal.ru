<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Day View
 */
class ScheduleViewSchedule extends JView
{
    /**
     * Questions view display method
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

        // Display the template
        parent::display($tpl);
    }

    protected function addToolBar()
    {
        JRequest::setVar('hidemainmenu', true);

        $isNew = $this->item->id == 0;

        JToolBarHelper::title(JText::_('SCHEDULE') .': '. ($isNew ? JText::_('NEW_SCHEDULE') : JText::_('EDIT_SCHEDULE')));
        JToolBarHelper::save('schedule.save');
        JToolBarHelper::cancel('schedule.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }

    protected function setDocument()
    {

    }
}