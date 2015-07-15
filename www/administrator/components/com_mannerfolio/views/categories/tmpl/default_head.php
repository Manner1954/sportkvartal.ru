<?php
defined("_JEXEC") or die;
?>

<tr>
	<th width="1%">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)">
	</th>
	<th class="nowrap">
		<?php echo JText::_('JGLOBAL_TITLE'); ?>
	</th>
	<th width="1%" >
		<?php echo JText::_('JGRID_HEADING_ID'); ?>
	</th>
</tr>
