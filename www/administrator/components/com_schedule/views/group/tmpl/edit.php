<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>


<form action="<?php echo JRoute::_('index.php?option=com_schedule&layout=edit&id='.(int) $this->item->id ); ?>" method="post" name="adminForm" id="group-form">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_SCHEDULE_GROUP_DETAILS'); ?></legend> 
            
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('id'); ?>
                <?php echo $this->form->getInput('id'); ?></li> 
                               
                <li><?php echo $this->form->getLabel('title'); ?>
                <?php echo $this->form->getInput('title'); ?></li>
                               
                <li><?php echo $this->form->getLabel('published'); ?>
                <?php echo $this->form->getInput('published'); ?></li>
                
                
                <li><?php echo $this->form->getLabel('ordering'); ?>
                <?php echo $this->form->getInput('ordering'); ?></li>                
            </ul>            
        </fieldset>
    </div>
    
    <div class="width-40 fltrt">
    
    </div>
    
    <div class="clr">
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
