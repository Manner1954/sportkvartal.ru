<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');

require_once JPATH_COMPONENT. '/helpers/general.php';
 
/**
 * General Controller of component
 */
class ScheduleController extends JController
{
    /**     
     * display task
     *
     * @return void
     */
    public function display($cachable = false)
    {
        $view	= JRequest::getCmd('view', 'schedules');
		$layout = JRequest::getCmd('layout', 'default');
		$id		= JRequest::getInt('id');
        
        // set default view if not set
        JRequest::setVar('view', $view);        
        ScheduleHelper::addSubmenu($view);

        JHtml::stylesheet('schedule/admin_style.css', array(), true);

        $option = JRequest::getCmd('option');
        $context = $option.'.schedules.schedule_id';

        $app = JFactory::getApplication();
        $shedule_id = $app->getUserState($context);

        if (!$shedule_id) {
            $app->setUserState($context, GeneralScheduleHelper::getFirstScheduleId());
        }
                        
        // call parent behavior
        parent::display($cachable);
        
        return $this;
    }

    public function change()
    {
        $option = JRequest::getCmd('option');
        $id = JRequest::getInt('id');

        $app = JFactory::getApplication();
        $app->setUserState($option.'.schedules.schedule_id', $id);

        $this->setRedirect(JRoute::_('index.php?option='. $option));
    }

    public function delete()
    {
        $id = JRequest::getInt('id');
        $option = JRequest::getCmd('option');

        JTable::addIncludePath(dirname(__FILE__).DS.'tables');
        $table = JTable::getInstance('Summary', 'ScheduleTable');
        $table->delete($id);

        $this->setRedirect(JRoute::_('index.php?option='.$option));
    }
}