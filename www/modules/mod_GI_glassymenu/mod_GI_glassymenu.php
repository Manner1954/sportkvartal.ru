<?php
/**
* @package        Glassy Menu
* @copyright      Copyright (C) 2010 Global Illusion Kft. All rights reserved.
* @license        GNU/GPL
* @website        http://offlajn.com
* @email          janos.biro@offlajn.com
*
*/

  if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
   
  $module->navClassPrefix = 'off-nav-';
  $module->instanceid = 'offlajn-accordion-'.$module->id.'-1';
  $module->containerinstanceid = $module->instanceid.'-container';
  if(version_compare(JVERSION,'1.6.0','ge')) {
    require_once(dirname(__FILE__).DS.'params'.DS.'library'.DS.'flatArray.php');
    $params->loadArray(offflat_array($params->toArray()));
  }

  

  $opacity = $params->get('opacity', 0.5);
  $menuitemdistance = $params->get('menuitemdistance', 10);
  $menutop = $params->get("menutop",50);
  $menupos = $params->get("position",1);
  
  
  
  /*
  Build the Javascript cache and scopes
  */ 
  require_once(dirname(__FILE__).DS.'classes'.DS.'cache.class.php');
  $cache = new OfflajnMenuThemeCache('default', $module, $params);
  
  $document =& JFactory::getDocument();
  
  $theme = $params->get('theme', 'default');
  $size = $params->get('size','small');


  /*
  Build the CSS
  */ 
  $cache->addCss(dirname(__FILE__) .DS. 'themes' .DS. 'clear.css.php');
  $cache->addCss(dirname(__FILE__) .DS. 'themes' .DS. $theme .DS. 'theme.css.php');
  
  
  
  /*
  Set up enviroment variables for the cache generation
  */
  require_once(dirname(__FILE__).DS.'classes'.DS.'ImageHelper.php');
  
  $module->url = JUri::root(true).'/modules/'.$module->module.'/';
  $cache->addCssEnvVars('module', $module);
  $cache->addCssEnvVars('helper', new OfflajnHelper7($cache->cachePath, $cache->cacheUrl));

  $menuitems = array();
  $i=1;
  $item = $params->get("level".$i."linktitle");
  while($item){
    $menuitems[] = array(
                      "id"=> ($i-1),
                      "name"=> "level".$i,
                      "color"=>$params->get("level".$i."color","ffffff")
                      );
    $i++;
    $item = $params->get("level".$i."linktitle");           
  }
  $definedLevel = $i;
  
  $cache->addCssEnvVars('definedLevel',$definedLevel);
  $cache->addCssEnvVars('menuitems',$menuitems);



  /*
  Add cached contents to the document
  */
  $cacheFiles = $cache->generateCache();
  $document->addStyleSheet($cacheFiles[0]); 
  $document->addScript($cacheFiles[1]);  
 
  $document->addScript('https://ajax.googleapis.com/ajax/libs/dojo/1.6/dojo/dojo.xd.js');
  $document->addScript('modules/mod_GI_glassymenu/Engine/engine.js');
 
  
  $glassy = "";
  for($i=1; $i<$definedLevel;$i++){
    if($menupos == 1 && $theme=="carbonite"){
      $glassy .=("<div class=\"menu\" id=\"menu".($i)."\">
      <a href=\"".$params->get("level".$i."linkurl")."\" class=\"menu_left\">".$params->get("level".$i."linktitle")."</a>
      <a href=\"".$params->get("level".$i."linkurl")."\" class=\"menu_mid\"></a>
      <a  class=\"menu_right\"></a>
      </div>");
    }elseif($theme=="carbonite"){
      $glassy .=("<div class=\"menu\" id=\"menu".($i)."\">
      <a  class=\"menu_right\"></a>
      <a href=\"".$params->get("level".$i."linkurl")."\" class=\"menu_mid\"></a>
      <a href=\"".$params->get("level".$i."linkurl")."\" class=\"menu_left\">".$params->get("level".$i."linktitle")."</a>
      </div>");
    }else{
      $glassy .=("<div class=\"menu\" id=\"menu".($i)."\">
      <a href=\"".$params->get("level".$i."linkurl")."\" class=\"menu_left\"></a>
      <a href=\"".$params->get("level".$i."linkurl")."\" class=\"menu_mid\">".$params->get("level".$i."linktitle")."</a>
      <a href=\"".$params->get("level".$i."linkurl")."\" class=\"menu_right\"></a>
      </div>");
    } 
  }
  
  $glassy = json_encode($glassy);

  
  $document->addScriptDeclaration("
  var glassy;
  dojo.addOnLoad(function(){
      glassy = new glassyMenu({
        glassy: ".$glassy.",
        opacity : ".$opacity.",
        menudist : ".$menuitemdistance.",
        menutop : ".$menutop.",
        position : ".$menupos."
      })
    });" 
  );  
    
?>    