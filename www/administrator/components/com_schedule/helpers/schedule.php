<?php

class ScheduleHelper
{    
    public static function addSubmenu($curName)
    {
        JSubMenuHelper::addEntry(
			JText::_('COM_SCHEDULE_SUBMENU_SCHEDULE'),
			'index.php?option=com_schedule&view=schedules',
			$curName == 'schedules'
		);


		JSubMenuHelper::addEntry(
			JText::_('COM_SCHEDULE_SUBMENU_DAYS'),
			'index.php?option=com_schedule&view=days',
			$curName == 'days'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_SCHEDULE_SUBMENU_LINES'),
			'index.php?option=com_schedule&view=lines',
			$curName == 'lines'
		);
        
        JSubMenuHelper::addEntry(
			JText::_('COM_SCHEDULE_SUBMENU_EVENTS'),
			'index.php?option=com_schedule&view=events',
			$curName == 'events'
		);   
        
        JSubMenuHelper::addEntry(
			JText::_('COM_SCHEDULE_SUBMENU_FIELDS'),
			'index.php?option=com_schedule&view=fields',
			$curName == 'fields'
		); 

		JSubMenuHelper::addEntry(
			JText::_('COM_SCHEDULE_SUBMENU_GROUPS'),
			'index.php?option=com_schedule&view=groups',
			$curName == 'groups'
		);

    }
}