<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldOrdering extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Linetime';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();
		$attr = '';

		// Initialize some field attributes.
		/*$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';

		// Get some field values from the form.
		$dayId	= (int) $this->form->getValue('id');		

		// Build the query for the ordering list.
		$query = 'SELECT ordering AS value, title AS text' .
				' FROM #__schedule_day' .
				//' WHERE catid = ' . (int) $categoryId .
				' ORDER BY ordering';

		// Create a read-only list (no name) with a hidden input to store the value.
		if ((string) $this->element['readonly'] == 'true') {
			$html[] = JHtml::_('list.ordering', '', $query, trim($attr), $this->value, $dayId ? 0 : 1);
			$html[] = '<input type="hidden" name="'.$this->name.'" value="'.$this->value.'"/>';
		}
		// Create a regular list.
		else {
			$html[] = JHtml::_('list.ordering', $this->name, $query, trim($attr), $this->value, $dayId ? 0 : 1);
		}*/
        
        $lines   = range(1, 24);        
        $options = array();
        
        foreach($lines as $id => $text) {
            $option = new stdClass;
            $option->id   = $id;
            $option->text = (string) $text;
            
            $options[] = $option; 
        }
        
        $html[] = JHtml::_('select.genericlist', $options, $this->name, '', 'id', 'text');        

		return implode($html);
        //return JHtml::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'id', 'text', $value, $control_name.$name);
	}
}
