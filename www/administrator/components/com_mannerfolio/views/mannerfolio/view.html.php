<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class MannerfolioViewMannerfolio extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $canDo;

	public function display($tpl = null)
	{
		try
		{
			$this->item = $this->get('Item');
			$this->form = $this->get('Form');
			$this->canDo = MannerfolioHelper::getActions($this->item->catid, $this->item->id);

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


		JToolBarHelper::title($isNew ? JText::_('COM_MANNERFOLIO_MANNERFOLIO_MANAGER_NEW') : 
									   JText::_('COM_MANNERFOLIO_MANNERFOLIO_MANAGER_EDIT'), 'mannerfolio');
		if($isNew)		
		{
			if($this->canDo->get('core.create'))
			{
				JToolBarHelper::apply('mannerfolio.apply', 'JToolBar_Apply');
				JToolBarHelper::save('mannerfolio.save');
				JToolBarHelper::custom('mannerfolio.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			}
		JToolBarHelper::cancel('mannerfolio.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
		}
		else
		{
			if($this->canDo->get('core.edit'))
			{
				JToolBarHelper::apply('mannerfolio.apply', 'JToolBar_Apply');
				JToolBarHelper::save('mannerfolio.save');

				if($this->canDo->get('core.create'))
				{
					JToolBarHelper::custom('mannerfolio.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}

			if($this->canDo->get('core.create'))
			{
				JToolBarHelper::custom('mannerfolio.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			}

			JToolBarHelper::cancel('mannerfolio.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
		}
	}

	/*protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->addScript(JURI::root().$this->script);
		$document->addScript(JURI::root()."administrator/components/com_mannerfolio/views/manerfolio/submitbuttons.js");
	}*/
}