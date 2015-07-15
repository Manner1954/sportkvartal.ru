<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class  MannerfolioControllerMannerfolios extends JControllerAdmin
{
	public function getModel($name='mannerfolio', $prefix='mannerfolioModel')
	{
		return parent::getModel($name, $prefix, array('ingnore_request' => true));
	}
}