<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$sitename = $this->params->get('sitename') ? $this->params->get('sitename') : JFactory::getConfig()->get('sitename');
?>

<!-- FOOTER -->
<footer id="t3-footer" class="wrap t3-footer">
  <div class="container">
    <div class="row">
        
      <?php if ($this->getParam('t3-rmvlogo', 1) || $this->countModules('footer')): ?>
      <div class="span8 copyright<?php $this->_c('footer')?>">
        <jdoc:include type="modules" name="<?php $this->_p('footer') ?>" />
      </div>
      <?php endif; ?>
	  
	  <!-- FOOTER LOGO -->
      <div class="span4 pull-right">    
        
        <?php if($this->getParam('t3-rmvlogo', 1)): ?>
        <div class="poweredby">
          <a class="t3-logo t3-logo-light" href="http://t3-framework.org" title="Powered By T3 Framework" target="_blank" <?php echo method_exists('T3', 'isHome') && T3::isHome() ? '' : 'rel="nofollow"' ?>>Powered by <strong>T3 Framework</strong></a>
        </div>
        <?php endif; ?>

      </div>
      <!-- //FOOTER LOGO -->

    </div>
  </div>
</footer>
<!-- //FOOTER -->

<!-- BACK TO TOP -->
<div id="back-to-top" class="back-to-top t3-hide">
  <i class="icon-long-arrow-up"></i>
</div>
<script type="text/javascript">
  //<![CDATA[
  (function($){
    $(document).ready(function(){
      $('#back-to-top').click(function(){
        if($(this).hasClass('reveal')){
          $('html, body').stop(true).animate({
            scrollTop: 0
          });
        }
      });

      $(window).scroll(function(){
        $('#back-to-top')[$(window).scrollTop() > ($('#t3-mainbody').length ? $('#t3-mainbody').offset().top : 0) ? 'addClass' : 'removeClass']('reveal');
      });
    });
  })(jQuery);
  //]]>
</script>
<!-- //BACK TO TOP -->
