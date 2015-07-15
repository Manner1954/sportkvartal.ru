<?php 

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modellist');

require_once JPATH_COMPONENT. '/helpers/general.php';

class ScheduleModelSchedules extends JModelList 
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery() 
	{
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('ss.*');

		// From the questions table
		$query->from('#__schedule_summary ss');
		$query->order('line_id, day_id');
        
    	$query->select('e.name, e.title');
		$query->join('LEFT', '#__schedule_event e ON e.id = ss.event_id');

   		$shedule_id = $this->getScheduleId();
   		$query->where('ss.schedule_id = '.$shedule_id);  

		return $query;
	} 
    
    public function getItems()
    {
        $items = parent::getItems(); 
        return $this->prepareItems($items);
    } 
    
    private function prepareItems($items)
    {
        $data = array();
        $data_day = array();
        $lineid = 1;
        $dayid = 1;
        $first = 0;
        $count_items = 0;
        foreach($items as $item) {
        	/*if($item->line_id == 11 && $item->day_id == 5)  
        	{
            	print_r($item->line_id); echo ":"; print_r($item->day_id); echo "--"; print_r($lineid); echo ":"; print_r($dayid); echo "--<br>";
        	}*/
            $count_items ++;
            if(!$first) {
              $lineid = $item->line_id; 
              $dayid = $item->day_id;
              $data_day[] = $item;
              $first = 1;
            }
            elseif (($item->line_id == $lineid) && ($item->day_id == $dayid)) {  
              $data_day[] = $item;    
             }
            else {
              $data[$lineid][$dayid] = $data_day;
              array_splice($data_day,0);
              $lineid = $item->line_id; 
              $dayid = $item->day_id;
              //if($count_items != count($items)) {
              $data_day[] = $item;
              //}
            }
            /*if($item->line_id == 11 && $item->day_id == 5)  
        	{
            	print_r($data_day); echo "--"; print_r($lineid); echo ":"; print_r($dayid); echo "--<br>";
        	}*/

        }
        if(count($data_day) > 0) {
          $data[$lineid][$dayid] = $data_day;    
        }
        //print_r($data);
        return $data;        
    }
    
    public function getCols()
    {
        return GeneralScheduleHelper::getCols();              
    }   
    
    public function getRows()
    {
        return GeneralScheduleHelper::getRows();      
    }

    public function getSchedules()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        $query->select('s.*');
        $query->from('#__schedule_schedule s');

        $db->setQuery($query);
        return $db->loadObjectList();
    }

    public function getScheduleId()
    {
        return (int) JFactory::getApplication()->getUserState($this->context.'.schedule_id');
    }
}