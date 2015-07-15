<?php
defined("_JEXEC") or die;

//Данные по сортировке
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));

?>

<tr>
	<th width="1%">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)">
	</th>
	<th class="nowrap">
		<?php echo JHTML::_('grid.sort', 'JGLOBAL_TITLE', 'a.name', $listDirn, $listOrder); ?>
	</th>
	<th width="5%">
		<?php echo JHTML::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
	</th>
	<th class="nowrap">
		<?php echo JText::_('JCATEGORY'); ?>
	</th>
	<th class="nowrap">
		<?php echo JHTML::_('grid.sort', 'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
		<?php 
			if ($listOrder == 'a.ordering')
			{
				echo JHTML::_('grid.order', $this->items, 'filesave.png', 'mannerfolios.saveorder');
			}
		 ?>
	</th>
	<th width="1%" >
		<?php echo JHTML::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
	</th>
</tr>
