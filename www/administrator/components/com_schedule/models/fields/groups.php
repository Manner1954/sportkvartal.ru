<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
require_once JPATH_COMPONENT_ADMINISTRATOR. '/helpers/fields.php';

class JFormFieldGroups extends JFormField
{
    protected $type = 'Groups';
    
    protected function getInput() 
    {
        $html = array();
        $attr = '';
        
        // Initialize some field attributes.
		//$attr .= $this->element['class'] ? ' class="'. (string) $this->element['class'] .'"' : '';		
        //$attr .= $this->element['readonly'] == 'true' ? ' readonly="readonly"' : '';                           
                        
        $query = 'SELECT id, title FROM #__schedule_group ORDER BY ordering, id';       
        
        $db = JFactory::getDbo();
        $db->setQuery($query);
        $options = $db->loadObjectList();
        
        $html[] = '<select name="'. $this->name .'" '. trim($attr) .'>';
        $html[] = '<option value="">- Выберите -</option>';

        //$html[] = '<input type="text" name="" value="'. $option->title .'" '. trim($attr) .' />';
        //$html[] = '<input type="hidden" name="'. $this->name .'" value="'. $this->value .'" />';
       foreach($options as $option) {
            if ($option->id == $this->value)
                $html[] = '<option value="'. $option->id .'" selected="selected">'. $option->title .'</option>';
            else
                $html[] = '<option value="'. $option->id .'">'. $option->title .'</option>';
        }

        $html[] = '</select>';

		return implode($html);
    }    
}