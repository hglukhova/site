<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JLoader::register('JHtmlUsers', JPATH_COMPONENT . '/helpers/html/users.php');
JHtml::register('users.spacer', array('JHtmlUsers', 'spacer'));
JHtml::register('users.helpsite', array('JHtmlUsers', 'helpsite'));
JHtml::register('users.templatestyle', array('JHtmlUsers', 'templatestyle'));
JHtml::register('users.admin_language', array('JHtmlUsers', 'admin_language'));
JHtml::register('users.language', array('JHtmlUsers', 'language'));
JHtml::register('users.editor', array('JHtmlUsers', 'editor'));

?>
<?php $fields = $this->form->getFieldset('params'); ?>
<?php if (count($fields)): ?>
	<fieldset>
		<legend><?php echo JText::_('COM_USERS_SETTINGS_FIELDSET_LABEL'); ?></legend>
		<?php foreach ($fields as $field): ?>
			<?php if (!$field->hidden): ?>
			<div>
				<?php echo $field->title; ?>
				<?php if (JHtml::isRegistered('users.'.$field->id)):?>
					<?php echo JHtml::_('users.'.$field->id, $field->value);?>
				<?php elseif (JHtml::isRegistered('users.'.$field->fieldname)):?>
					<?php echo JHtml::_('users.'.$field->fieldname, $field->value);?>
				<?php elseif (JHtml::isRegistered('users.'.$field->type)):?>
					<?php echo JHtml::_('users.'.$field->type, $field->value);?>
				<?php else:?>
					<?php echo JHtml::_('users.value', $field->value);?>
				<?php endif;?>
			</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</fieldset>
<?php endif; ?>