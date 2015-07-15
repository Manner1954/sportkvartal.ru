<?php

// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');

class ScheduleTableEvent extends JTable
{
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    
    public function __construct(&$db) 
    {
        parent::__construct('#__schedule_event', 'id', $db);
    }
    
    public function check()
    {
        jimport('joomla.filter.output');
        
        if (empty($this->name)) {
    	    $this->name = $this->title;
        }
        
        $this->name = JFilterOutput::stringURLSafe($this->name);
     
        /* All your other checks */
        return true;        
    }
}