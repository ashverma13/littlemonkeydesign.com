<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$renderer = JFactory::getDocument()->loadRenderer('module');
?>
<?php if (count($this->items[$this->parent->id]) > 0 && $this->maxLevelcat != 0) : ?>

	<?php foreach ($this->items[$this->parent->id] as $id => $item) : ?>

		<?php if(is_array($item) && isset($item['type']) && $item['type'] == 'module') : ?>
					
			<div class="items <?php echo $item['module']->parsedparams->get('moduleclass_sfx', '') ?>">
				<article>
				<?php echo $renderer->render($item['module'], array('style' => 'Fixel')) ?>
				</article>
			</div>

		<?php else: ?>
				
			<?php if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) : ?>
				
				<?php 
					$gridInfo = FixelHelper::getGrid($item); 
					$iclass = array('category-item', 'items', $gridInfo['animate'], $gridInfo['type'], 'grid-' . $gridInfo['size'], $gridInfo['color']);
				?>

				<div class="<?php echo implode(' ', array_unique($iclass)) ?>">
					<article>
					  	<div class="item-image-wrap">
							<?php $image = FixelHelper::extractImage($item->description); ?>
							<?php if ($image) : ?>
							<div class="category-image">
								<?php echo $image ?> 
							</div>
							<?php endif; ?>
							
							<div class="category-desc">
								<h3 class="page-header item-title">
									<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>">
										<?php echo $this->escape($item->title); ?>
									</a>
									
									<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
									<span class="badge badge-info tip hasTooltip" rel="tooltip" title="<?php echo JText::_('COM_CONTENT_NUM_ITEMS'); ?>">
										<?php echo $item->numitems; ?> 
									</span>
									<?php endif; ?>
									
									<?php if (count($item->getChildren()) > 0 && $this->maxLevelcat != 1) : ?>
									<a href="#category-<?php echo $item->id; ?>" class="fixel-cat-toggle btn btn-mini pull-right"><span class="icon-plus"></span></a>
									<?php endif;?>
								</h3>
								<?php if ($this->params->get('show_subcat_desc_cat') == 1) :?>
									<?php if ($item->description) : ?>
									<div class="category-intro">
										<?php echo JHtml::_('content.prepare', $item->description, '', 'com_content.categories'); ?>
									</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
					  	</div>
					</article>
				</div>

				<?php if (count($item->getChildren()) > 0 && $this->maxLevelcat != 1) : ?>
					<div id="category-<?php echo $item->id; ?>" class="fixel-sub-category">
					<?php
						$this->items[$item->id] = $item->getChildren();
						$this->parent = $item;
						$this->maxLevelcat--;
						echo $this->loadTemplate('items');
						$this->parent = $item->getParent();
						$this->maxLevelcat++;
					?>
					</div>
				<?php endif; ?>

			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
