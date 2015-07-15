<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');


class ScheduleViewEvent extends JView
{
    // Overwriting JView display method
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }

        // Display the view
        parent::display($tpl);

        return true;
    }
}