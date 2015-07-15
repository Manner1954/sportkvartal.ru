<?php
defined('_JEXEC') or die;

//Проверка доступа
if (!JFactory::getUser()->authorise('core.manage', 'com_mannerfolio'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 401);
}

JError::$legacy = false;

$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-mannerfolio {background-image: url(../media/com_mannerfolio/images/mannerfolio-48x48.png);}');

JLoader::register('MannerfolioHelper', dirname(__FILE__).'/helpers/mannerfolio.php');

jimport('jommla.application.component.controller');

$controller =JControllerLegacy::getInstance('mannerfolio');

$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task', 'display'));

$controller->redirect();