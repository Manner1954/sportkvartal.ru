<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
      if($this->_config->get('jg_showpiccount')): ?>
  <div class="jg_catcountimg">
<?php   if($this->totalimages == 1): ?>
    <?php echo JText::_('COM_JOOMGALLERY_THERE_IS_ONE_PICTURE_IN_CATEGORY'); ?>
<?php   endif;
        if($this->totalimages > 1): ?>
    <?php echo JText::sprintf('COM_JOOMGALLERY_CATEGORY_THERE_ARE_IMAGES_IN_CATEGORY', $this->totalimages); ?>
<?php   endif; ?>
  </div>
<?php endif; ?>
  <div class="pagination">
    <?php echo $this->pagination->getPagesLinks(); ?>
  </div>