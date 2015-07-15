<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
require_once JPATH_COMPONENT_ADMINISTRATOR. '/helpers/fields.php';

class ScheduleModelEvents extends JModelList
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
        $query->from('#__schedule_event e');
        $query->order('id');
        
        return $query;
    }  
    
    public function getItems()
    {
        $items = parent::getItems();
        $subfields = new FieldsSheduleHelper($items, $items, true);
        $subfields->setItemsValuesAdm();

        return $items;
    }
  
}