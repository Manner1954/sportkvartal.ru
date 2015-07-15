<?php

// no direct access
defined('_JEXEC') or die;
?>
<div class="mannerbox <?php if($count) { echo "addleft"; }  else {echo "notleft"; } ?>">
	<div class="mannerbox-list">
	  <img src=<?php echo $urlimg ?> data-img=<?php echo $urlimg ?> alt="" class="mannerbox-img"> 
	  <div style="display: none" class="mannerbox-margin fulldesc"><?php echo $spoilertext ?></div>
	</div>
</div>