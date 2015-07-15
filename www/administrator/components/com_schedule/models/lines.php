<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class ScheduleModelLines extends JModelList
{
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    
    protected function getListQuery()
    {
        $db = JFactory::getDbo();
        
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__schedule_line l');
        $query->order('line_time');
        
        return $query;
    }    
}