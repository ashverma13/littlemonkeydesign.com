<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit = ($this->item->params->get('access-edit') && !JFactory::getApplication()->input->get('tmpl', '') == 'component');
$info = $this->item->params->get('info_block_position', 0);
//get item class
$gridInfo = FixelHelper::getGrid($this->item);

$iclass = array('items', strtolower($this->item->category_alias), $gridInfo['animate'], $gridInfo['type'], 'grid-' . $gridInfo['size']);

if($this->item->state == 0){ 
	$iclass[] = 'system-unpublished'; 
}
if(empty($images->image_intro)){ 
	$iclass[] = 'no-image'; 
}

?>
<div class="<?php echo implode(' ', array_unique($iclass)) ?>">
	<!-- Article -->
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
	<!-- //Article -->
	
	<?php echo $this->item->event->afterDisplayContent; ?>

</div>