<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
      if($this->_config->get('jg_showcatcount')): ?>
  <div class="jg_galcountcats">
<?php   if($this->total == 1): ?>
    <?php echo JText::_('COM_JOOMGALLERY_GALLERY_THERE_IS_ONE_CATEGORY_IN_GALLERY'); ?>
<?php   endif;
        if($this->total > 1): ?>
    <?php echo JText::sprintf('COM_JOOMGALLERY_GALLERY_THERE_ARE_CATEGORIES_IN_GALLERY', $this->total); ?>
<?php   endif; ?>
  </div>
<?php endif; ?>
  <div class="pagination">
    <?php echo $this->pagination->getPagesLinks(); ?>
  </div>
