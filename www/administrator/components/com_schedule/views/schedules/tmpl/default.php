<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//print_r($this->items);

if ($this->grid['cols'])
    $width = round(96 /count($this->grid['cols']));
?>

 

<ul class="schedules">
    <?php foreach($this->schedules as $s): ?>
    <li>
        <?php if ($s->id == $this->schedule_id): ?>
            <span class="open"><?php echo $s->title; ?></span>
        <?php else: ?>
            <a class="open" href="<?php echo JRoute::_('index.php?option=com_schedule&task=change&id='.$s->id); ?>" title="Открыть"><?php echo $s->title; ?></a>
        <?php endif; ?>
        (<a href="<?php echo JRoute::_('index.php?option=com_schedule&task=schedule.edit&id='. $s->id); ?>">изменить</a>)
    </li>
    <?php endforeach; ?>

    <li class="add">
        <a href="<?php echo JRoute::_('index.php?option=com_schedule&task=schedule.add'); ?>">Добавить</a>
    </li>
</ul>

<table id="schedule-table">
    <thead>
        <tr>
            <td></td>
            <?php foreach($this->grid['cols'] as $col): ?>
            <td width="<?php echo $width. '%'; ?>"><?php echo $col->title; ?></td>
            <?php endforeach; ?>
        </tr>    
    </thead>
    
    <tbody>
        <?php foreach($this->grid['rows'] as $row): ?>
        <tr>
            <td class="time"><?php echo $row->line_time; ?></td>
            <?php foreach($this->grid['cols'] as $col): ?>
            <td>
                <?php if (isset($this->items[$row->id][$col->id])): 
                    $items = $this->items[$row->id][$col->id];
                    foreach($items as $item) {
                      $link = JRoute::_('index.php?option=com_schedule&task=summary.edit&id='. $item->id);
                      $delete_link = JRoute::_('index.php?option=com_schedule&task=delete&id='.$item->id);
                ?>
                <a class="event-title" href="<?php echo $link; ?>"><?php echo $item->title; ?></a>
                <br>
                <a href="<?php echo $delete_link; ?>">удалить</a>
                <br><br>
                <?php // ARt else: ?>
                <?php } endif; ?>
                <a class="add-event" href="<?php echo JRoute::_('index.php?option=com_schedule&task=summary.add&row='. $row->id .'&col='. $col->id); ?>"></a>
            </td>            
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
     		<tfoot>
      			<tr>
      				<td colspan="7" class="nowrap">
      					<?php echo $this->pagination->getListFooter(); ?>
      				</td>
      			</tr>
      		</tfoot>
    </tbody>
</table>

<p class="info">Обратите внимание, что на сайте расписание отображается в зависимости от активных дней и строк времени</p>