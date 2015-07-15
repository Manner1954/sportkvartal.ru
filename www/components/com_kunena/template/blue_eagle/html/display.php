<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 *
 * @copyright (C) 2008 - 2014 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>
<div id="Kunena" class="layout container-fluid">
	<header class="gkPage">
		<h2>
			<div class="headerBorderRadius">
				<?php echo JText::_('COM_KUNENA_FORUM') ?>
			</div>
		</h2>
	</header>
	<article class="item-page">
		<div class="gkPage">
			<?php
			if ($this->ktemplate->params->get('displayMenu', 1)) {
				$this->displayMenu ();
			}
			$this->displayLoginBox ();
			$this->displayBreadcrumb ();

			// Display current view/layout
			$this->displayLayout();

			$this->displayBreadcrumb ();
			$this->displayFooter ();
			?>
	</div>
	</article>
</div>
