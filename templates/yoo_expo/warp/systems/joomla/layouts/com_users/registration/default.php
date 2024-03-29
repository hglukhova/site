<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.mootools');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>

<div id="system" class="<?php $this->pageclass_sfx; ?>">
	
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="submission">
		<?php foreach ($this->form->getFieldsets() as $fieldset): ?>
			<?php $fields = $this->form->getFieldset($fieldset->name); ?>
			<?php if (count($fields)): ?>
				<fieldset>
					<?php if (isset($fieldset->label)): ?>
					<legend><?php echo JText::_($fieldset->label); ?></legend>
					<?php endif;?>
					<?php foreach ($fields as $field): ?>
						<?php if ($field->hidden): ?>
							<?php echo $field->input; ?>
						<?php else: ?>
							<div><?php echo $field->label.$field->input; ?>
								<?php if (!$field->required && $field->type != 'Spacer'): ?>
									<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL');?></span>
								<?php endif; ?>
							</div>
					<?php endif; ?>
					<?php endforeach; ?>
				</fieldset>
			<?php endif; ?>
		<?php endforeach; ?>

		<div class="submit">
			<button class="validate" type="submit"><?php echo JText::_('JREGISTER'); ?></button>
		</div>
		
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="registration.register" />
		<?php echo JHtml::_('form.token');?>
		
	</form>

</div>