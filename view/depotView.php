<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>Site SIL3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="view/style.css" media="screen" title="Normal" />
		<link rel="stylesheet" type="text/css" href="view/bootstrap/css/bootstrap.min.css"/>
		<script src="view/bootstrap/js/bootstrap.min.js" type="text/javascript">		</script>


	</head>
	<body>
		<?php 	//var_dump($this->data); ?>

		<div id="entete">
			<h1>&nbsp;Site SIL3
				<span class="float-right">
					<form action="index.php" method="post">
						<?php print "<span class=\"lead\">Bonjour, ".$this->data->login."</span>"; ?>

								<button type="submit" name="log_out" class="btn btn-primary">Deconnexion</button>
								&nbsp;
					</form>
				</span>
			</h1>
		</div>
		<div id="menu" class="text-center">
			<h3>Menu</h3>
			<ul class="list-unstyled">
				<?php

				// Affichage du menu
					foreach ($this->data->menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
				</ul>
			</div>

		<div id="corps">
			<form action="index.php?controller=photo&action=depotImage" method="post" enctype="multipart/form-data">
				Choisir l'image à déposer : <br>
				<input type="file" name="newFile" id="newFile" required ><br><br>
				Choisir la catégorie de cette photo :<br>
				<select name="fileCategorie" class="custom-select">
					<?php foreach ($this->data->categories as $cat): ?>
						<option value="<?= $cat['category'] ?>"><?= $cat['category'] ?></option>
					<?php endforeach; ?>
				</select><br><br>
				Ou créer une nouvelle catégorie :<br>
				<input type="text" name="fileNewCategorie" class="form-control" value=""><br>
				Choisir le commentaire de la photo :<br>
				<textarea name="fileComment" rows="8" cols="80" class="form-control" required></textarea><br>
				<input type="submit" class="btn btn-primary" name="" value="Enregistrer">
			</form>
		</div>

		<div id="pied_de_page">
		</div>

	</body>
</html>
