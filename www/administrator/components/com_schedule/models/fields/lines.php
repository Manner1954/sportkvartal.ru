<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldLines extends JFormField
{
    protected $type = 'Lines';
    
    protected function getInput() 
    {
        $html = array();
        $attr = '';
        
        // Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'. (string) $this->element['class'] .'"' : '';        
        $attr .= $this->element['readonly'] == 'true' ? ' readonly="readonly"' : '';            
                        
        $query = 'SELECT id, line_time title'.
				' FROM #__schedule_line'.				
				' WHERE id = '. (int) $this->value;       
        
        $db = JFactory::getDbo();
        $db->setQuery($query);
        $option = $db->loadObject();
        
        $html[] = '<input type="text" name="" value="'. $option->title .'" '. trim($attr) .' />';
        $html[] = '<input type="hidden" name="'. $this->name .'" value="'. $this->value .'" />';     

		return implode($html);
    }    
}