<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

jimport( 'joomla.application.component.view');
/**
 * HTML View class for EventBooking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Events Booking
 * @since 1.5
 */
class EventBookingViewRegistrantList extends JView
{
	function display($tpl = null)
	{		
		$config = EventBookingHelper::getConfig() ;
	    $this->setLayout('default') ;
		$db = & JFactory::getDBO();
		$eventId = JRequest::getInt('event_id');
		$config = EventBookingHelper::getConfig();
		if ($eventId) {
			if (isset($config->include_group_billing_in_registrants) && !$config->include_group_billing_in_registrants)				
				$sql = 'SELECT * FROM #__eb_registrants WHERE event_id='.$eventId.' AND is_group_billing=0 AND (published=1 OR (payment_method="os_offline" AND published != 2))';
			else
				$sql = 'SELECT * FROM #__eb_registrants WHERE event_id='.$eventId.' AND (published=1 OR (payment_method="os_offline" AND published != 2))';				
			$db->setQuery($sql) ;
			$rows = $db->loadObjectList();
		} else {			
			$rows = array() ;
		}
		$this->assignRef('items', $rows) ;
		$this->assignRef('config', $config) ;
		parent::display($tpl);				
	}
}