<?php
/**
 * Core Design Spoiler plugin for Joomla! 2.5
 * @author		Daniel Rataj, <info@greatjoomla.com>
 * @package		Joomla
 * @subpackage	Content
 * @category   	Plugin
 * @version		2.5.x.2.0.2
 * @copyright	Copyright (C) 2007 - 2012 Great Joomla!, http://www.greatjoomla.com
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL 3
 * 
 * This file is part of Great Joomla! extension.   
 * This extension is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This extension is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// no direct access
defined('_JEXEC') or die;

// Import library dependencies
jimport('joomla.plugin.plugin');
jimport('joomla.utilities.string');

class plgContentCdSpoiler extends JPlugin
{
	private	$livepath	=	'';
	
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

		// define language
		$this->loadLanguage();
		
		$this->livepath = JURI::getInstance()->root(true);
	}

	/**
     * Call onContentPrepare function
     * Method is called by the view.
	 *
	 * @param	string	The context of the content being passed to the plugin.
	 * @param	object	The content object.  Note $article->text is also available
	 * @param	object	The content params
	 * @param	int		The 'page' number
	 * @since	1.6
	 */
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// define the regular expression
		$regex = "#\[spoiler(?:\s?(.*?)?)?\](.*?)\[/spoiler\]#is";

		if (!JString::strpos($article->text, '[spoiler')) return false;
		
		// Scriptegrator check
		if (!class_exists('JScriptegrator')) {
			JError::raiseNotice('', JText::_('PLG_CONTENT_CDSPOILER_ENABLE_SCRIPTEGRATOR'));
			return false;
		}
		$JScriptegrator = JScriptegrator::getInstance('2.5.x.2.1.8');
		$JScriptegrator->importLibrary('jquery');
		if ($error = $JScriptegrator->getError()) {
			JError::raiseNotice('', $error);
			return false;
		}
		
		$document = JFactory::getDocument(); // set document
		
		$document->addStyleSheet($this->livepath . '/plugins/content/' . $this->_name . '/css/jquery.' . $this->_name . '.css');
		$document->addScript($this->livepath . '/plugins/content/' . $this->_name . '/js/jquery.' . $this->_name . '.js');
		
		$article->text = preg_replace_callback($regex, array($this, 'replacer'), $article->text);
		
	}
	
	/**
	 * Plugin replacer
	 * 
	 * @return string
	 */
	private function replacer(&$match)
	{
		
		$settings = '';
		$source = '';
		$title = '';
		$title_next = JText::_('PLG_CONTENT_CDSPOILER_TITLE_HOVER_TO_SHOW_HIDE');
		$action = 'click';
		$isPrint = ((int)JRequest::getInt('print', 0) ? 1 : 0);
		$element = 'link';
		
		// settings
		if (isset($match[1]) and $match[1]) $settings = $match[1];
		
		// source
		if (isset($match[2]) and $match[2]) $source = $match[2];
		
		// element
		preg_match('#element\s?=\s?"(link|button)"#', $settings, $element);
		$element = (isset($element[1]) ? $element[1] : $this->params->get('element', 'link'));
		if ($element !== 'link' and $element !== 'button') $element = 'link';
		
		// action
		preg_match('#action\s?=\s?"(click|hover)"#', $settings, $action);
		$action = (isset($action[1]) ? $action[1] : $this->params->get('action', 'click'));
		
		// custom_title
		preg_match('#title\s?=\s?"(.*?)"#', $settings, $title);
		$title = (isset($title[1]) ? $title[1] : JText::_('PLG_CONTENT_CDSPOILER_TITLE'));
		$title_next = ($action === 'hover' ? JText::_('PLG_CONTENT_CDSPOILER_TITLE_HOVER_TO_SHOW_HIDE') : JText::_('PLG_CONTENT_CDSPOILER_TITLE_CLICK_TO_SHOW_HIDE'));
		
		$document = JFactory::getDocument(); // set document
	
		$random = $this->randomString(3);
		
		$script_options = array();
		
		if ($element !== 'link') {
			$script_options[] = "element : '$element'";
		}
		
		if ($action !== 'click') {
			$script_options[] = "action : '" . $action . "'";
		}
		
		$script = "
		<!--
		jQuery(document).ready(function($){
			$('." . $this->_name . ($random ? '_' . $random : '') . " " . ($element === 'link' ? 'a' : 'button') . ":first')." . $this->_name . "({ " . ($script_options ? implode(", ", $script_options) : '') . " });
		});
		// -->
		";
		
		$document->addScriptDeclaration(trim($script));
		
		$tmpl = '';
		
		if (!$layoutpath_view = $this->getLayoutPath('view')) return false;
		
		ob_start();
			require($layoutpath_view);
			$tmpl .= trim(ob_get_contents());
		ob_end_clean();
		
		return $tmpl;
	}
	
	/**
     * Get Layout
     * 
     * @param $file
     * @return string
     */
    private function getLayoutPath($file = '')
    {
    	if (!$file) return false;
    	
    	$filepath = dirname(__FILE__) . DS . 'tmpl' . DS . $file . '.php';
    	if (!JFile::exists($filepath)) return false;
		
		return $filepath;
    }
    
	/**
     * Create a Random String
     * 
     * @param $length
     * @return string
     */
    private function randomString($length = 5)
    {
        $alphanum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $var_random = '';
        mt_srand(10000000 * (double)microtime());
        for ($i = 0; $i < (int)$length; $i++)
            $var_random .= $alphanum[mt_rand(0, 61)];
        unset($alphanum);
        return $var_random;
    }
}
?>