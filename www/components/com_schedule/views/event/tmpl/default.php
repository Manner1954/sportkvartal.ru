<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<div id="gkMainBody">
	<header class="gkPage">
		<h2>
		 	<div class="headerBorderRadius">
		 		<?php echo $this->item->title; ?>
		 	</div>
		</h2>
	</header>	
	<article class="item-page">
		<div class="itemBody gkPage">
		<?php if ($this->item->article_id) {
		    echo $this->loadTemplate('article');
		} else {
		    echo $this->loadTemplate('fields');
		} ?>
		</div>
	</article>
	
</div>
