<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
      if($this->_config->get('jg_showsubcatcount')): ?>
  <div class="jg_catcountsubcats">
<?php   if($this->totalcategories == 1): ?>
    <?php echo JText::_('COM_JOOMGALLERY_THERE_IS_ONE_SUBCATEGORY_IN_CATEGORY'); ?>
<?php   endif;
        if($this->totalcategories > 1): ?>
    <?php echo JText::sprintf('COM_JOOMGALLERY_CATEGORY_THERE_ARE_SUBCATEGORIES_IN_CATEGORY', $this->totalcategories); ?>
<?php   endif; ?>
  </div>
<?php endif; ?>
  <div class="pagination">
    <?php echo $this->catpagination->getPagesLinks(); ?>
  </div>