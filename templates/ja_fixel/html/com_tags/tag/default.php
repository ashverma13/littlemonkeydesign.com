<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
// Note that there are certain parts of this layout used only when there is exactly one tag.

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
JLoader::register('FixelHelper', T3_TEMPLATE_PATH . '/templateHelper.php');

$tplparams = JFactory::getApplication()->getTemplate(true)->params;
?>
<div class="fixel-grid-wrapper">
	
	<?php if($this->params->get('show_tag_title', 1)) : ?>
	<h2>
		<?php echo JHtml::_('content.prepare', $this->document->title, '', 'com_tag.tag'); ?>
	</h2>
	<?php endif; ?>

	<?php // We only show a tag description if there is a single tag. ?>
	<?php  if (count($this->item) == 1 && (($this->params->get('tag_list_show_tag_image', 1)) || $this->params->get('tag_list_show_tag_description', 1))) : ?>
	<div class="category-desc">
		<?php $images = json_decode($this->item[0]->images); ?>
		<?php if ($this->params->get('tag_list_show_tag_image', 1) == 1 && !empty($images->image_fulltext)) : ?>
			<img src="<?php echo htmlspecialchars($images->image_fulltext);?>">
		<?php endif; ?>
		<?php if ($this->params->get('tag_list_show_tag_description') == 1 && $this->item[0]->description) : ?>
			<?php echo JHtml::_('content.prepare', $this->item[0]->description, '', 'com_tags.tag'); ?>
		<?php endif; ?>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php // If there are multiple tags and a description or image has been supplied use that. ?>
	<?php if ($this->params->get('tag_list_show_tag_description', 1) || $this->params->get('show_description_image', 1)): ?>
		<?php if ($this->params->get('show_description_image', 1) == 1 && $this->params->get('tag_list_image')) :?>
			<img src="<?php echo $this->params->get('tag_list_image');?>">
		<?php endif; ?>
		<?php if ($this->params->get('tag_list_description', '') > '') :?>
			<?php echo JHtml::_('content.prepare', $this->params->get('tag_list_description'), '', 'com_tags.tag'); ?>
		<?php endif; ?>
	<?php endif; ?>

	<!-- Tag filter -->
	<?php if($tplparams->get('tpl_show_tagfilter', 1) && count($this->item) > 1) : ?>
		<div id="fixel-tag-filter" class="tag-filter">
			<ul class="tag-list">
				<li><a href="#all" data-tag=""><?php echo JText::_('TPL_TAG_ALL'); ?></a></li>
		<?php foreach ($this->item as $tagItem) : ?>
				<li><?php $route = new TagsHelperRoute; ?>
					<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tagItem->id . ':' . $tagItem->alias)); ?>" data-tag="<?php echo $tagItem->alias ?>">
						<?php echo htmlspecialchars($tagItem->title); ?></a>
				</li>
		<?php endforeach ?>
			</ul>
		</div>
	<?php endif ?>
	<!-- //Tag filter -->
	
	<div id="fixel-grid" class="fixel-grid tag-category<?php echo $this->pageclass_sfx; ?> clearfix">

		<?php if ($this->params->get('show_page_heading') != 0) : ?>
		<div class="items grid-2x2 no-repeat pageheading">
			<article>
				<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
				<?php if($this->params->get('jpage_desc')) : ?>
				<div><?php echo $this->escape($this->params->get('jpage_desc')); ?></div>
				<?php endif ?>
			</article>
		</div>
		<?php endif; ?>

		<?php echo $this->loadTemplate('items'); ?>

		<?php if ($tplparams->get('tpl_navigation_infinity', 1)) : ?>
		<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
			<nav id="page-nav" class="pagination">
				<?php
					$urlparams = '';
					if (!empty($this->pagination->_additionalUrlParams)){
						foreach ($this->pagination->_additionalUrlParams as $key => $value) {
							$urlparams .= '&' . $key . '=' . $value;
						}
					}

					$next = $this->pagination->limitstart + $this->pagination->limit;
					$nextlink = JRoute::_($urlparams . '&' . $this->pagination->prefix . 'limitstart=' . $next);
				?>
				<a id="page-next-link" href="<?php echo $nextlink ?>" data-limit="<?php echo $this->pagination->limit; ?>" data-start="<?php echo $this->pagination->limitstart ?>"></a>
			</nav>
			<?php endif; ?>
		<?php endif; ?>
		
	</div>

	<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>

		<?php if ($tplparams->get('tpl_navigation_infinity', 1)) : ?>
			<div id="infinity-next" class="btn btn-block hidden"><?php echo JText::_('TPL_INFINITY_NEXT')?></div>
		<?php else : ?>
			<div class="pagination">

				<?php if ($this->params->def('show_pagination_results', 1)) : ?>
					<p class="counter pull-right">
						<?php echo $this->pagination->getPagesCounter(); ?>
					</p>
				<?php  endif; ?>
						<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
		
	<?php endif; ?>

	<div id="fixel-placeholder" class="fixel-placeholder">
		<div class="ajax-indicator"><?php echo JText::_('TPL_POPUP_LOADING') ?></div>
	</div>
</div>
