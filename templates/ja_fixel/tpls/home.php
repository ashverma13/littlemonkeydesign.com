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
?>

<!DOCTYPE html>
<!--[if IE 8]>         <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="layout-home ie8 lt-ie9 lt-ie10 <?php $this->bodyClass(); ?>"> <![endif]-->
<!--[if IE 9]>         <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="layout-home ie9 lt-ie10 <?php $this->bodyClass(); ?>"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="layout-home <?php $this->bodyClass(); ?>"> <!--<![endif]-->

  <head>
    <jdoc:include type="head" />
    <?php $this->loadBlock ('head') ?>
    <!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2Az5BkY2ocfU4iQUrBJ4AufsV0XCjcsy';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
  </head>

  <body>


    
    <?php $this->loadBlock ('home') ?>
    
    <?php $this->loadBlock ('footer') ?>

    <?php $this->loadBlock ('popup') ?>
    
  </body>

</html>