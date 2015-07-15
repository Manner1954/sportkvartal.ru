<?php 

defined('_JEXEC') or die;

JHTML::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_mannerfolio&layout=edit&id='.(int)$this->item->id); ?>" method="post" name="adminForm" id="mannerfolio-form">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>
				<?php echo JText::_('COM_MANNERFOLIO_MANNERFOLIO_DETAILS'); ?>
			</legend>
			<ul class="adminformlist">
				<!--<?php //foreach ($this->form->getFieldset() as $field) : ?> -->
					<li>
						<?php echo $this->form->getLabel('id'); ?> 
						<?php echo $this->form->getInput('id'); ?>
					</li>
					<li>
						<?php echo $this->form->getLabel('name'); ?> 
						<?php echo $this->form->getInput('name'); ?>
					</li>
					<li>
						<?php echo $this->form->getLabel('alias'); ?> 
						<?php echo $this->form->getInput('alias'); ?>
					</li>
					<li>
						<?php echo $this->form->getLabel('professio'); ?> 
						<?php echo $this->form->getInput('professio'); ?>
					</li>
					<li>
						<?php echo $this->form->getLabel('typecard'); ?> 
						<?php echo $this->form->getInput('typecard'); ?>
					</li>					<li>
						<?php echo $this->form->getLabel('catid'); ?> 
						<?php echo $this->form->getInput('catid'); ?>
					</li>
					<li>
						<?php echo $this->form->getLabel('intodesc'); ?> 
						<?php echo $this->form->getInput('intodesc'); ?>
					</li>
					<li>
						<div class="clr"></div>
						<?php echo $this->form->getLabel('fulldesc'); ?> 
						<div class="clr"></div>
						<?php echo $this->form->getInput('fulldesc'); ?>
					</li>
					<li>
						<?php echo $this->form->getLabel('image'); ?> 
						<?php echo $this->form->getInput('image'); ?>
					</li>
					<li>
						<?php echo $this->form->getLabel('state'); ?> 
						<?php echo $this->form->getInput('state'); ?>
					</li>
				<!-- <?php //endforeach; ?> -->
			</ul>
		</fieldset>
	</div>
	<div style="clear: both;"></div>
	<!-- ACL -->
	<?php if($this->canDo->get('core.admin')) : ?>
		<div>
			<?php echo JHTML::_('sliders.start', 'permission-sliders-' . $this->item->id, array('useCookie' => 1)); ?>
				<?php echo JHTML::_('sliders.panel', JText::_('COM_MANNERFOLIO_FIELDSET_RULES'), 'access-rules'); ?>
				<fieldset>
					<?php echo $this->form->getLabel('rules'); ?>
					<?php echo $this->form->getInput('rules'); ?>
				</fieldset>
			<?php echo JHtml::_('sliders.end'); ?>
		</div>
	<?php endif; ?>
	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>