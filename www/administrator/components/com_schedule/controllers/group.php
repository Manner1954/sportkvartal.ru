<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controllerform library
jimport('joomla.application.component.controllerform');
 
/**
 * Question Controller
 */
class ScheduleControllerGroup extends JControllerForm
{
    protected function postSaveHook($model)
    {
        //print_r($model);
        /*$db = $model->getDBo();
        $db->reorder();*/                
    }
    
}