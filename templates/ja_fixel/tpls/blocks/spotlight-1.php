<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($this->checkSpotlight('spotlight-1', 'position-1, position-2, position-3, position-4, position-5')) : ?>
<!-- SPOTLIGHT 1 -->
<div id="fixel-top-panel" class="t3-sl t3-sl-1" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="">
	<div class="container">
  <?php 
  	$this->spotlight ('spotlight-1', 'position-1, position-2, position-3, position-4, position-5', array( 'row-fluid' => 1 ))
  ?>
  </div>
</div>
<!-- //SPOTLIGHT 1 -->
<?php endif ?>