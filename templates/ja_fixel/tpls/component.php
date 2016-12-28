<?php
/** 
 *------------------------------------------------------------------------------
 * @package       T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       JoomlArt, JoomlaBamboo, (contribute to this project at github 
 *                & Google group to become co-author)
 * @Google group: https://groups.google.com/forum/#!forum/t3fw
 * @Link:         http://t3-framework.org 
 *------------------------------------------------------------------------------
 */

defined('_JEXEC') or die;

if(!defined('T3_TPL_COMPONENT')){
  define('T3_TPL_COMPONENT', 1);
}
?>

<!DOCTYPE html>
<!--[if IE 8]>         <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="component ie8 lt-ie9 lt-ie10 <?php $this->bodyClass(); ?><?php echo $this->getParam('tpl_enable_popup', 1)? '' : ' no-preview' ?>"> <![endif]-->
<!--[if IE 9]>         <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="component ie9 lt-ie10 <?php $this->bodyClass(); ?><?php echo $this->getParam('tpl_enable_popup', 1)? '' : ' no-preview' ?>"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="component <?php $this->bodyClass(); ?><?php echo $this->getParam('tpl_enable_popup', 1)? '' : ' no-preview' ?>"> <!--<![endif]-->

  <head>
    <jdoc:include type="head" />
    <?php $this->loadBlock ('head') ?>  
  </head>

  <body>
    <section id="t3-mainbody" class="t3-mainbody">
      <div id="t3-content" class="t3-content">
        <jdoc:include type="message" />
        <jdoc:include type="component" />    
      </div>
    </section>
  </body>

</html>