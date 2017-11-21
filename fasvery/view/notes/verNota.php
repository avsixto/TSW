<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="shortcut icon"  href="./view/Imágenes/iconoLogo.png">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./view/Imágenes/Iconos/Iconos.css">
	<script src="./css/menuWeb.js" type="text/javascript"></script>
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
				<form class="formCrearNota" action="">
					<fieldset>
							<legend align="center"><h1><span class="icon-eye2"></span>Ver Nota</h1></legend>
							<div class="form">
							<div class="formDatos">
								<label class="labelId"><span class="icon-npm"></span>ID</label>
								<label class="labelAutor"><span class="icon-id-card"></span>Autor</label>
								<label class="labelFecha"><span class="icon-sun-o"></span>Fecha</label>
							</div>
							<input class="inputTitulo" type="text" placeholder="Título" readonly>
							<textarea class="inputContenido" type="text" placeholder="Contenido" readonly></textarea>
							</div>
							<div class="btnOpcionesNotas">
							<button class="btnEditar" onClick="editarNota.html"><span class="icon-pencil22"></span></button>
							<button class="btnCompartir" onClick="compartirNota.html"><span class="icon-share-alt"></span></button>
							<button class="btnEliminar"><span class="icon-trash"></span></button>
							</div>
					</fieldset>
				</form>
			</div>
			</body>
	</section>
</div>
</body>
</html>
