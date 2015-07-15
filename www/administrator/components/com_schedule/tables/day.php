<?php

// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');

class ScheduleTableDay extends JTable
{
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    
    function __construct(&$db) 
    {
        parent::__construct('#__schedule_day', 'id', $db);                
    }
    
    public function store($updateNulls = false)
    {
        $k = $this->_tbl_key;
        
        $newRecord = !$this->$k ? true : false;        
        
        $this->ordering = parent::getNextOrder();        
        $return = parent::store($updateNulls);        
                       
        if (!$newRecord)                       
            $this->reorder();
                
        return $return;                        
    }   
}