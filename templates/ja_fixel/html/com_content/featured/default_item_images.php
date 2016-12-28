<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


$params = $this->item->params;
$images = json_decode($this->item->images);

$link = false;

if (!empty($images->image_intro)) {
	$intro_src   = $images->image_intro;
	$intro_title = !empty($images->image_intro_caption) ? $images->image_intro_caption : $this->item->title;
	$intro_alt   = !empty($images->image_intro_alt) ? $images->image_intro_alt : $this->item->title;
} else {
	$iimage      = FixelHelper::image($this->item);
	$intro_title = $intro_alt = $this->item->title;
	$intro_src   = isset($iimage['src']) ? $iimage['src'] : '';
}

if ($params->get('link_titles') && $params->get('access-view')) {
	$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
}
?>
<div class="item-image-wrap flipper">
	<?php if (!empty($intro_src)): ?>
	<div class="item-image front">
		<?php if ($link): ?>
		<a class="article-link" href="<?php echo $link; ?>" title="<?php echo $this->escape($this->item->title); ?>">
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
                <a class="article-link" href="<?php echo $link; ?>"> <?php echo $this->escape($this->item->title); ?></a>
            <?php else : ?>
                <?php echo $this->escape($this->item->title); ?>
            <?php endif; ?>
        </h2>
        <section class="article-intro clearfix">
            <?php echo $this->item->introtext; ?>
        </section>
    </div>
</div>