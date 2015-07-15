<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 */
class JFormFieldColorpicker extends JFormField
{
	/**
	 * Color picker form field type compatible with Joomla 1.6. Displays an Adobe type color picker panel, and returns a six-digit hex value, eg #cc99ff
	 */
	protected $type = 'Colorpicker';

	/**
	 */
	protected function getInput()
	{
		
		
		$class		= ' class="color {hash:true,adjust:false}" ';
		$scriptname	 = JURI::root().'/modules/mod_jpanel/fields/jscolor.js';
	
		$doc = JFactory::getDocument();
		$doc->addScript($scriptname);

		return '<input type="text" name="'.$this->name.'" id="'.$this->id.'"' .
				' value="'.htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8').'"' .
				$class.'/>';
	}
}
