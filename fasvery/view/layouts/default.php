<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
	<head>
		<title><?= $view->getVariable("title", "no title") ?></title>
		<meta charset="utf-8">
			<link rel="stylesheet" href="../../css/style.css" type="text/css">
			<script src="index.php?controller=language&amp;action=i18njs"></script>
	
			<?= $view->getFragment("css") ?>
			<?= $view->getFragment("javascript") ?>
	</head>
	<body>
		<section>
			<header>
			<?php
				include(__DIR__."/Header.php");
			?>
			</header>

			<main>
				<div id="flash"><?= $view->popFlash() ?></div>
					<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
			</main>
		</section>
		<footer>
			<?php
			include(__DIR__."/Footer.php");
			?>
		</footer>
	</body>
</html>
