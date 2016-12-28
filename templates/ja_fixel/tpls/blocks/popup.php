<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- POPUP VIEW -->
<div id="popup-view" class="t3-hide">
	<div id="popup-position">
		<div id="popup-content">
			<div class="popup-head">
				<a id="popup-close" href="<?php echo JUri::root(true) ?>" class="btn-close pull-right icon-remove" title="<?php echo JText::_('TPL_POPUP_CLOSE') ?>"><?php echo JText::_('TPL_POPUP_CLOSE') ?></a>
			</div>
			<div class="popup-nav pull-right">
				<a id="popup-prev" href="<?php echo JUri::root(true) ?>" class="icon-chevron-left" title="<?php echo JText::_('TPL_POPUP_PREV') ?>"><span><?php echo JText::_('TPL_POPUP_PREV') ?></span></a>
				<a id="popup-next" href="<?php echo JUri::root(true) ?>" class="icon-chevron-right" title="<?php echo JText::_('TPL_POPUP_NEXT') ?>"><span><?php echo JText::_('TPL_POPUP_NEXT') ?></span></a>
			</div>
			<div id="popup-loader" class="fade hide" data-backdrop="">
				<div class="ajax-indicator"><?php echo JText::_('TPL_POPUP_LOADING') ?></div>
			</div>
		</div>
	</div>
</div>
<!-- //POPUP VIEW -->

<!-- PAGE LOADER INDICATOR -->
<div id="page-loader" class="fade hide" data-backdrop="">
    <div class="ajax-indicator"><?php echo JText::_('TPL_POPUP_LOADING') ?></div>
</div>
<!-- //PAGE LOADER INDICATOR -->

<!-- ARTICLE LOADER INDICATOR -->
<div id="article-loader" class="fade hide" data-backdrop="">
    <div class="ajax-indicator"><?php echo JText::_('TPL_POPUP_LOADING') ?></div>
</div>
<!-- //ARTICLE LOADER INDICATOR -->