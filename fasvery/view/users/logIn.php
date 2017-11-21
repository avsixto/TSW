<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../../css/formularios.css">
		<title>registroUsuario</title>
	</head>
		<body>
			<div class="container">
				<div class="logIn">
					<form class="formRegister" action="index.php?controller=Usuario&amp;action=login" method="POST">
					<fieldset>
							<legend align="center"><h1><span class="icon-file-media"></span>LOGIN</h1></legend>
							<div class="formLogin">
								<input class="input" type="text" name="alias" placeholder="&#128100;Alias" autofocus required>
								<input class="input" type="password" name="password" placeholder="&#9919;Key" required>
							</div>
							<div class="btnForm">
								<input class="btnSubmit" type="submit" value="Enter">
								<input class="btnReset" type="reset" value="Clear">
							</div>
					</fieldset>
				</form>
				</div>
			</div>
		</body>
</html>