<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>

<div id="system" class="<?php $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>
	
	<?php
		if ($this->params->get('show_base_description')) {
		
			//If there is a description in the menu parameters use that
			if($this->params->get('categories_description')) {
				echo  JHtml::_('content.prepare', $this->params->get('categories_description'), '', 'com_content.categories');
			} else {
				
				//Otherwise get one from the database if it exists
				if ($this->parent->description) {
					echo JHtml::_('content.prepare', $this->parent->description, '', 'com_content.categories');
				}
				
			}
		}
	?>
	
	<?php echo $this->loadTemplate('items'); ?>

</div>