<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


// Create shortcuts to some parameters.
$params		= $this->item->params;
$images 	= json_decode($this->item->images);
$urls 		= json_decode($this->item->urls);
$canEdit	= $this->item->params->get('access-edit') && !JFactory::getApplication()->input->get('tmpl', '') == 'component';
$user		= JFactory::getUser();
$aInfo 		= (($params->get('show_author') && !empty($this->item->author )) ||
				($params->get('show_category')) ||
				($params->get('show_create_date')) ||
				($params->get('show_parent_category')) ||
				($params->get('show_publish_date')));
$exAction	= ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon'));
?>
<article>
<?php if ($params->get('show_title')) : ?>
<header class="article-header clearfix">
	<h1 class="article-title">
		<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
			<a href="<?php echo $this->item->readmore_link; ?>"> <?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h1>
</header>
<?php endif; ?>

<?php if($aInfo) :?>
<!-- Aside -->
<aside class="article-aside clearfix">

	<?php if ($aInfo) : ?>
	<dl class="article-info pull-left">
		<dt class="article-info-term"><?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
		
		<?php if ($params->get('show_publish_date')) : ?>
		<dd class="published"> 
			<?php echo JText::sprintf('FIXEL_COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?> 
		</dd>
		<?php endif; ?>

		<?php if ($params->get('show_create_date')) : ?>
		<dd class="create"> 
			<?php echo JText::sprintf('FIXEL_COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?> 
		</dd>
		<?php endif; ?>

		<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
		<dd class="createdby">
			<?php 
				$author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; 
			?>
			<?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
			<?php
				$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
				$menu = JFactory::getApplication()->getMenu();
				$item = $menu->getItems('link', $needle, true);
				$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
			?>
			<?php echo JText::sprintf('FIXEL_COM_CONTENT_WRITTEN_BY', '<span>'.JHtml::_('link', JRoute::_($cntlink), $author).'</span>'); ?>
			<?php else: ?>
				<?php echo JText::sprintf('FIXEL_COM_CONTENT_WRITTEN_BY', '<span>'.$author.'</span>'); ?>
			<?php endif; ?>
		</dd>
		<?php endif; ?>
		
		<?php if ($params->get('show_category')) : ?>
			<dd class="category-name">
				<?php $title = $this->escape($this->item->category_title);
				$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
				<?php if ($params->get('link_category') and $this->item->catslug) : ?>
					<?php echo '<span class="name">',JText::sprintf('FIXEL_COM_CONTENT_CATEGORY','</span>'.$url); ?>
				<?php else : ?>
				<?php echo '<span class="name">',JText::sprintf('FIXEL_COM_CONTENT_CATEGORY','</span>'.$title); ?>
				<?php endif; ?>
			</dd>
		<?php endif; ?>

		<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
		<dd class="parent-category-name">
			<?php	
				$title = $this->escape($this->item->parent_title);
				$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';
			?>
			<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
				<?php echo JText::sprintf('FIXEL_COM_CONTENT_PARENT', $url); ?>
			<?php else : ?>
				<?php echo JText::sprintf('FIXEL_COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</dd>
		<?php endif; ?>
		<?php if($this->item->event->afterDisplayTitle && stripos($this->item->event->afterDisplayTitle, 'count') !== false): ?>
			<dd>
				<?php echo $this->item->event->afterDisplayTitle; ?>
			</dd>
		<?php endif; ?>
						
	</dl>
	<?php endif; ?>

</aside>
<!-- //Aside -->
<?php endif; ?>

<?php if ($params->get('access-view')):?>
		
	<section class="article-content clearfix">
		<?php echo $this->item->text; ?>
		
		<?php $useDefList = (($params->get('show_modify_date')) or ($params->get('show_hits'))); ?>
		<?php if ($useDefList) : ?>
		<footer class="article-footer clearfix">
			<dl class="article-info pull-left">
				<?php if ($params->get('show_modify_date')) : ?>
				<dd class="modified">
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', '<span>'.JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3')).'</span>'); ?> 
				</dd>
				<?php endif; ?>
				<?php if ($params->get('show_hits')) : ?>
				<dd class="hits">
					<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', '<span>'.$this->item->hits.'</span>'); ?>
				</dd>
				<?php endif; ?>
			</dl>
		</footer>
		<?php endif; ?>
		
	</section>

<?php endif; ?>
<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<div class="view-tags"><i class="icon-tag"></i>
		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		</div>
	<?php endif; ?>
</article>
	<div class="list-icons">
	<?php echo $this->item->event->beforeDisplayContent; ?>
	<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
		<div class="menu-edit"> 
			<ul class="clearfix">
				<?php if (!$this->print) : ?>
					<?php if ($params->get('show_print_icon')) : ?>
					<li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?> </li>
					<?php endif; ?>
					
					<?php if ($params->get('show_email_icon')) : ?>
					<li class="email-icon"> <?php echo JHtml::_('icon.email', $this->item, $params); ?> </li>
					<?php endif; ?>
					
					<?php if ($canEdit) : ?>
					<li class="edit-icon"> <?php echo JHtml::_('icon.edit', $this->item, $params); ?> </li>
					<?php endif; ?>
				<?php else : ?>
					<li class="print-icon"> <?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?> </li>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>