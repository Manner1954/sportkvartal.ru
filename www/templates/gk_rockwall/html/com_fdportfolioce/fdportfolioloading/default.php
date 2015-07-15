<?php
/**
* 40° fdporfolio
*
* @version     $Id$ 1.0.4
* @package     Joomla 1.6
* @copyright   Copyright (C) 2011  Lars Eggert / forty-degrees.com. All rights reserved.
* @license  GNU/GPL v3
*
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.mootools');
$document = & JFactory::getDocument() ;
$db = & JFactory::getDBO();
$data = $this->data;
$params = $this->params;
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

$innermargin = 1; // ARt (($params->piwidth)-$innerwidth) /2;

$page = 0;

// Count the Categories
$catcount = 0;

foreach($this->cattitles as $cattitle){
    if ($cattitle == "Uncategorised"){
        $catcount++;
    }
}
$catcount = count($this->cattitles) - $catcount;

// Generate the Output
                echo '<div id="fdportfoliopages">';
                    while ($article < $articles) {
                        echo '<div class="fdportfoliopage" id="fdportfoliopage'.$page.'" style="width:'.$params->piwidth.'px;">';
                            $rows = 0;
                            while($rows < $params->rows && $article < $articles) {
                                echo '<div class="fdportfoliorow">';
                                    $cols = 0;
                                    $articledetails = $article;
                                    $coldetails = $cols;
                                    while($cols < $params->columns && $article < $articles) {
                                        echo '<div class="fdportfoliocolumn" style="height:'.($params->height+10).'px; width:'.($params->piwidth/$params->columns).'px;">';
                                            echo '<div class="fdportfolioitemback" style="height:5px; width:'.($params->piwidth/$params->columns).'px;">';
                                            if($params->shadow == 1){
                                                echo '<img src="'.JURI::root().'components/com_fdportfolioce/assets/images/shadow.png" width="'.$params->width.'" height="5" class="fdback" />';
                                            }
                                            echo '</div>';
                                            echo '<div id="fdportfolioitem'.$article.'" class="fdportfolioitem" style="border: none; width:'.$params->width.'px;height:'.$params->height.'px;">';
                                                // Get the Article Thumbnail
                                                $articleid = $fdarticles[$article]->id;
                                                echo '<img id="fdthumbimg'.$article.'" class="fdthumbimg" src="'.JURI::root().'images/fdthumbs/'.$articleid.'.jpg" alt="Protfolio Item '.$articleid.'"/>';
                                            echo '</div>';
                                        echo '</div>';
                                        $cols++;
                                        $article++;
                                    }

                                echo '</div>';
                                echo '<div class="fdportfoliorowspacer"></div>';
                                echo '<div class="fdclr"></div>';
                                echo '<div class="fdportfoliodetailwrapper" style="width:'.($innerwidth).'px; margin-left:'.$innermargin.'px;">';
                                    while($coldetails < $params->columns && $articledetails < $articles) {
                                        echo '<div id="fdportfoliodetails'.$articledetails.'" class="fdportfoliodetails"  >';
                                            echo '<div class="fdportoilouterwrapper" style="width:'.($innerwidth-10).'px;height:'.($params->dheight).'px">';
                                                echo '<div class="fdportfoilinnerwrapper" style="width:'.(($innerwidth-2)*0.6).'px; height:'.($params->dheight).'px">';
                                                    echo '<div class="fdportfoilleft" id="fdportfoilleft'.$articledetails.'"><a class="btn_foilleft" id="btn_foilleft'.$articledetails.'"></a></div>';
                                                    echo '<div class="fdportfoilright" id="fdportfoilright'.$articledetails.'"><a class="btn_foilright" id="btn_foilright'.$articledetails.'"></a></div>';
                                                    echo '<div class="fdportfoilwrapper" id="fdportfoilwrapper'.$articledetails.'" style="width:'.(($innerwidth-2)*0.6).'px; height:'.($params->dheight-10).'px">';

                                                        echo '<div class="fdportfoilimagewrapper" id="fdportfoilimagewrapper'.$articledetails.'" style="width:'.(($innerwidth-2)*0.6).'px;height:'.($params->dheight-10).'px">';

                                                            // Get the Article Content
                                                            $fdcontent = $fdarticles[$articledetails]->introtext;
                                                            $fdfulllink = "";
                                                            $fdlink = "";

                                                            // Get the Link
                                                            if (strpos($fdcontent, "<a href") !== false) {
                                                                $fdlink = substr($fdcontent, strpos($fdcontent, '<a href="')+9 );
                                                                $fdlink = substr($fdlink, 0, strpos($fdlink, '"'));
                                                                $fdfulllink = substr($fdcontent, strpos($fdcontent, '<a href="'));
                                                                $fdfulllink = substr($fdfulllink, 0, strpos($fdfulllink, '</a>')+4);
                                                            }




                                                            // get the Images
                                                            $fdnewcontent = $fdcontent;
                                                            $fdImageCount = 0;
                                                            while(strpos($fdnewcontent, "<img")!==false){
                                                                $imgstart = strpos($fdnewcontent, "<img");
                                                                $fdnewcontent = substr($fdnewcontent, $imgstart);
                                                                $imgend = strpos($fdnewcontent, "/>")+2;
                                                                $fdimage = substr($fdnewcontent, 0, $imgend);
                                                                $fdnewcontent = substr($fdnewcontent, $imgend);
                                                                $fdalttag = substr($fdimage, strpos($fdimage, "title=")+7);
                                                                $fdalttag = substr($fdalttag, 0, strpos($fdalttag, '"'));
                                                                $src = substr($fdimage, strpos($fdimage, "src=")+5);
                                                                $src = substr($src, 0, strpos($src, '"'));
                                                                if(strpos($fdimage, 'class="fdImage"')!==false){
                                                                    // echo $fdarticles[$articledetails]->id;
                                                                    // $fdimage = substr($fdimage, 0, 4) . ' id="fdImage'.$articledetails.'img'.$fdImageCount.'" name="fdpImage" style="cursor:url('.JURI::root().'components/com_fdportfolio/assets/images/piclense.gif), pointer;" onclick="javascript: fdLightBox(\''.$fdalttag.'\', \''.JURI::root().$src.'\')"' . substr($fdimage, 4);
                                                                    $fdimage = '<img id="fdImage'.$articledetails.'img'.$fdImageCount.'"  style="cursor:url('.JURI::root().'components/com_fdportfolioce/assets/images/piclense.gif), pointer;" onclick="javascript: fdLightBox(\''.$fdalttag.'\', \''.JURI::root().$src.'\')"' . ' src="'.JURI::root().'images/fdthumbs/'.($fdarticles[$articledetails]->id).'_p'.$fdImageCount.'.jpg" alt="'.$alttag.'" />';
                                                                    echo '<div class="fdportfoilimage" style="width:'.(($innerwidth)*0.6).'px; height:'.($params->dheight-10).'px;">';
                                                                        echo '<div class="fdportfoilimagecontainer" id="fdportfoilimagecontainer'.$articledetails.'img'.$fdImageCount.'" style="width:'.(($innerwidth)*0.6).'px; height:'.($params->dheight).'px">';
                                                                            echo $fdimage;
                                                                        echo '</div>';
                                                                        echo '<div class="fdimagetools" id="fdimagetools'.$articledetails.'img'.$fdImageCount.'">';
                                                                            echo '<div class="fdimagetitle">'.$fdalttag.'</div>';
                                                                            echo '<div class="fdimageiconwrapper">';
                                                                                if(!empty($fdlink)) echo '<div class="fdimageicon"><a href="'.$fdlink.'" target="_blank"><img src="'.JURI::root().'components/com_fdportfolioce/assets/images/world.gif" style="cursor:pointer;border:none;" alt="'.$fdalttag.'"/></a></div>';
                                                                                echo '<div class="fdimageicon"><img src="'.JURI::root().'components/com_fdportfolioce/assets/images/zoom.gif" style="cursor: pointer;" onclick="javascript: fdLightBox(\''.$fdalttag.'\', \''.JURI::root().$src.'\')" alt="'.$fdarticles[$articledetails]->title.' Website" /></div>';
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                    $fdImageCount++;
                                                                }
                                                            }
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                                echo '<div class="fdportfoildescwrapper" style="width:'.(($innerwidth-2)*0.4-20).'px;">';
                                                    echo '<div class="fdportfoiltitle"><h2>'.$fdarticles[$articledetails]->title.'</h2></div>';
                                                    echo '<div class="fdportfoildescspacer"></div>';
                                                    echo '<div class="fdportfoildesc">'.$fdarticles[$articledetails]->fulltext.'</div>';
                                                    echo '<div class="fdportfoilwebwrapper">';
                                                        if (!empty($fdfulllink)) echo '<div class="fdportfoildescspacer"></div>';
                                                        if (!empty($fdfulllink)) echo '<div class="fdportfoilweb">'.$fdfulllink.'</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                                echo '<div class="fdclose" id="fdclose'.$articledetails.'"><img src="'.JURI::root().'components/com_fdportfolioce/assets/images/fdclose.gif" style="cursor: pointer;" alt="Close" /></div>';
                                            echo '</div>';
                                        echo '</div>';
                                        $articledetails++;
                                        $coldetails++;
                                    }
                                echo '</div>';
                                $rows++;
                            }
                        echo '</div>';
                            $page++;
                    }
              echo '</div>';
?>