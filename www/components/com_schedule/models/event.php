<?php
/**
 * Created by JetBrains PhpStorm.
 * User: AlexOk
 * Date: 13.02.12
 * Time: 0:16
 * To change this template use File | Settings | File Templates.
 */

// No direct access
defined('_JEXEC') or die;

require_once JPATH_COMPONENT_ADMINISTRATOR. '/helpers/fields.php';

jimport('joomla.application.component.modelitem');

class ScheduleModelEvent extends JModelItem
{
    protected function populateState()
    {
        $app = JFactory::getApplication();
        $params	= $app->getParams();

        $id	= $app->input->get->get('id', 0, 'int');

        $this->setState('event.id', $id);

        // Load the parameters.
        $this->setState('params', $params);
    }


    public function getItem($id = null)
    {
        //var_dump($this->item->content);
        //if ($this->item === null) {
        //    $this->item = false;

            if (empty($id)) {
                $id = $this->getState('event.id');
            }

            $row = JTable::getInstance('Event', 'ScheduleTable');

            if ($row->load($id)) {
                $properties = $row->getProperties(1);
                $this->item = JArrayHelper::toObject($properties, 'JObject');
                $this->loadSubFields();
            } else {
                JError::raiseError(404,'Не найдено');
            }

            if ($this->item->article_id) {
                $content_row = JTable::getInstance('Content');
                if ($content_row->load($this->item->article_id)) {
                    $this->item->content = empty($content_row->fulltext) ?  $content_row->introtext : $content_row->fulltext;
                }
            }
        //}

        return $this->item;
    }

    private function loadSubFields()
    {
        $subfields = new FieldsSheduleHelper($this->item);
        $subfields->setItemValues(true);
    }
}