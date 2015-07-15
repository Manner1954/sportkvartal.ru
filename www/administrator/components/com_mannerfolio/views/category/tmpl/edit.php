<?php 

defined('_JEXEC') or die;

JHTML::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_mannerfolio&layout=edit&id='.(int)$this->item->id); ?>" method="post" name="adminForm" id="category-form">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>
				<?php echo JText::_('COM_MANNERFOLIO_MANNERFOLIO_CATEGORY_DETAILS'); ?>
			</legend>
			<ul class="adminformlist">
				<?php foreach ($this->form->getFieldset() as $field) : ?> 
					<li>
						<?php echo $this->form->getLabel(print_r($field->label));  echo $this->form->getInput(print_r($field->input)); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</fieldset>
	</div>
	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>