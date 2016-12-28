<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

JHtml::_('behavior.framework');
?>

<?php if ($this->items == false || empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
<?php else : ?>

	<?php 
		$tagsHelper = new JHelperTags;
		$tagsFilter = create_function('$tag', 'return $tag->alias; ');
	?>

	<?php foreach ($this->items as $i => $item) : ?>

		<?php
			$this->core_item = $item;
			$gridInfo = FixelHelper::getGrid($item, 'core_metadata');
			$itags    = $tagsHelper->getItemTags('com_content.article', $item->content_item_id);
			$iclass   = array('items', $gridInfo['animate'], $gridInfo['type'], 'grid-' . $gridInfo['size']);

			if(!empty($itags)){
				$iclass = array_merge($iclass, array_map($tagsFilter, $itags));
			}
			
			if($item->core_state == 0){ 
				$iclass[] = 'system-unpublished'; 
			}
			if(empty($images->image_intro)){ 
				$iclass[] = 'no-image'; 
			}
		?>

		<div class="<?php echo implode(' ', array_unique($iclass)) ?>">
			<article>
				<?php

				switch ($gridInfo['type']) :
					case 'video':
						echo $this->loadTemplate('item_video');
					break;

					case 'gallery':
						echo $this->loadTemplate('item_gallery');
					break;
					
					case 'text':
						echo $this->loadTemplate('item_default');
					break;
					
					default:
						echo $this->loadTemplate('item_images');
					break;
				endswitch;

				?>
			</article>
		
			<?php echo $item->event->afterDisplayContent; ?>

		</div>
	<?php endforeach; ?>

<?php endif; ?>
