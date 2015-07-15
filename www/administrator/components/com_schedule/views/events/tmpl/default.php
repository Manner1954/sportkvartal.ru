<?php 

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="">
    <form id="adminForm" name="adminForm" method="post" action="<?php echo JRoute::_('index.php?option=com_schedule&view=events'); ?>">
        <table id="schedule-events" class="adminlist">
            <thead>
                <tr>
                    <th width="1%">
                        <input type="checkbox" onclick="checkAll(this)" value="" name="checkall-toggle" />
                    </th>
                    <th><?php echo JText::_('EVENT'); ?></th>   
                    <!--th width="5%">
    					<?php echo JText::_('JGRID_HEADING_ORDERING'); ?>
    				</th-->
                    <th class="nowrap">
    					<?php echo JText::_('TRAINER'); ?>
    				</th>
                    <th class="nowrap">
                        <?php echo JText::_('GROUP'); ?>
                    </th>
                    <th class="nowrap">
                        <?php echo JText::_('COM_SCHEDULE_FIELD_EVENT_RECORD'); ?>
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
                        <a href="<?php echo JRoute::_('index.php?option=com_schedule&task=event.edit&id='. $item->id); ?>">
                        <?php echo $this->escape($item->title); ?></a>
                        <p class="smallsub">(<span><?php echo JText::_('Alias'); ?></span>: <?php echo $item->name; ?>)</p>
                    </td>
                    <!--td class="center"><?php /*echo JHtml::_('jgrid.published', $item->published, $i, 'days.');*/ ?></td-->
                    <td>
                      <?php if (property_exists($item, 'subfields')): ?>
                           <?php echo $item->subfields->trainer; ?>
                      <?php endif;?>
                    </td>
                    <td>
                        <?php echo $item->group_id; ?>   
                    </td>
                    <td>
                        <?php echo ($item->record) ? JText::_('JYES') : JText::_('JNO'); ?>   
                    </td>
                    <td><?php echo $item->id; ?></td>
                </tr>
                <?php endforeach; ?>
                
                <?php if (!count($this->items)): ?>
                <tr>
                    <td colspan="4">Нет событий</td>
                </tr>
                <?php endif; ?>
            </tbody>
      		<tfoot>
      			<tr>
      				<td colspan="7" class="nowrap">
      					<?php echo $this->pagination->getListFooter(); ?>
      				</td>
      			</tr>
      		</tfoot>

        </table>
        <div>
    		<input type="hidden" name="task" value="" />
    		<input type="hidden" name="boxchecked" value="0" />		
    		<?php echo JHtml::_('form.token'); ?>
    	</div>
    </form>
</div>  

  