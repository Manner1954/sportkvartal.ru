<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class MannerfolioController extends JControllerLegacy
{
	public function display($cashable = false, $urlparams = array())
	{
		$input = JFactory::getApplication()->input;
		MannerfolioHelper::addSubmenu($input->getCmd('view'));
		$input->set('view', $input->getCmd('view', 'mannerfolios'));


		parent::display($cashable);

		return $this;
	}
}