<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$listaAlias = $view->getVariable("listaAlias");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="shortcut icon"  href="./view/Images/iconoLogo.png">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./view/Images/Iconos/Iconos.css">
	<script src="../../css/menuWeb.js" type="text/javascript"></script>
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
				<form class="formCrearNota" action="index.php?controller=Notas&amp;action=nueva" method="POST">
					<fieldset>
							<legend align="center"><h1><span class="icon-file-symlink-file"></span>Crear Nota</h1></legend>
							<div class="form">
							<input class="inputTitulo" type="text" name="titulo" placeholder="Título" required>
							<textarea class="inputContenido" type="text" name="contenido" placeholder="Contenido" required></textarea>
							</div>
							 <select multiple>
							 	<?php foreach($listaAlias as $alias) { ?>
							 		<option value="<?=$alias["alias"] ?>"><?= $alias["alias"] ?></option>
							 	<?php }?>
							</select> 
							<div class="btnForm">
								<input class="btnSubmit" type="submit" value="Crear">
								<input class="btnReset" type="reset" value="Limpiar">
							</div>
					</fieldset>
				</form>
			</div>
	</section>
</div>
</body>
</html>
