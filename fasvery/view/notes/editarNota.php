<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$nota = $view->getVariable("nota");
$alias=$view->getVariable("alias");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="shortcut icon"  href=".view/Images/iconoLogo.png">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./Images/Iconos/Iconos.css">
	<script src="./css/menuWeb.js" type="text/javascript"></script>
	<title>FastVery</title>
</head>
<body>
<div id="contenedor">
	<section>
			<article>
				<meta charset="utf-8">
				<link rel="stylesheet" href="./css/formularios.css">
				<title>registroUsuario</title>
			</article>
			<div class="container">
				<form class="formEditarNota" action="index.php?controller=Notas&amp;action=editar" method="POST">
					<fieldset>
							<label class="labelId"><span class="icon-npm"></span>ID <?=$nota->getIdNota()?></label>
							<label class="labelAutor"><span class="icon-id-card"></span>Autor <?=$alias?></label>
							<label class="labelFecha"><span class="icon-sun-o"></span>Fecha <?=$nota->getFecha()?></label>
							<input class="inputidNota" name="idNota" type="text" hidden="true" required="true" value="<?=$nota->getIdNota()?>">
							<input class="inputTitulo" name="titulo" type="text" placeholder="Título" required="true" value="<?=$nota->getTitulo()?>">
							<textarea class="inputContenido" name="contenido" type="text" required="true"> <?= $nota->getContenido()?></textarea>
							<div class="btnForm">
							<input class="btnSubmit" type="submit" value="editar">
						</div>
					</fieldset>
				</form>
			</div>
	</section>
</div>
</body>
</html>
