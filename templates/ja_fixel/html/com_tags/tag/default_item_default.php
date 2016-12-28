<?php
/**
* @package     Joomla.Site
* @subpackage  com_content
*
* @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;
?>
<?php if ($this->core_item->core_state == 0) : ?>
	<div class="system-unpublished">
<?php else: ?>
	<div class="article_content">
		<header class="article-header clearfix">
			<h2 class="article-title">
				<a class="article-link" href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($this->core_item->content_item_id, $this->core_item->core_alias, $this->core_item->core_catid, $this->core_item->core_language, $this->core_item->type_alias, $this->core_item->router)); ?>">
						<?php echo $this->escape($this->core_item->core_title); ?>
				</a>
			</h2>
		</header>
		
		<?php $images  = json_decode($this->core_item->core_images);?>
		<?php if ($this->params->get('tag_list_show_tag_image', 1) == 1 && !empty($images->image_intro)) :?>
		<div class="item-image">
			<img src="<?php echo htmlspecialchars($images->image_intro);?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>">
    </div>
		<?php endif; ?>
		
		
		<?php if ($this->params->get('tag_list_show_tag_description', 1)) : ?>
			<section class="article-intro clearfix">
				<?php echo JHtml::_('string.truncate', $this->core_item->core_body, $this->params->get('tag_list_item_maximum_characters')); ?>
			</section>
		<?php endif; ?>
	</div>
<?php endif; ?>