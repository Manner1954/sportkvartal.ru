<?php 

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="width-20">
    <form id="adminForm" name="adminForm" method="post" action="<?php echo JRoute::_('index.php?option=com_schedule&view=days'); ?>">
        <table id="schedule-days" class="adminlist">
            <thead>
                <tr>
                    <th width="1%">
                        <input type="checkbox" onclick="checkAll(this)" value="" name="checkall-toggle" />
                    </th>
                    <th><?php echo JText::_('Day'); ?></th>   
                    <th width="5%">
    					<?php echo JText::_('JSTATUS'); ?>
    				</th>         
                    <th width="1%" class="nowrap">
    					<?php echo JText::_('JGRID_HEADING_ID'); ?>
    				</th>
                </tr>    
            </thead>
            
            <tbody>
                <?php foreach($this->items as $i=>$item): ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td class="center">
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                    </td>
                    <td>
                        <a href="<?php echo JRoute::_('index.php?option=com_schedule&task=day.edit&id='. $item->id); ?>">
                        <?php echo $this->escape($item->title); ?></a>
                    </td>
                    <td class="center"><?php echo JHtml::_('jgrid.published', $item->published, $i, 'days.'); ?></td>
                    <td><?php echo $item->id; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div>
    		<input type="hidden" name="task" value="" />
    		<input type="hidden" name="boxchecked" value="0" />		
    		<?php echo JHtml::_('form.token'); ?>
    	</div>
    </form>
</div>    