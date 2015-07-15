<?php

// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');

class ScheduleTableSummary extends JTable
{
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    
    function __construct(&$db) 
    {
        parent::__construct('#__schedule_summary', 'id', $db);
    }

    /*public function store()
    {
        $this->schedule_id = 1;
        return parent::store();
    }*/
}