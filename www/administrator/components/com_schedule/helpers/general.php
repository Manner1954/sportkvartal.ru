<?php

class GeneralScheduleHelper
{
    public static function getCols()
    {
        $db    = JFactory::getDbo();  
            
        $query = $db->getQuery(true);        
        $query->select('*');
        $query->from('#__schedule_day d'); 
        $query->order('ordering');       
        
        $db->setQuery($query);        
        return $db->loadObjectList();         
    }
    
    public static function getRows()
    {
        $db    = JFactory::getDbo();  
              
        $query = $db->getQuery(true);        
        $query->select('*');
        $query->from('#__schedule_line l');    
        $query->order('line_time');    
        
        $db->setQuery($query);        
        return $db->loadObjectList();         
    }

    public static function getFirstScheduleId()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__schedule_schedule s');
        $query->order('id');

        $db->setQuery($query);
        $result = $db->loadObject();
        return (int) $result->id;
    }

    public static function getGroupId()
    {
        $db    = JFactory::getDbo();  
              
        $query = $db->getQuery(true);        
        $query->select('*');
        $query->from('#__schedule_group g'); 
        $query->where('g.published = 1');        
        $query->order('id');    
        
        $db->setQuery($query);        
        return $db->loadObjectList();         
    }
}