<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>

<form action="<?php echo JRoute::_('index.php?option=com_schedule&layout=edit&id='.(int) $this->item->id ); ?>" method="post" name="adminForm" id="event-form">
    <div class="width-50 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_SCHEDULE_EVENT_DETAILS'); ?></legend> 
            
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('id'); ?>
                    <?php echo $this->form->getInput('id'); ?></li>
                
                <li><?php echo $this->form->getLabel('name'); ?>
                    <?php echo $this->form->getInput('name'); ?></li>

                <li><?php echo $this->form->getLabel('title'); ?>
                    <?php echo $this->form->getInput('title'); ?></li>

                <li><?php echo $this->form->getLabel('article_id'); ?>
                    <?php echo $this->form->getInput('article_id'); ?></li>

                <li><?php echo $this->form->getLabel('group_id'); ?>
                    <?php echo $this->form->getInput('group_id'); ?></li>

                <li><?php echo $this->form->getLabel('record'); ?>
                    <?php echo $this->form->getInput('record'); ?></li>

                <li><?php echo $this->form->getLabel('ordering'); ?>
                    <?php echo $this->form->getInput('ordering'); ?></li>
            </ul>            
        </fieldset>
    </div>
    
    <?php if($this->item->id != 0): ?>    
    <!--<div class="width-50 fltrt">   
       <fieldset class="adminform">
        <legend><?php echo JText::_('COM_SHEDULE_EVENT_SUBFIELDS'); ?></legend>        
         <a href="#dialog" name="modal">Изменить тренера</a>
        </fieldset>
    </div>-->
        <div id="boxes" class="width-50 fltrt">
        <div id="dialog" class="window">
          <fieldset class="adminform">
              <legend><?php echo JText::_('COM_SHEDULE_EVENT_SUBFIELDS'); ?></legend> 
              <ul class="adminformlist shedule_popup">
                  <?php foreach($this->subfields->getNames() as $n): ?>
                  <li>
                      <?php echo $this->form->getLabel($n); ?>
                      <?php echo $this->form->getInput($n); ?>
                  </li>
                  <?php endforeach; ?>
              </ul> 
               <!--<div width="375px" style="position: relative; text-align: center;"> <button type="button" onclick="Joomla.submitform('event.apply');"> <?php echo JText::_('JAPPLY');?></button> </div>-->
         </fieldset>
        </div>
        <div id="mask"></div>
      </div>
  <?php endif; ?>
    
    <div class="clr">
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
