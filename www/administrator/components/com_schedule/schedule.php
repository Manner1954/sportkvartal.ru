<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import joomla controller library
jimport('joomla.application.component.controller');

require_once JPATH_COMPONENT.'/helpers/schedule.php';
 
// Get an instance of the controller prefixed by Schedule
$controller = JController::getInstance('Schedule');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();