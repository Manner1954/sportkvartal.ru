<?php
/**
 * 40° fdporfolio
 *
 * @version     $Id$ 1.0.4
 * @package     Joomla 1.6
 * @copyright   Copyright (C) 2011  Lars Eggert / forty-degrees.com. All rights reserved.
 * @license  GNU/GPL v2
 *
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
//global $mainframe;
JHtml::_('behavior.mootools');
$document = & JFactory::getDocument() ;
$db = & JFactory::getDBO();
$data = $this->data;
$params = $this->params;
$menu = &JSite::getMenu();
$active = $menu->getActive();
$menuparams = $menu->getParams($active->id);
$menucat =  $menuparams->get('catid');

// Set Meta Description
if ($menuparams->get('menu-meta_description'))
   $document->setDescription($menuparams->get('menu-meta_description'));
// Set Meta Keywords
if ($menuparams->get('menu-meta_keywords'))
   $document->setMetadata('keywords', $menuparams->get('menu-meta_keywords'));
$css = JURI::base().'components/com_fdportfolioce/assets/css/fdportfolio.css' ;
$document->addStyleSheet($css);
$js = JURI::base().'components/com_fdportfolioce/assets/js/fdslider.js';
$document->addScript($js);
$js = JURI::base().'components/com_fdportfolioce/assets/js/fdsubslider.js';
$document->addScript($js);
$js = JURI::base().'components/com_fdportfolioce/assets/js/LightFace.js';
$document->addScript($js);
$css = JURI::base().'components/com_fdportfolioce/assets/css/LightFace.css' ;
$document->addStyleSheet($css);
$js = JURI::base().'components/com_fdportfolioce/assets/js/fdportfolio_src.js';
$document->addScript($js);
$js = JURI::base().'components/com_fdportfolioce/assets/js/fdportfolioloader.js';
$document->addScript($js);

$article = 0;

$articles = $this->acount;

$fdarticles =  $this->articles;

if ($articles > $params->columns*$params->rows){
    $allheight = $params->rows * ($params->height+10) + (($params->rows-1)*5);
} else {
    $allheight = ceil($articles / $params->columns)* ($params->height+10) + ((ceil($articles / $params->columns)-1)*5);
}

if ($params->columns > 1) {
    $colwidth = $params->piwidth / $params->columns;
    $outerwidth = ($colwidth - $params->width)/2+$params->width;
    $innerwidth = 2 * $outerwidth + ($params->columns-2)*$colwidth;
} else{
    $innerwidth = $params->piwidth;
}

$innermargin = (($params->piwidth)-$innerwidth) /2;

if ($_GET['cat'] == '-1' || ($_GET['cat'] == '' && $menucat == '-1')) {
    $cat = '-1';
} else if ($_GET['cat'] != '-1' && $_GET['cat'] != '') {
    $cat = $_GET['cat'];
} else {
    $cat = $menucat;
}

$page = 0;

// Count the Categories
$catcount = 0;
foreach($this->cattitles as $cattitle){
    if ($cattitle == "Uncategorised"){
        $catcount++;
    }
}
$catcount = count($this->cattitles) - $catcount;
// echo $catcount;

// Generate the Output
echo '<div class="borderdotted">';
echo '<div id="fdportfolioselecter">';
    if(($_GET['cat'] == '-1' || ($_GET['cat'] == '' && $menucat == '-1'))  && $catcount > 1){
        echo '<div class="fdpselectedbtn"><h2>' . JText::_( 'FDP_ALL' ) . '</h2></div>';
    } else {
        if($_GET['cat'] == '' && $menucat == ''){
            foreach($this->cattitles as $key=>$cattitle){
                if ($cattitle != "Uncategorised"){
                   echo '<div class="fdpselectedbtn"><h2>' . $cattitle . '</h2></div>';
                }
            }
        } else {
            if ($_GET['cat'] == '') {
                echo '<div class="fdpselectedbtn"><h2>' . $this->cattitles[$menucat] . '</h2></div>';
            }else {
                echo '<div class="fdpselectedbtn"><h2>' . $this->cattitles[$_GET['cat']] . '</h2></div>';
            }
        }
    }
    if ($catcount > 1){
        if($_GET['cat'] == '-1' || ($_GET['cat'] == '' && $menucat == '-1')){
            foreach($this->cattitles as $key=>$cattitle){
                if ($cattitle != "Uncategorised"){
                    $link = JRoute::_( 'index.php?option=com_fdportfolioce&view=fdportfolio&cat='. $key, false, 2 );
                    echo '<div class="fdpselectbtn"><h2><a class="fdpselect" href="'.$link.'">' . $cattitle . '</a></h2></div>';
                }
            }
        } else {
            $link = JRoute::_( 'index.php?option=com_fdportfolioce&view=fdportfolio&cat=-1' );
            echo '<div class="fdpselectbtn"><h2><a class="fdpselect" href="'.$link.'">' . JText::_( 'FDP_ALL' ) . '</a></h2></div>';
            foreach($this->cattitles as $key=>$cattitle){
                if ($cattitle != "Uncategorised" && $key != $_GET['cat']){
                    $link = JRoute::_( 'index.php?option=com_fdportfolioce&view=fdportfolio&cat='. $key );
                    echo '<div class="fdpselectbtn"><h2><a class="fdpselect" href="'.$link.'">' . $cattitle . '</a></h2></div>';
                }
            }
        }
    }
echo '</div>';

    echo '<div id="fdportfolio" style="height:'.($allheight).'px; width:'.$params->powidth.'px;">';
        echo '<div id="fdportfoliobtnleft">';
            echo '<a id="btn_left" class="fdportfoliobtn"></a>';
        echo '</div>';
        echo '<div id="fdportfoliobtnright">';
            echo '<a id="btn_right" class="fdportfoliobtn"></a>';
        echo '</div>';
            echo '<div id="fdportfoliowrapper" style="width:'.$params->piwidth.'px; height:'.($allheight).'px;">';                
            echo '</div>';
            echo '<div id="fdportfoliooverlay" style="width:'.(($params->powidth)+10).'px; height:'.($allheight+16).'px;">';
                echo '<div class="fdpajax"><img src="'.JURI::base().'components/com_fdportfolioce/assets/images/loading.gif" /></div>';
            echo '</div>';
    echo '</div>';
    echo '<div id="fdcp"></div>';
    echo '</div>'
?>
<form name="fdportfolioform" action ="">
    <input type="hidden" id="anum" value="<?php echo $articles; ?>" />
    <input type="hidden" id="cols" value="<?php echo $params->columns; ?>" />
    <input type="hidden" id="rows" value="<?php echo $params->rows; ?>" />
    <input type="hidden" id="fdheight" value="<?php echo $allheight; ?>" />
    <input type="hidden" id="dheight" value="<?php echo $params->dheight; ?>" />
    <input type="hidden" id="piwidth" value="<?php echo $params->piwidth; ?>" />
    <input type="hidden" id="iwidth" value="<?php echo $innerwidth; ?>" />
    <input type="hidden" id="thumbw" value="<?php echo $params->width; ?>" />
    <input type="hidden" id="fdpcat" value="<?php echo $cat; ?>" />
    <input type="hidden" id="fdportfoliocheck" value="1" />
</form>
<div class="clr"></div>
<div class="fddotted" style="width: 595px;"></div>
<div class="fdspacer"></div>