<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
		<link rel="shortcut icon"  href="./view/Images/iconoLogo.png">
		<link rel="stylesheet" href="../../css/style.css">
		<link rel="stylesheet" href="./view/Images/Iconos/Iconos.css">
		<script src="./css/menuWeb.js" type="text/javascript"></script>
		<title>FastVery</title>
	</head>
	<body>
			<div id="contenedor">
				<header>
					<img src="./view/Images/logo.png" class="logo">
					<div id="menuBar" class="menuBar" onClick="mostrarMenu();">
						<a href="#" class="btnMenu"><span class="icon-menu"></span>Menu</a>
					</div>
					<nav id="nav">
						<ul class="menuGeneral">
							<li><a href="index.php?controller=main&amp;action=index"><span class="icon-home4"></span>INICIO</a></li>
							<li><a href="#"><span class="icon-enter"></span>VALIDARSE<span class="icon-arrow-submenu"></span></a>
								<ul >
									<li><a href="index.php?controller=Usuario&amp;action=register" ><span class="icon-user-check"></span>Registrarse</a></li>
									<li><a href="index.php?controller=Usuario&amp;action=login" ><span class="icon-sign-in"></span>Entrar</a></li>
									<li><a href="index.php?controller=Usuario&amp;action=logout"><span class="icon-sign-out"></span>Salir</a></li>
								</ul>
							</li>
							<li><a href="#"><span class="icon-sticky-note"></span>NOTAS<span class="icon-arrow-submenu"></span></a>
								<ul>
									<li><a href="index.php?controller=Notas&amp;action=nueva" ><span class="icon-profile"></span>Nueva</a></li>
									<li><a href="index.php?controller=Notas&amp;action=listarNotas"><span class="icon-list-ordered"></span>Listar</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</header>
			</div>
	</body>
</html>