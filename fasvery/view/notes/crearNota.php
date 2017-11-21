<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="shortcut icon"  href="./view/Imágenes/iconoLogo.png">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./view/Imágenes/Iconos/Iconos.css">
	<script src="../../css/menuWeb.js" type="text/javascript"></script>
	<title>FastVery</title>
</head>
<body>
<div id="contenedor">
	<section>
			<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="./css/formularios.css">
				<title>registroUsuario</title>
			</head>
			<body>
			<div class="container">
				<form class="formCrearNota" action="index.php?controller=Notas&amp;action=nueva" method="POST">
					<fieldset>
							<legend align="center"><h1><span class="icon-file-symlink-file"></span>Crear Nota</h1></legend>
							<div class="form">
							<input class="inputTitulo" type="text" name="titulo" placeholder="Título" required>
							<textarea class="inputContenido" type="text" name="contenido" placeholder="Contenido" required></textarea>
							</div>
							<div class="check"><label>Usuario1 </label><input type="checkbox"></div>
							<div class="check"><label>Usuario2 </label><input type="checkbox"></div>
							<div class="check"><label>Usuario3 </label><input type="checkbox"></div>
							<div class="btnForm">
								<input class="btnSubmit" type="submit" value="Crear">
								<input class="btnReset" type="reset" value="Limpiar">
							</div>
					</fieldset>
				</form>
			</div>
			</body>
	</section>
</div>
</body>
</html>
