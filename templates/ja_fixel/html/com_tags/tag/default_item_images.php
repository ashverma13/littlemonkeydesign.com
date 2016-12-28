<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


$images = json_decode($this->core_item->core_images);
$link = false;

if (!empty($images->image_intro)) {
	$intro_src   = $images->image_intro;
	$intro_title = !empty($images->image_intro_caption) ? $images->image_intro_caption : $this->core_item->core_title;
	$intro_alt   = !empty($images->image_intro_alt) ? $images->image_intro_alt : $this->core_item->core_title;
} else {
	$iimage      = FixelHelper::image($this->core_item);
	$intro_src   = isset($iimage['src']) ? $iimage['src'] : '';
	$intro_title = $intro_alt = $this->core_item->core_title;
}

if ($this->params->get('tag_list_show_item_image', 1) != 1) {
	$intro_src = false;
}

if ($this->core_item->core_state != 0) {
	$link = JRoute::_(TagsHelperRoute::getItemRoute($this->core_item->content_item_id, $this->core_item->core_alias, $this->core_item->core_catid, $this->core_item->core_language, $this->core_item->type_alias, $this->core_item->router));
}
?>
<div class="item-image-wrap flipper">
	<?php if (!empty($intro_src)): ?>
	<div class="item-image front">
		<?php if ($link): ?>
		<a class="article-link" href="<?php echo $link; ?>" title="<?php echo $this->escape($this->core_item->core_title); ?>">
		<?php endif; ?>
			<img title="<?php echo htmlspecialchars($intro_title); ?>" src="<?php echo htmlspecialchars($intro_src); ?>" alt="<?php echo htmlspecialchars($intro_alt); ?>" />
		<?php if ($link): ?>
		</a>
		<?php endif; ?>
	</div>
	<?php else: ?>
	<div class="item-placeholder"><i class="icon icon-picture">&nbsp;</i></div>
	<?php endif; ?>

    <div class="item-desc back">
        <h2 class="article-title">
            <?php if ($link) : ?>
                <a class="article-link" href="<?php echo $link; ?>"> <?php echo $this->escape($this->core_item->core_title); ?></a>
            <?php else : ?>
                <?php echo $this->escape($this->core_item->core_title); ?>
            <?php endif; ?>
        </h2>
        <?php if ($this->params->get('tag_list_show_item_description', 1)) : ?>
        <section class="article-intro clearfix">
			<span class="tag-body">
				<?php echo JHtml::_('string.truncate', $this->core_item->core_body, $this->params->get('tag_list_item_maximum_characters')); ?>
			</span>
        </section>
	<?php endif; ?>
    </div>
</div>