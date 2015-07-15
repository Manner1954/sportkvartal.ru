<?php

defined('_JEXEC') or die;

//Данные по сортировке
$listDirn = $this->escape($this->state->get('list.direction'));
$listOrder = $this->escape($this->state->get('list.ordering'));
$saveOrder = $listOrder == 'a.ordering';
foreach($this->items as $i=>$item) : 
	$canEdit = JFactory::getUser()->authorise('core.edit', 'com_mannerfolio.card.' . $item->id); 
	$canChange = JFactory::getUser()->authorise('core.edit.state', 'com_mannerfolio.card.' . $item->id) ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td class="center">
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td class="center">
			<?php 
			if($canEdit) : 
			?>
				<a href="<?php echo JRoute::_('index.php?option=com_mannerfolio&task=mannerfolio.edit&id='.(int)$item->id); ?>"><?php echo $this->escape($item->name); ?></a>
			<?php 
			else : 
				echo $this->escape($item->name);	
			endif; 
			?>
		</td>
		<td class="center">
			<?php echo JHtml::_('jgrid.published', $item->state, $i, 'mannerfolios.', $canChange); ?>
		</td>
		<td class="center">
			<a href="<?php echo JRoute::_('index.php?option=com_mannerfolio&task=category.edit&id='.(int)$item->catid); ?>"><?php echo $item->category_name; ?></a>
		</td>
		<td class="order">
			<?php
				if($saveOrder) :
					if($listDirn == 'asc') : ?>
						<span><?php echo $this->pagination->orderUpIcon($i, true, 'mannerfolios.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>	
						<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'mannerfolios.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
					<?php elseif($listDirn == 'desc') : ?>
						<span><?php echo $this->pagination->orderUpIcon($i, true, 'mannerfolios.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>	
						<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'mannerfolios.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
					<?php endif; ?>
				<?php endif; ?>						
			<?php $disabled = $saveOrder ? '' : 'disabled = "disabled"'; ?>
			<input type="text" name="order[]" size="5" value="<?php echo $item->ordering; ?>" <?php echo $disabled ?> />
		</td>
		<td>
			<?php echo $item->id; ?>
		</td>
	</tr>
<?php endforeach; ?>