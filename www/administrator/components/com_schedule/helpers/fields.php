<?php

class FieldsSheduleHelper
{
    private $fields       = array();
    private $isset_fields = array();
    private $values       = null;

    private $item  = array();
    private $items = array();

    /**
     * @param JObject|array $item
     * @param null $form
     * @param boolean $someItems
     */
    public function __construct(& $item, & $form = null, $someItems = false)
    {
        $this->loadIssetFields();

        if ($someItems) {
            $this->items = $item;
            return;
        }

        if (is_array($item))
            $item = (object) $item;

        $this->item = $item;

        if ($form === null)
            return;

        $this->fields = $this->createInputs();
        $this->setFormValues($form);
        $this->setItemValues($item);
    }

    public function saveItemValues()
    {
        var_dump($this);
        //stop();

        if (!$this->item->id)
            return;

        foreach($this->isset_fields as $f) {
            if (!property_exists($this->item, $f->name))
                continue;

            $params = array(
                'event_id'=>$this->item->id,
                'field_id'=>$f->id
            );

            $row = JTable::getInstance('fieldvalue', 'ScheduleTable');
            $old = $row->load($params);

            if (!$old) {
                $row->bind($params);
            }

            $row->value = $this->item->{$f->name};
            $row->store();
        }
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getNames()
    {
        $result = array();

        foreach($this->isset_fields as $f) {
            $result[] = $f->name;
        }
        return $result;
    }

    /**
     * Add values to form
     * @param $form
     * @return mixed
     */
    public function setFormValues(&$form)
    {
        $form->setFields($this->fields);

        $id = $this->item->id;
        if (!$id)
            return;

        $values = $this->getItemValues($id);
        foreach($values as $v) {
            $name = $this->findFieldNameById($v->field_id);
            $form->setValue($name, null, $v->value);
        }
    }

    /**
     * Add values to item
     * @param $convert
     * @return mixed
     */
    public function setItemValues($convert = false)
    {
        if (!$this->item->id)
            return;

        $values = $this->getItemValues($this->item->id);

        if ($convert) {
            $this->checkValues();
        }

        $this->item->fields = new stdClass();
        foreach($values as $v) {
            $name = $this->findFieldNameById($v->field_id);
            if ($convert)
                $this->item->fields->{$name} = $v->value;
            else
                $this->item->{$name} = $v->value;
        }
    }

    /**
     * Add values form some items
     */
    public function setItemsValues()
    {
        $ids = array();
        foreach($this->items as $item) {
            $ids[] = $item->event_id;
        }

        $this->getItemValues($ids);
        $this->checkValues();
        foreach($this->items as $id=>$item) {
            foreach($this->isset_fields as $f) {
                if (!$f->published)
                    continue;
                $this->items[$id]->subfields->{$f->name} = $this->findValue($item->event_id, $f->id);
            }
        }
    }
    
    /** ARt +++ Administration
     * Add values form some items
     */
    public function setItemsValuesAdm()
    {
        $ids = array();
        foreach($this->items as $item) {
            $ids[] = $item->id;
        }

        $this->getItemValues($ids);
        $this->checkValues();

        foreach($this->items as $id=>$item) {
            foreach($this->isset_fields as $f) {
                if (!$f->published)
                    continue;
                $this->items[$id]->subfields->{$f->name} = $this->findValue($item->id, $f->id);
            }
        }
    }
    /** ARt ---



    /**
     * Load field settings
     * @return mixed
     */
    private function loadIssetFields()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__schedule_field f');
        $query->order('ordering, id');

        $db->setQuery($query);
        return $this->isset_fields = $db->loadObjectList();
    }

    private function createInputs()
    {
        $inputs = array();

        foreach($this->isset_fields as $f) {
            $inputXML = $this->generateFieldXML($f);
            $inputs[] = $inputXML;
        }

        return $inputs;
    }

    private function generateFieldXML($data)
    {
        $xml   = new DomDocument('1.0', 'utf-8');

        $field = $xml->createElement('field');
        $field->setAttribute('name', $data->name);
        $field->setAttribute('label', $data->title);
        $field->setAttribute('type', $data->type);

        if ($data->type == 'list') {
            foreach($this->getFieldValues($data) as $n=>$v) {
                $option = $xml->createElement('option', $v);
                $option->setAttribute('value', $n);
                $field->appendChild($option);
            }
        } elseif ($data->type=='editor') {
            $field->setAttribute('width', 'auto');
        }

        $xml->appendChild($field);
        $xml->formatOutput = true;
        return new JXMLElement($xml->saveXML());
    }

    private function getFieldValues($data)
    {
        $result = array();
        $values = explode(';', $data->value);

        foreach($values as $val) {
            if (!empty($val)) {
                list($k, $v) = explode('=', $val);
                $result[$k] = $v;
            }
        }

        return $result;
    }

    /**
     * @param int|array $id
     * @return mixed|null
     */
    private function getItemValues($id)
    {
        if ($this->values === null) {
            $db = JFactory::getDbo();

            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__schedule_field_value fv');
            $query->order('id');

            if (is_array($id)) {
                $query->where('event_id IN ('. implode(',', $id) .')');
            } else {
                $query->where('event_id = '. (int) $id);
            }

            $db->setQuery($query);
            $result = $db->loadObjectList();
            return $this->values = $result ? $result : array();
        }
        return $this->values;
    }

    /**
     * Convert values
     */
    private function checkValues()
    {
        foreach($this->values as $id=>$value) {
            $field = $this->getFieldById($value->field_id);

            if ($field->type == 'list') {
                $options = $this->getFieldValues($field);
                $this->values[$id]->value = $options[$value->value];
            }
            /* Other convert types */
        }
    }

    private function findFieldNameById($id)
    {
        foreach($this->isset_fields as $f) {
            if ($f->id == $id) {
                return $f->name;
            }
        }
        return false;
    }

    private function getFieldById($id)
    {
        foreach($this->isset_fields as $f) {
            if ($f->id == $id) {
                return $f;
            }
        }
        return false;
    }

    /**
     * @param int $eid Event id
     * @param int $fid Field id
     * @return bool|mixed
     */
    private function findValue($eid, $fid)
    {
        foreach($this->values as $val) {
            if ($val->event_id == $eid && $val->field_id == $fid) {
                // if ($)
                return $val->value;
            }
        }
        return false;
    }
}