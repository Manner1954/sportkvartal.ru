<?php
/**
 * @package		mod_jpanel
 * @copyright	Copyright (C) 2012 Girolamo Tomaselli All rights reserved.
 * @email		girotomaselli@gmail.com
 * @website		http://bygiro.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/*
jimport('joomla.application.component.model');
JModel::addIncludePath(JPATH_SITE.'/components/com_content/models');
*/

class mod_jpanelHelper{
	
	public function return_modules($params){
		
		jimport( 'joomla.application.module.helper' );
		$pos = $params->get('whatMod');
		
		$db = JFactory::getDBO();
		$sql = "SELECT * FROM #__modules WHERE position = '".$pos."' AND published = 1 ORDER BY ordering";
		$db->setQuery($sql);
		$modules = $db->loadObjectList();
		
		if ($params->def('prepare_content', 1))
		{
			JPluginHelper::importPlugin('content');
			foreach($modules as $module){				
				$module->content = JHtml::_('content.prepare', $module->content);
			}
		}
		
		return $modules;
	}
	
	public function return_article($params){
				
		$zearticle = $params->get('whatArt');

		$db = JFactory::getDBO();

		$sql = "SELECT * FROM #__content WHERE id = ".intval($zearticle);
		$db->setQuery($sql);
		$article = $db->loadAssoc();
		
		if ($params->def('prepare_content', 1))
		{
			JPluginHelper::importPlugin('content');
			$article['introtext'] = JHtml::_('content.prepare', $article['introtext']);
			$article['fulltext'] = JHtml::_('content.prepare', $article['fulltext']);

		}
		
		if($article['state'] == 0) {
			$article = "";
		}
	
		return $article;

	}
	
	public function load_jquery($params){
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();
		
		if($params->get('load_jquery')){	
			JLoader::import( 'joomla.version' );
			$version = new JVersion();
			if (version_compare( $version->RELEASE, '2.5', '<=')) {
				if($app->get('jquery') !== true) {
				$file='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js';
				$app->set('jquery',1);
				$doc->addScript($file);
				}
			} else {
				JHtml::_('jquery.framework');
			}
		}			
	}
	
	public function verticaltext($str)
	{
			// place each character of the string into and array 
			$split=1; 
			$array = array(); 
			for ( $i=0; $i < strlen( $str ); ){ 
				$value = ord($str[$i]); 
				if($value > 127){ 
					if($value >= 192 && $value <= 223) 
						$split=2; 
					elseif($value >= 224 && $value <= 239) 
						$split=3; 
					elseif($value >= 240 && $value <= 247) 
						$split=4; 
				}else{ 
					$split=1; 
				} 
					$key = NULL; 
				for ( $j = 0; $j < $split; $j++, $i++ ) { 
					$key .= $str[$i]; 
				} 
				array_push( $array, $key ); 
			}
		   
		   $vtext = '';
		   foreach($array as $char){
				if($char == ' '){ $char = '&nbsp;';}
				$vtext .= '<p>'. $char ."</p>";
		   }		   
		   
		   return $vtext;
	}
	
}