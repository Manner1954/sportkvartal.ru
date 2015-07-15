<?php

defined ('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class MannerfolioModelMannerfolio extends JModelList
{
	/*public function getTable($type = "mannerfolio", $prefix = "MannerfolioTable", $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}*/

	public function getItems()
	{
        $db    = JFactory::getDbo();  
            
        $query = $db->getQuery(true);        
        $query->select('a.name AS name, a.intodesc AS intodesc, a.fulldesc AS fulldesc, a.time AS time, a.image AS image, a.professio AS professio, a.typecard AS typecard');
        $query->from('#__mannerfolio a'); 
        $query->order('ordering');       
		// Join over the categories.
		$query->select('c.name AS category_name');
		$query->join('LEFT', '#__mannerfolio_cat AS c ON c.id = a.catid');
		$query->where('c.id = '. (int) JRequest::getvar('id'));
		$query->where('a.state = 1');

        
        $db->setQuery($query);        
        return $db->loadObjectList();    
	}

	// protected function populateState()
	// {
	// 	$app = JFactory::getApplication();

	// 	//$id = $app->input->getInt('id', 0);
	// 	//$this->setState('message.id', $id);
	// }
}