<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
JHtml::addIncludePath(T3_PATH.'/html/com_content');
JHtml::addIncludePath(dirname(dirname(__FILE__)));
JHtml::_('behavior.caption');

if(version_compare(JVERSION, '3.0', 'ge')){
	JHtml::_('bootstrap.tooltip');
}

JLoader::register('FixelHelper', T3_TEMPLATE_PATH . '/templateHelper.php');

//merge module for the first sub-level only
$tplparams    = JFactory::getApplication()->getTemplate(true)->params;
$items        = isset($this->items[$this->parent->id]) ? $this->items[$this->parent->id] : array();
$addpositions = $tplparams->get('tpl_additional_positions', array());
$addmodules   = array();

if(!empty($addpositions)){
	foreach ($addpositions as $addposition) {
		$addmodules = array_merge($addmodules, JModuleHelper::getModules($addposition));
	}

	if(!empty($addmodules)){

		foreach ($addmodules as $index => &$addmodule) {
			$params = new JRegistry($addmodule->params);
			$addmodule->parsedparams = $params;

			if(preg_match('/grid-pos-(\d+)/', $params->get('moduleclass_sfx', ''), $match)){
				array_splice($items, max(0, (int)$match[1] -1), 0, array(array('type' => 'module', 'module' => $addmodule)));
			} else {
				$items[] = array('type' => 'module', 'module' => $addmodule);
			}
		}
	}
}

//assigned back
$this->items[$this->parent->id] = $items;

?>
<div class="fixel-grid-wrapper">
	<div id="fixel-grid" class="fixel-grid categories-list<?php echo $this->pageclass_sfx;?>">
		
		<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="items grid-2x2 no-repeat pageheading">
			<article>
				<h2><?php echo $this->escape($this->params->get('page_heading')); ?></h2>
				<?php if($this->params->get('jpage_desc')) : ?>
				<div><?php echo $this->escape($this->params->get('jpage_desc')); ?></div>
				<?php endif ?>
			</article>
		</div>
		<?php endif; ?>

		<?php if ($this->params->get('show_base_description')) : ?>
			<?php 	//If there is a description in the menu parameters use that; ?>
			<?php if ($this->params->get('categories_description')) : ?>
				<?php echo  JHtml::_('content.prepare', $this->params->get('categories_description'), '', 'com_content.categories'); ?>
			<?php  else: ?>
				<?php //Otherwise get one from the database if it exists. ?>
				<?php  if ($this->parent->description) : ?>
					<div class="category-desc">
						<?php  echo JHtml::_('content.prepare', $this->parent->description, '', 'com_content.categories'); ?>
					</div>
				<?php  endif; ?>
			<?php  endif; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('items'); ?>
	</div>
</div>
