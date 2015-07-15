<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class MannerfolioViewCategories extends JViewLegacy
{
	protected $items;
	protected $pagination;

	public function display($tpl = null)
	{
		try
		{
			$this->items = $this->get('Items');
			$this->pagination = $this->get('Pagination');

			$this->addToolbar();

			parent::display($tpl);
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('COM_MANNERFOLIO_MANNERFOLIOS_MANAGER_CATEGORIES'), 'mannerfolio');
		JToolBarHelper::addNew('category.add');
		JToolBarHelper::editList('category.edit');
		JToolBarHelper::divider();
		JToolBarHelper::deleteList('', 'categories.delete');
	}
}