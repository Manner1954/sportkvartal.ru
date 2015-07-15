<?php

defined('_JEXEC') or die;

foreach($this->items as $i=>$item) : ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td class="center">
			<?php echo JHTML::_('grid.id', $i, $item->id); ?>
		</td>
		<td class="center">
			<a href="<?php echo JRoute::_('index.php?option=com_mannerfolio&task=category.edit&id='.(int)$item->id); ?>"><?php echo $item->name; ?></a>
		</td>
		<td>
			<?php echo $item->id; ?>
		</td>
	</tr>
<?php endforeach; ?>