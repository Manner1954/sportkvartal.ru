<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
require_once JPATH_COMPONENT_ADMINISTRATOR. '/helpers/fields.php';

class JFormFieldEvents extends JFormField
{
    protected $type = 'Events';
    
    protected function getInput() 
    {
        $html = array();
        $attr = '';
        
        // Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'. (string) $this->element['class'] .'"' : '';		
        $attr .= $this->element['readonly'] == 'true' ? ' readonly="readonly"' : '';                           
                        
        $query = 'SELECT id, title FROM #__schedule_event ORDER BY ordering, id';       
        
        $db = JFactory::getDbo();
        $db->setQuery($query);
        $options = $db->loadObjectList();
                //print_r($options);

        $html[] = '<select name="'. $this->name .'" '. trim($attr) .'>';
        $html[] = '<option value="">- Выберите -</option>';

        $subfields = new FieldsSheduleHelper($options, $options, true);
        $subfields->setItemsValuesAdm();
        foreach($options as $option) {
            if ($option->id == $this->value)
                $html[] = '<option value="'. $option->id .'" selected="selected">'. $option->title . ' (' . $option->subfields->trainer . ')' . '</option>';
            else
                $html[] = '<option value="'. $option->id .'">'. $option->title  . ' (' . $option->subfields->trainer . ')' . '</option>';            
        }                
        //$html[] = '<input type="text" name="" value="'. $option->title .'" '. trim($attr) .' />';
        //$html[] = '<input type="hidden" name="'. $this->name .'" value="'. $this->value .'" />';
        $html[] = '</select>';     

		return implode($html);
    }    
}