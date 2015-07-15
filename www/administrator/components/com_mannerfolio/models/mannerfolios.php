<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class MannerfolioModelMannerfolios extends JModelList
{
	public function __construct($config = array())
	{
		if(empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id', 
				'name', 'a.name', 
				'state', 'a.state', 
				'ordering', 'a.ordering'
				);
		}

		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		$query->select(
			$this->getState(
				'list.select', 'a.*, c.name AS category_name')
			);
		$query->from('#__mannerfolio AS a');
		// Join over the categories.
		//$query->select('c.name AS category_name');
		$query->join('LEFT', '#__mannerfolio_cat AS c ON c.id = a.catid');

		// Filter by category.
		$categoryId = $this->getState('filter.category_id');
		if (is_numeric($categoryId)) {
			$query->where('a.catid = '.(int) $categoryId);
		}

		// Filter by published state.
		$state = $this->getState('filter.state');
		if (is_numeric($state)) {
			$query->where('a.state = '.(int) $state);
		}
		elseif ($state === '') {
			$query->where('(a.state IN (0, 1))');
		}
		// Filter by search in subject or message.
		$search = $this->getState('filter.search');

		if (!empty($search)) {
			$search = $db->Quote('%'.$db->escape($search, true).'%', false);
			$query->where('a.name LIKE '.$search);
		}

		$orderCol = $this->state->get('list.ordering', 'a.name');
		$orderDirn = $this->state->get('list.direction', 'asc');
		$query->order($db->escape($orderCol.' '.$orderDirn));

		return $query;
	}

	protected function populateState($ordering = null, $direction = null)
	{
				// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $state);

		$categoryId = $this->getUserStateFromRequest($this->context.'.filter.category_id', 'filter_category_id', '');
		$this->setState('filter.category_id', $categoryId);

		parent::populateState('a.name', 'asc');
	}
}