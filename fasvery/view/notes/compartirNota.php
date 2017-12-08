<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$nota = $view->getVariable("nota");
$alias=$view->getVariable("alias");
$listaAlias = $view->getVariable("listaAlias");
?>
<!doctype html>
<html>
<body>
<div id="contenedor">
	<section>
			<article>
				<meta charset="utf-8">
				<link rel="stylesheet" href="./css/formularios.css">
				<title>registroUsuario</title>
			</article>
			<div class="container">
				<form class="formEditarNota" action="index.php?controller=Notas&amp;action=compartir" method="POST">
					<fieldset>
							<label class="labelId"><span class="icon-npm"></span><?= i18n("Id. Nota")?> <?=$nota->getIdNota()?></label>
							<label class="labelAutor"><span class="icon-id-card"></span><?= i18n("Fecha")?> <?=$alias?></label>
							<label class="labelFecha"><span class="icon-sun-o"></span><?= i18n("Fecha")?> <?=$nota->getFecha()?></label>
							<input class="inputidNota" name="idNota" type="text" hidden="true" required="true" value="<?=$nota->getIdNota()?>">
							<input class="inputTitulo" name="titulo" type="text" readonly placeholder="Título" required="true" value="<?=$nota->getTitulo()?>">
							<textarea class="inputContenido" name="contenido" type="text" readonly required="true"> <?= $nota->getContenido()?></textarea>
								<select name="listaAlias[]" multiple>
							 	<?php foreach($listaAlias as $alias) { ?>
							 		<option value="<?=$alias["alias"] ?>"><?= $alias["alias"]?></option>
							 	<?php }?>
							</select>
							<div class="btnForm">
							<input class="btnSubmit" type="submit" value="Compartir">
						</div>
					</fieldset>
				</form>
			</div>
	</section>
</div>
</body>
</html>
