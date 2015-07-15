<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modellist');

require_once JPATH_COMPONENT_ADMINISTRATOR. '/helpers/general.php';
require_once JPATH_COMPONENT_ADMINISTRATOR. '/helpers/fields.php';

class ScheduleModelSchedule extends JModelList
{
    protected function getListQuery()
    {
        //$groupid = JRequest::getVar('groupid');
        //print_r($groupid);

        $query = parent::getListQuery();
        
        // Select some fields
    		$query->select('ss.*');

    		// From the questions table
    		$query->from('#__schedule_summary ss');
            $query->order('line_id, day_id');
            
            $query->select('e.name, e.title, e.article_id, e.record, g.id as groupid'); 
    		$query->join('LEFT', '#__schedule_event e ON e.id = ss.event_id');
            $query->join('LEFT', '#__schedule_group g ON g.id = e.group_id');
            $query->where('ss.published = 1');
            $query->where('ss.schedule_id = '. JRequest::getInt('id'));
            /*if(isset($groupid))
              $query->where('e.group_id = '.intval($groupid));*/
        
        return $query;                
    }
    
    private function prepareItems($items)
    {
/*        $data = array();
        
        foreach($items as $item) {            
            $data[$item->line_id][$item->day_id] = $item;
        } */
        $data = array();
        $data_day = array();
        $lineid = 1;
        $dayid = 1;
        $first = 0;
        $count_items = 0;
        foreach($items as $item) {  
            //print_r($item->line_id); echo ":"; print_r($item->day_id); echo "--<br>";
            //print_r($item); echo "--<br>";

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
              //print_r($count_items . "^" . count($items)); echo "--<br>";
              //if($count_items != count($items)) {
                $data_day[] = $item;
              //}
            }
        }
        if(count($data_day) > 0) {
          $data[$lineid][$dayid] = $data_day;    
        }
        //print_r($data);
        return $data;        
    }

    public function getItems()
    {
        $items = parent::getItems();
        $subfields = new FieldsSheduleHelper($items, $items, true);
        $subfields->setItemsValues();

        return $this->prepareItems($items);
    }

    public function getRows()
    {
        return GeneralScheduleHelper::getRows();
    }
    
    public function getCols()
    {
        return GeneralScheduleHelper::getCols();
    }

    public function getGroupId()
    {
        return GeneralScheduleHelper::getGroupId(); 
    }

   /* public function  processCheckout(&$data) 
    {
        print_r($data);
        //stop();
        $mainframe = & JFactory::getApplication() ;
        if($data['checkbb'])
            $url = JRoute::_('index.php?option=com_schedule&view=schedule&id=1&Itemid=262&groupid='.intval($data['checkbb']), false);  
        else
            $url = JRoute::_('index.php?option=com_schedule&view=schedule&id=1&Itemid=262', false);  

        $mainframe->redirect($url);     

    }   */    
       
}