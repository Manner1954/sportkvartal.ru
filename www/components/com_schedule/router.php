<?php
/**
 * Created by JetBrains PhpStorm.
 * User: AlexOk
 * Date: 13.02.12
 * Time: 0:36
 * To change this template use File | Settings | File Templates.
 */

defined('_JEXEC') or die;

function ScheduleBuildRoute(&$query)
{
    $segments = array();

    // get a menu item based on Itemid or currently active
    $app		= JFactory::getApplication();
    $menu		= $app->getMenu();
    $params		= JComponentHelper::getParams('com_schedule');
    $advanced	= $params->get('sef_advanced_link', 0);

    if (empty($query['Itemid'])) {
        $menuItem = $menu->getActive();
    }
    else {
        $menuItem = $menu->getItem($query['Itemid']);
    }

    if (isset($query['view'])) {
        $view = $query['view'];
        $segments[] = $view;
        unset($query['view']);
    }

    if (isset($query['id'])) {
        $id = $query['id'];
        $segments[] = $id;
        unset($query['id']);
    }

    return $segments;
}

function ScheduleParseRoute($segments)
{
    $vars = array();

    //Get the active menu item.
    $app	= JFactory::getApplication();
    $menu	= $app->getMenu();
    $item	= $menu->getActive();
    //$params = JComponentHelper::getParams('com_weblinks');
    //$advanced = $params->get('sef_advanced_link', 0);

    $count = count($segments);

    $vars['view'] = $segments[0];
    $vars['id']	  = $segments[$count - 1];

    return $vars;
}