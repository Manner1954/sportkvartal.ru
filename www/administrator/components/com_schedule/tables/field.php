<?php

// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');

class ScheduleTableField extends JTable
{
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    
    public function __construct(& $db) 
    {
        parent::__construct('#__schedule_field', 'id', $db);
    }
}