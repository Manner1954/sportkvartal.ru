<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class  MannerfolioControllerCategories extends JControllerAdmin
{
	public function getModel($name='categories', $prefix='MannerfolioModel')
	{
		return parent::getModel($name, $prefix, array('ingnore_request' => true));
	}
}