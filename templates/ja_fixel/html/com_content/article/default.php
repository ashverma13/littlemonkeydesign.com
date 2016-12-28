<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::addIncludePath(T3_PATH.'/html/com_content');
JHtml::addIncludePath(dirname(dirname(__FILE__)));

JLoader::register('FixelHelper', T3_TEMPLATE_PATH . '/templateHelper.php');

// Create shortcuts to some parameters.
$input    = JFactory::getApplication()->input;
$gridInfo = FixelHelper::getGrid($this->item);
$tplparams = JFactory::getApplication()->getTemplate(true)->params;

?>

<?php if ($this->params->get('show_page_heading', 1)) : ?>
<div class="page-header clearfix">
	<h1 class="page-title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
</div>
<?php endif; ?>

<div class="item-page<?php echo $this->pageclass_sfx?> <?php echo $input->get('fixelpopup', 0) ? 'fixelpopup' : '' ?> clearfix">

	<?php if($input->get('fixelpopup', 0) && ($gridInfo['type'] == 'video' || $gridInfo['type'] == 'image')): ?>

	<?php
	switch ($gridInfo['type']) :
		case 'video':
			echo $this->loadTemplate('popup_video');
		break;

		case 'image':
			echo $this->loadTemplate('popup_images');
		break;
	endswitch;
	?>

	<?php elseif($gridInfo['type'] == 'gallery') : ?>
		<?php echo $this->loadTemplate('gallery'); ?>
	<?php else: ?>
		<?php echo $this->loadTemplate('detail'); ?>
	<?php endif ?>

	<?php echo $this->item->event->afterDisplayContent; ?>

	<?php if($tplparams->get('tpl_facebook_comment', 1)): ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1<?php echo $tplparams->get('tpl_facebook_appid', '') ? '&appId=' . $tplparams->get('tpl_facebook_appid', '') : '' ?>";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		<div class="fb-comments" data-href="<?php echo JUri::getInstance()->toString(array('scheme', 'host', 'port')) . $this->item->readmore_link ?>" data-num-posts="10"></div>
	<?php endif ?>
</div>