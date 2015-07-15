<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class ScheduleModelGroups extends JModelList
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
        $query->from('#__schedule_group d');
        $query->order('ordering');
        
        return $query;
    }    
}