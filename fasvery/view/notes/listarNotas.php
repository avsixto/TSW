<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$listaNotas = $view->getVariable("notes");
$errors = $view->getVariable("errors");
?>
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
				<div class="tituloListar"><h1>Notas Publicadas</h1></div>
				<?php foreach($listaNotas as $nota){ ?>
					<form class="formListarNota" action="index.php?controller=Notas&amp;action=listarNotas" method="POST">
						<fieldset>
								<legend align="center"><h1> <?=$nota->getTitulo()?></h1></legend>
								<div class="form">
									<label class="labelId"><span class="icon-npm"></span>ID <?=$nota->getIdNota()?></label>
									<label class="labelAutor"><span class="icon-id-card"></span>Autor <?=$nota->getAutor()?></label>
									<label class="labelFecha"><span class="icon-sun-o"></span>Fecha <?=$nota->getFecha()?></label>
									<textarea class="inputContenido" type="text" readonly> <?= $nota->getContenido()?></textarea>
								</div>
								<div class="btnOpcionesNotas">
								
								<button class="btnVer" onClick=""><span class="icon-eye2"></span></button>
								<button class="btnEditar"><span class="icon-pencil22"></span></button>
								<button class="btnCompartir"><span class="icon-share-alt"></span></button>
								<button class="btnEliminar"><span class="icon-trash"></span></button>
								</div>
						</fieldset>
					</form>
				<?php } ?>
				<div><h1>Notas Compartidas Conmigo</h1></div>
				</div>
		</section>
	</div>
</body>
