<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldDays extends JFormField
{
    protected $type = 'Days';
    
    protected function getInput() 
    {
        $html = array();
        $attr = '';
        
        // Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'. (string) $this->element['class'] .'"' : '';		
        $attr .= $this->element['readonly'] == 'true' ? ' readonly="readonly"' : '';              
        //$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';                
                        
        $query = 'SELECT id, title'.
				' FROM #__schedule_day'.				
				' WHERE id = '. (int) $this->value;       
        
        $db = JFactory::getDbo();
        $db->setQuery($query);
        $option = $db->loadObject();
        
        $html[] = '<input type="text" name="" value="'. $option->title .'" '. trim($attr) .' />';
        $html[] = '<input type="hidden" name="'. $this->name .'" value="'. $this->value .'" />';     

		return implode($html);
    }    
}