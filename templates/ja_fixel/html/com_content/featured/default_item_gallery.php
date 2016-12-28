<?php
/**
* @package     Joomla.Site
* @subpackage  com_content
*
* @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

$gallery = FixelHelper::gallery($this->item); 
?>
<div class="item-gallery-wrap">
	<?php if(!empty($gallery)) : ?>
		<?php echo $gallery ?>
	<?php else : ?>
		<div class="item-placeholder"><i class="icon icon-picture">&nbsp;</i></div>
	<?php endif ?>
</div>