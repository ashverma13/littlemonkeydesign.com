<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Panorama 360&deg;</title>
	<link rel="stylesheet" href="assets-demos/css/demo.css" media="all" />
	<link rel="stylesheet" href="css/panorama360.css" media="all" />
</head>
<body>
	<div class="panorama">
		<div class="preloader"></div>
		<div class="panorama-view">
			<div class="panorama-container">
<?php
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
if ($iPod || $iPhone || $iPad) : ?>
				<img src="small-.jpg" data-width="1922" data-height="500" alt="Panorama" />
<?php else : ?>
				<img src="full-size.jpg" data-width="4996" data-height="1300" alt="Panorama" />
<?php endif; ?>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="js/jquery.panorama360.js"></script>
	<script>
		$(function(){
			$('.panorama-view').panorama360({
				sliding_controls: true
			});
		});
	</script>
</body>
</html>