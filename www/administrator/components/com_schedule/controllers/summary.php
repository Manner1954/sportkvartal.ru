<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controllerform library
jimport('joomla.application.component.controllerform');
 
/**
 * Summary Controller
 */
class ScheduleControllerSummary extends JControllerForm
{
    protected $view_list = 'schedules';
    
    public function add()
    {        
        parent::add();
        
        $app	 = JFactory::getApplication();
        $context = "$this->option.edit.$this->context";               
        
        $app->setUserState($context.'.data', array(
            'day_id'  => JRequest::getInt('col'),
            'line_id' => JRequest::getInt('row')
        ));                
    }    
}