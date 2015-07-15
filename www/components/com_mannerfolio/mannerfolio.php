<?php
	defined('_JEXEC') or die;

	JLog::addLogger(
		array('text_file' => 'com_mannerfolio.php'),
		JLog::ALL,
		array('com_mannerfolio')
	);
	JError::$legacy = false;

	jimport('joomla.application.component.controller');

	$controller = JControllerLegacy::getInstance('Mannerfolio');

	$input = JFactory::getApplication() -> input;
	$controller->execute($input->getCmd('task', 'display'));

	$controller->redirect();