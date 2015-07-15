
/*
Level specific iteration
*/
<?php


$pos = $params->get("position",1);
$size = $params->get("size","small");

/*if($size=="tiny"){
  $baseImgLeft = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."1.png";
  $baseImgMid = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."2.png";
  $baseImgRight = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."3.png";
}else if($size=="small"){
  $baseImgLeft = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."1.png";
  $baseImgMid = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."2.png";
  $baseImgRight = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."3.png";

}else if($size=="big"){
  $baseImgLeft = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."1.png";
  $baseImgMid = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."2.png";
  $baseImgRight = dirname(__FILE__).DS."..".DS."..".DS."Pics".DS.$size."_".($pos==1?"":"right")."3.png";
}

$baseColor = "445135";*/

for($i=1;$i<$definedLevel;$i++){

?>

#glassy_menu_module #menu<?php echo $i ?> .menu_left {
  /*background: url('<?php print($this->cacheUrl.$helper->NewColorizeImage($baseImgLeft, $menuitems[$i-1]["color"], $baseColor)); ?>') repeat-x; */
  <?php $t = 'level'.$i.'textfont'; $f = $$t; ?>
  color: #<?php echo $f[6]?>;
  font-family: <?php echo ($f[2] ? '"'.$f[2].'"':'').($f[2] && $f[1] ? ',':'').$f[1];?>;
  font-weight: <?php echo $f[4]? 'bold' : 'normal';?>;
  font-style: <?php echo $f[5]? 'italic' : 'normal';?>;
  font-size: <?php echo $f[3]?>;
  <?php if($f[7]): ?>
  text-shadow: #<?php echo $f[11]?> <?php echo $f[8]?> <?php echo $f[9]?> <?php echo $f[10]?>;
  <?php else: ?>
  text-shadow: none;
  <?php endif; ?>
  text-decoration: <?php echo $f[12]?>;
  text-transform: <?php echo $f[13]?>;
  /*line-height: <?php echo $f[14]?>;*/
  text-align: <?php echo $f[15]?>;
  /*font chooser*/
}

#glassy_menu_module #menu<?php echo $i ?> .menu_mid{
   /*background: url('<?php print($this->cacheUrl.$helper->NewColorizeImage($baseImgMid, $menuitems[$i-1]["color"], $baseColor)); ?>') no-repeat; */
}


<?php
}
?>