<?php

defined ('_JEXEC') or die;

$document = JFactory::getDocument();

$css = JURI::base().'components/com_mannerfolio/assets/css/main.css' ;
$document->addStyleSheet($css);
$css = JURI::base().'components/com_mannerfolio/assets/css/baw.css' ;
$document->addStyleSheet($css);
$js = JURI::base().'components/com_mannerfolio/assets/js/jquery.min.js';
$document->addScript($js);
$js = JURI::base().'components/com_mannerfolio/assets/js/beauty_spa.js';
$document->addScript($js);
$js = JURI::base().'components/com_mannerfolio/assets/js/jquery.BlackAndWhite.js';
$document->addScript($js);
?>
<script>
  $(window).load(function(){
  $('.bwWrapper').BlackAndWhite({
      hoverEffect:true,
      webworkerPath: false,
      onImageReady:function(img){
        $(img).parent().animate({
          opacity:1
        });
      }
    });
  });
</script>
<!-- <div class="div_grey">  
 -->
<div class="gkPage" style="margin: 0 auto; width: 100%;">
    <h2 class="itemTitle"><div class="headerBorderRadius"><?php echo $this->menu->title; ?></div></h2>
</div>
<article class="item-page">
  <div class="gkPage" style="margin: 0 auto; width: 100%;">

    <div class="superbox">
    <?php 
 //   $iDiv = 0;
 //   $mleft = -227;
    foreach ($this->items as $item) : 
 //        $iDiv++;
 //         if($iDiv == 1) { ?>
            <!-- <div class="some-train-div" style="clear: both; position: relative;"> -->
          <?php //} ?>

  <!--           <div style="float: left;" class="some-train">   
              <div class="content content-sub b-fitness_child">
        	        <div class="b-trains">
                    <div style="position:relative;" class="item bwWrapper">
                      <img src="<?php echo $item->image; ?>" class="sepia"> 
                      <div class="summary"><?php echo $item->name; ?></div>
                          <div class="info">
                              <?php if($item->typecard == 0) : ?>
                                <span class="instructor"><?php echo $item->professio; ?></span>
                              <?php else : ?>
                                <span class="time"><?php echo $item->professio; ?></span>
                              <?php endif; ?>
                          </div>
                      <div class="content_wrap">
                        <div class="content-short">
                            <p style="cursor: pointer;">
                                <?php echo $item->intodesc; ?><a class="more" href="javascript:void(0);">…</a><span class="hidden"> <?php echo $item->fulldesc; ?></span>                         
                            </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="some-train-full" style="display: none; margin-left:<?php echo $mleft * ($iDiv-1) ?>px;">
                  <img src="<?php echo $item->image; ?>">
                </div>
               </div>

          <?php if($iDiv == 4) { $iDiv = 0; ?>
            </div>
          <?php } ?>
 -->
        <div class="superbox-list bwWrapper">  
          <img src="<?php echo $item->image; ?>" data-img="<?php echo $item->image; ?>" alt="" class="superbox-img">
          <div style="display: none">  
            <span id="trainername"><?php echo $item->name; ?></span>
            <span id="intodesc"><?php echo $item->intodesc; ?></span>
            <span id="fulldesc"><?php echo $item->fulldesc; ?></span>
          </div>
        </div><!--
        -->
    <?php endforeach; ?>
        <div class="superbox-float"></div>
    </div>
  

    <script>
      jQuery(document).ready(function($) {
         $('.superbox').SuperBox();
      });
    </script>
  </div>
</article>
<!-- </div> -->