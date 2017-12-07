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
	<link rel="shortcut icon"  href="./view/Images/iconoLogo.png">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./view/Images/Iconos/Iconos.css">
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
				<form class="formCrearNota" action="">
					<fieldset>
							<legend align="center"><h1><span class="icon-eye2"></span>Ver Nota</h1></legend>
							<div class="form">
							<div class="formDatos">
								<label class="labelId"><span class="icon-npm"></span>ID <?=$nota->getIdNota()?></label>
								<label class="labelAutor"><span class="icon-id-card"></span>Autor <?=$alias?></label>
								<label class="labelFecha"><span class="icon-sun-o"></span>Fecha <?=$nota->getFecha()?></label>
								<input class="inputTitulo" type="text" placeholder="Título" readonly value="<?=$nota->getTitulo()?>">
								<textarea class="inputContenido" type="text" readonly> <?= $nota->getContenido()?></textarea>
							<div class="btnOpcionesNotas">
							<button class="btnEditar" onClick="editarNota.html"><span class="icon-pencil22"></span></button>
							<button class="btnCompartir" onClick="compartirNota.html"><span class="icon-share-alt"></span></button>
							<button class="btnEliminar"><span class="icon-trash"></span></button>
							</div>
					</fieldset>
				</form>
			</div>
	</section>
</div>
</body>
</html>
