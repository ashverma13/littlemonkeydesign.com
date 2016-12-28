<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::addIncludePath(T3_PATH . '/html/com_content');
JHtml::addIncludePath(dirname(dirname(__FILE__)));
JHtml::_('behavior.caption');

//register the helper class
JLoader::register('FixelHelper', T3_TEMPLATE_PATH . '/templateHelper.php');

//template params
$tplparams = JFactory::getApplication()->getTemplate(true)->params;

//sort all items
$items = array();
if(!empty($this->lead_items)){
	foreach ($this->lead_items as &$item) {
		$item->fixel_gridsize = '2x2';
		$items[] = $item;
	}
}

if(!empty($this->intro_items)){
	foreach ($this->intro_items as &$item) {
		$item->fixel_gridsize = '1x1';
		$items[] = $item;
	}
}

$mergemodule  = ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1))
				? $this->pagination->get('pages.current') < 2 : true;

if($mergemodule){

	$renderer	  = JFactory::getDocument()->loadRenderer('module');
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
}
?>
<div class="fixel-grid-wrapper">
	
	<?php if (empty($items)) : ?>

		<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
			<div class="category-desc">
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
				<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
			<?php endif; ?>
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
				<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif; ?>
			<div class="clr"></div>
			</div>
		<?php endif; ?>

	<?php else: ?>

		<div id="fixel-grid" class="fixel-grid blog<?php echo $this->pageclass_sfx;?> clearfix">

			<?php if ($this->params->get('show_page_heading') != 0) : ?>
			<div class="items grid-2x2 no-repeat pageheading">
				<article>
					<h2><?php echo $this->escape($this->params->get('page_heading')); ?></h2>
					<?php if($this->params->get('jpage_desc')) : ?>
					<div><?php echo $this->escape($this->params->get('jpage_desc')); ?></div>
					<?php endif ?>
				</article>
			</div>
			<?php endif; ?>
		
			<?php foreach ($items as &$item) : ?>
				<?php $this->item = &$item; ?>

				<?php if(is_array($item) && isset($item['type']) && $item['type'] == 'module') : ?>
					
					<div class="items <?php echo $item['module']->parsedparams->get('moduleclass_sfx', '') ?>">
						<article>
						<?php echo $renderer->render($item['module'], array('style' => 'Fixel')) ?>
						</article>
					</div>

				<?php else: ?>
					<?php echo $this->loadTemplate('item'); ?>
				<?php endif ?>
			<?php endforeach; ?>

			<?php /* We should not care about this - we should set #Links = 0 ?>
			<?php if (!empty($this->link_items)) : ?>
				<section class="items-more">
					<h3><?php echo JText::_('COM_CONTENT_MORE_ARTICLES'); ?></h3>
					<?php echo $this->loadTemplate('links'); ?>
				</section>
				<hr class="divider-vertical" />
			<?php endif; ?>
			<?php */ ?>
			
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
		
	<?php endif; ?>
</div>
