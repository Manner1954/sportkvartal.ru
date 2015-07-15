<?php 

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="width-20">
    <form id="adminForm" name="adminForm" method="post" action="<?php echo JRoute::_('index.php?option=com_schedule&view=fields'); ?>">
        <table id="schedule-fields" class="adminlist">
            <thead>
                <tr>
                    <th width="1%">
                        <input type="checkbox" onclick="checkAll(this)" value="" name="checkall-toggle" /></th>
                    <th>
                        <?php echo JText::_('FIELD_LABEL'); ?></th>
                    <th width="1%" class="nowrap">
                        <?php echo JText::_('FIELD_TYPE'); ?></th>
                    <th width="1%">
                        <?php echo JText::_('COM_SCHEDULE_FIELD_SHOW_IN_TABLE_LABEL'); ?></th>
                    <th width="1%" class="nowrap">
    					<?php echo JText::_('JGRID_HEADING_ID'); ?></th>
                </tr>    
            </thead>
            
            <tbody>
                <?php foreach($this->items as $i=>$item): ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td class="center">
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                    </td>
                    <td>
                        <a href="<?php echo JRoute::_('index.php?option=com_schedule&task=field.edit&id='. $item->id); ?>">
                        <?php echo $this->escape($item->title); ?></a>    
                        <p class="smallsub">(<span><?php echo JText::_('Alias'); ?></span>: <?php echo $item->name; ?>)</p>                    
                    </td>
                    <td>
                        <?php echo $item->type; ?></td>
                    <td class="center">
                        <?php echo JHtml::_('jgrid.published', $item->published, $i, 'fields.', true); ?></td>
                    <td>
                        <?php echo $item->id; ?></td>
                </tr>
                <?php endforeach; ?>
                
                <?php if (!count($this->items)) { ?>
                <tr>
                    <td colspan="4"><?php echo JText::_('No fields'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <div>
    		<input type="hidden" name="task" value="" />
    		<input type="hidden" name="boxchecked" value="0" />		
    		<?php echo JHtml::_('form.token'); ?>
    	</div>
    </form>
</div>  

  