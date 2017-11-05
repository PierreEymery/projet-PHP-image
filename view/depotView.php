<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>Site SIL3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="view/style.css" media="screen" title="Normal" />
		</head>
	<body>
		<?php 	//var_dump($this->data); ?>
		<div id="entete">
			<h1>Site SIL3</h1>
		</div>
		<div id="menu">
			<h3>Menu</h3>
			<ul>
				<?php

					# Mise en place du menu
					$menu['Home']=$this->data->menu['Home'];
					$menu['A propos']=$this->data->menu['A propos'];
					# Change l'etat pour indiquer que cette image est la nouvelle
					$menu['First']=$this->data->menu['Voir photos'];
					# Affiche une image au hasard
					$menu['Random']=$this->data->menu['Random'];

					// Affichage du menu
					foreach ($menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
				</ul>
			</div>

		<div id="corps">
			<form action="index.php?controller=photo&action=depotImage" method="post" enctype="multipart/form-data">
				Choisir l'image à déposer : <br>
				<input type="file" name="newFile" id="newFile"><br><br>
				Choisir la catégorie de cette photo :<br>
				<select name="fileCategorie">
					<?php foreach ($this->data->categories as $cat): ?>
						<option value="<?= $cat['category'] ?>"><?= $cat['category'] ?></option>
					<?php endforeach; ?>
				</select><br><br>
				Ou créer une nouvelle catégorie :<br>
				<input type="text" name="fileNewCategorie" value=""><br><br>
				Choisir le commentaire de la photo :<br>
				<textarea name="fileComment" rows="8" cols="80" required></textarea><br>
				<input type="submit" name="" value="Enregistrer">
			</form>
		</div>

		<div id="pied_de_page">
		</div>

	</body>
</html>
