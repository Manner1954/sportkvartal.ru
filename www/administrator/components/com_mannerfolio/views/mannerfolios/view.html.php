<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class MannerfolioViewMannerfolios extends JViewLegacy
{
	protected $items;
	protected $pagination;

	// Состояние модели
	protected $state;

	//Доступ пользователя
	protected $canDo;

	public function display($tpl = null)
	{
		try
		{
			$this->items = $this->get('Items');
			$this->pagination = $this->get('Pagination');
			// Получаем объект состояния модели
			$this->state = $this->get('State');


			$this->canDo = MannerfolioHelper::getActions();

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
		JToolBarHelper::title(JText::_('COM_MANNERFOLIO_MANNERFOLIOS_MANAGER'), 'mannerfolio');
		if($this->canDo->get('core.create'))
		{
			JToolBarHelper::addNew('mannerfolio.add');
		}
		
		if($this->canDo->get('core.edit'))
		{
			JToolBarHelper::editList('mannerfolio.edit');
		}

		if($this->canDo->get('core.edit.state'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::publish('mannerfolios.publish', 'JTOOLBAR_PUBLISH', true);
			JToolBarHelper::unpublish('mannerfolios.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}

		if($this->canDo->get('core.delete'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::deleteList('', 'mannerfolios.delete');
		}

		if($this->canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_mannerfolio');
		}
	}
}