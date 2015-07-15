<?php

defined ('_JEXEC') or die;

jimport ('joomla.application.component.view');

class MannerfolioViewMannerfolio extends JViewLegacy
{
	protected $items;
	protected $params;

	public function display($tpl = null)
	{
		try
		{
			$this->items = $this->get("Items");
			
			$app = JFactory::getApplication();
			$this->params = $app->getParams();
			$this->_prepareDocument();

			$this->menu = JFactory::getApplication()->getMenu()->getActive();

			parent::display($tpl);

			return true;
		}
		catch(Exception $e)
		{
			JFactory::getApplication()->enqueueMessage(JText::_('COM_MANNERFOLIO_ERROR_OCCURRED'), 'error');
			JLog::add($e->getMessage(), JLog::ERROR, 'com_mannerfolio');
		}
	}

	protected function _prepareDocument()
	{
		$app = JFactory::getApplication();
		$menus = $app->getMenu();
		$title = null;
		$menu = $menus->getActive();
		
		if($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title'), $menu->title);
		}
		else
		{
			$this->params->def('page_heading', JText::_('COM_MANNERFOLIO_DEFAULT_PAGE_TITLE'));
		}

		$title = $this->params->get('page_title', '');

		if(empty($title))
		{
			$title = $app->getCfg('sitename');
		}
		elseif($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		else
		{
			$title =  $menu->title;
		}

		$this->document->setTitle($title);

		if($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}

	}
}