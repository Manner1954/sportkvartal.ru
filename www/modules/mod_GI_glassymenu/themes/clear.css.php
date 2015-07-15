<?php

$i=1;
$item = $params->get("level".$i."linktitle");
while($item){
  $i++;
  $item = $params->get("level".$i."linktitle");
}
$definedLevel =$i;



$GLOBALS['googlefontsloaded'] = array();

foreach($params->toArray() AS $k => $p){
    
  if(strpos($k, 'font')){
    $p = explode('|*', $p);
    $p[0] = str_replace('*','',$p[0]);
    $$k = $p;
    if($p[0] == '0') continue;
    $t = $p[2];
    if($p[4] == 1){
      $t.=':700';
    }else{
      $t.=':400';
    }
    if($p[5] == 1){
      $t.='italic';
    }
    $subset = $p[0];
    if($subset == 'LatinExtended'){
      $subset = 'latin,latin-ext';
    }else if($subset == 'CyrillicExtended'){
      $subset = 'cyrillic,cyrillic-ext';
    }else if($subset == 'GreekExtended'){
      $subset = 'greek,greek-ext';
    }
    $t.='&subset='.$subset;
    if(isset($GLOBALS['googlefontsloaded'][$t])) continue;
    $GLOBALS['googlefontsloaded'][$t] = true;
    ?>
    @import url('<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http' ).'://fonts.googleapis.com/css?family='.$t; ?>');
    <?php
  }
}
?>

body{
  overflow-y:scroll;
  overflow-x:hidden;
}

#glassy_menu_module .menu{
  float: left;
  position: <?php if($params->get("fixed",1)==1) {print 'fixed';}else {print 'absolute';}?>;
  top:<?php print $params->get("menutop",50); ?>px;
/*  left:-15px;*/
  <?php if($params->get("position",1)==1) {print 'left';}else {print 'right';}?>:0px;
  cursor: default;
}




<?php
  $theme = $params->get("theme", "default");
  $size = $params->get("size","small");
  if($theme == "default"){
    print("
      #glassy_menu_module .menu_left{
        float: left;
        /*background: url('../../Pics/green-left.png') no-repeat;
        width: 15px;
        height: 49px;*/
      }
      
      #glassy_menu_module .menu_mid{
        height: 130px;
        /*padding-top: 13px;
        padding-right: 15px;
        padding-left: 15px;
        color: #FFF;
        font-size: 18px;
        text-shadow : 0px 1px 2px #333;*/
        /*background: url('../../Pics/green-mid.png') repeat-x;*/
        float: left;
        text-decoration: none;
        width: 31px;
      }
      
      #glassy_menu_module .menu_right{
        float: left;
        /*background: url('../../Pics/green-right.png') no-repeat;
        width: 15px;*/
        /*height: 49px;  */
      }
    ");
  }else if($theme == "carbonite"){
    if($size=="tiny"){ 
      $imgsize = getimagesize(dirname(__FILE__).DS."..".DS."Pics".DS."tiny_2.png");
      $wMid = $imgsize[0];
      $hMid = $imgsize[1];
      $imgsize = getimagesize(dirname(__FILE__).DS."..".DS."Pics".DS."tiny_3.png");
      $wRight = $imgsize[0];
      $hRight = $imgsize[1];
      $p1Left  = 15;
      $p2Left = $wMid+$p1Left;
      $lineheight = $hRight-4;
    }else if($size=="small"){ 
      $imgsize = getimagesize(dirname(__FILE__).DS."..".DS."Pics".DS."small_2.png");
      $wMid = $imgsize[0];
      $hMid = $imgsize[1];
      $imgsize = getimagesize(dirname(__FILE__).DS."..".DS."Pics".DS."small_3.png");
      $wRight = $imgsize[0];
      $hRight = $imgsize[1];
      $p1Left  = "15";
      $p2Left = $wMid+$p1Left;
      $lineheight = $hRight-6;
    }else if($size=="big"){ 
      $imgsize = getimagesize(dirname(__FILE__).DS."..".DS."Pics".DS."big_2.png");
      $wMid = $imgsize[0];
      $hMid = $imgsize[1];
      $imgsize = getimagesize(dirname(__FILE__).DS."..".DS."Pics".DS."big_3.png");
      $wRight = $imgsize[0];
      $hRight = $imgsize[1];
      $p1Left  = "15";
      $p2Left = $wMid+$p1Left;
      $lineheight = $hRight-10;
    }
  
    print("
      #glassy_menu_module .menu_mid{
        float: left; 
        width: ".$wMid."px;
        height: ".$hMid."px;
        background: ".($params->get("position",1)==1  ?  "url('../../Pics/".$size."_2.png') no-repeat"  :  "url('../../Pics/".$size."_right2.png') no-repeat").";
      }
      
      #glassy_menu_module .menu_right{
        float:left;
        height: ".$hRight."px;
        width: ".$wRight."px;
        background: ".($params->get("position",1)==1  ?  "url('../../Pics/".$size."_3.png') no-repeat"  :  "url('../../Pics/".$size."_right3.png') no-repeat").";
      }
      
      #glassy_menu_module .menu_left{
        float: left;
        height: ".$hMid."px;
        color: #FFF;
        font-size: 18px;
        text-shadow : 0px 1px 2px #333;
        float: left;
        text-decoration: none;
        line-height: ".$lineheight."px;
        background: ".($params->get("position",1)==1  ?  "url('../../Pics/".$size."_1.png') repeat-x"  :  "url('../../Pics/".$size."_right1.png') repeat-;").";
        padding-right: ".($params->get("position",1)==1?$p1Left:$p2Left)."px;
        padding-left: ".($params->get("position",1)==1?$p2Left:$p1Left)."px;
      }
    ");   
  }

?>