<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class MannerfolioViewCategory extends JViewLegacy
{
	protected $items;
	protected $pagination;

	public function display($tpl = null)
	{
		try
		{
			$this->item = $this->get('Item');

			$this->form = $this->get('Form');

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
		JFactory::getApplication()->input->set('hidemenu', true);
		$isNew = ($this->item->id == 0);


		JToolBarHelper::title($isNew ? JText::_('COM_MANNERFOLIO_MANNERFOLIO_MANAGER_CATEGORY_NEW') : 
									   JText::_('COM_MANNERFOLIO_MANNERFOLIO_MANAGER_CATEGORY_EDIT'));
		JToolBarHelper::apply('category.apply', 'JToolBar_Apply');
		JToolBarHelper::save('category.save');
		JToolBarHelper::cancel('category.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}