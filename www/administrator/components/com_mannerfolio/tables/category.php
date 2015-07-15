<?php 
	defined('_JEXEC') or die;

	jimport('joomla.database.table');

	class MannerfolioTableCategory extends JTable
	{
		function __construct(&$db)
		{
			parent::__construct('#__mannerfolio_cat', 'id', $db);
		}
	}