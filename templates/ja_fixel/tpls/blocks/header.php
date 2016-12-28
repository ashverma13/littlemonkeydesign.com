<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$sitename = $this->params->get('sitename') ? $this->params->get('sitename') : JFactory::getConfig()->get('sitename');
$slogan = $this->params->get('slogan');
$logotype = $this->params->get('logotype', 'text');
$logoimage = $logotype == 'image' ? $this->params->get('logoimage', '') : '';
?>

<!-- MAIN NAVIGATION -->
<nav id="t3-mainnav" class="wrap t3-mainnav navbar-collapse-fixed-top">

  <div class="container navbar">
    <div class="navbar-inner">

      <button id="fixel-btn-navbar" type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".fixel-nav-collapse">
        <i class="icon-reorder"></i>
  	  </button>
      
      <!-- LOGO -->
      <div class="logo logo-<?php echo $logotype ?> <?php echo $logoimage?'has-images':'';?>">
        <div class="brand">
          <a href="<?php echo JURI::base(true) ?>" title="<?php echo strip_tags($sitename) ?>">
            <?php if($logotype == 'image' && $logoimage): ?>
            <img class="logoimg" src="<?php echo JURI::base(true).'/'.$logoimage ?>" alt="<?php echo strip_tags($sitename) ?>" />
            <?php endif ?>
            <span><?php echo $sitename ?></span>
          </a>
          <small class="site-slogan hidden-phone"><?php echo $slogan ?></small>
        </div>
      </div>
      <!-- //LOGO -->

      <div class="fixel-nav-collapse nav-collapse collapse<?php echo $this->getParam('navigation_collapse_showsub', 1) ? ' always-show' : '' ?>">
      <?php if ($this->getParam('navigation_type') == 'megamenu') : ?>
        <?php $this->megamenu($this->getParam('mm_type', 'mainmenu')) ?>
      <?php else : ?>
        <div class="mainnav-wrap <?php $this->_c('navhelper') ?>">
          <jdoc:include type="modules" name="mainnav" style="raw" />
        </div>
      <?php endif ?>
  		</div>
		
		  <?php if ($this->countModules('social-link')) : ?>
		  <!-- HEAD SEARCH -->   
		  <div id="social-link-block" class="social-link pull-right">
			<jdoc:include type="modules" name="<?php $this->_p('social-link') ?>" style="raw" />
		  </div>
		  <!-- //HEAD SEARCH -->
		  <?php endif ?>
  		
      <?php if ($this->checkSpotlight('spotlight-1', 'position-1, position-2, position-3, position-4')) : ?>
      <a href="#fixel-top-panel" id="fixel-top-pannel-link" class="top-pannel-link t3-hide" aria-hidden="true">
        <i class="icon-chevron-down"></i>
      </a>
      <?php endif ?>
    </div>
  </div>
  
  <!-- SPOTLIGHT 1 -->
  	<?php $this->loadBlock ('spotlight-1') ?>
  <!-- //SPOTLIGHT 1 -->
</nav>
<!-- //MAIN NAVIGATION -->


<?php if($this->countModules('mycart')): ?>
<div class="row">
  <div id="mycart" class="dropdown pull-right">
    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"><i class="icon-shopping-cart"></i></a>
    <div class="dropdown-menu">
      <jdoc:include type="modules" name="<?php $this->_p('mycart') ?>" style="raw" />
    </div>
  </div>
</div>
<?php endif; ?>