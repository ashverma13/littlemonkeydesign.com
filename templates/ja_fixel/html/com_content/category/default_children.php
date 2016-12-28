<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if(version_compare(JVERSION, '3.0', 'ge')){
	JHtml::_('bootstrap.tooltip');
}
JLoader::register('FixelHelper', T3_TEMPLATE_PATH . '/templateHelper.php');
$lang	= JFactory::getLanguage();
$class 	= ' class="items category-item first"';
?>
<div class="fixel-grid-wrapper">
<div id="fixel-grid" class="fixel-grid">
<?php if (count($this->children[$this->category->id]) > 0) : ?>
	<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
		<?php
		if ($this->params->get('show_empty_categories') || $child->getNumItems(true) || count($child->getChildren())) :
			if (!isset($this->children[$this->category->id][$id + 1])) :
				$class = ' class="items category-item last"';
			endif;
		?>
		<div<?php echo $class; ?>>
		  <article class="category-content">
			<div class="article_content">
			<?php $class = ' class="items category-item"'; ?>
			
			<h3 class="page-header item-title"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
				<?php echo $this->escape($child->title); ?></a>
				<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
				<span class="badge badge-info tip hasTooltip" rel="tooltip" title="<?php echo JText::_('COM_CONTENT_NUM_ITEMS'); ?>">
					<?php echo $child->getNumItems(true); ?>
				</span>
				<?php endif ; ?>
				
				<?php if (count($child->getChildren()) > 0) : ?>
				<a href="#category-<?php echo $child->id;?>" data-toggle="collapse" data-toggle="button" class="fixel-cat-toggle btn btn-mini pull-right"><span class="icon-plus"></span></a>
			<?php endif;?>
			</h3>
						
			<?php if ($this->params->get('show_subcat_desc') == 1) :?>
				<?php if ($child->description) : ?>
					<div class="category-desc">
						<?php echo JHtml::_('content.prepare', $child->description, '', 'com_content.category'); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if (count($child->getChildren()) > 0) :?>
			<div class="collapse fade" id="category-<?php echo $child->id;?>">
				<?php
				$this->children[$child->id] = $child->getChildren();
				$this->category = $child;
				$this->maxLevel--;
				if ($this->maxLevel != 0) :
					echo $this->loadTemplate('children');
				endif;
				$this->category = $child->getParent();
				$this->maxLevel++;
				?>
			</div>
			<?php endif; ?>
			</div>
          </article>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
</div>
</div>
