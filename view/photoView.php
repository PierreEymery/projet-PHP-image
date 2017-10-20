<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>Site SIL3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../view/style.css" media="screen" title="Normal" />
		</head>
	<body>
		<?php 				//var_dump($this->data);
 ?>
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
					// Pre-calcule la première image
					# Change l'etat pour indiquer que cette image est la nouvelle
					$menu['First']=$this->data->menu['Voir photos'];
					# Affiche une image au hasard
					$menu['Random']=$this->data->menu['Random'];
					# Pour afficher plus d'image passe à une autre page
					$menu['More']=$this->data->menu['More'];
					// Demande à calculer un zoom sur l'image
					$menu['Zoom +']=$this->data->menu['Zoom +'];
					// Demande à calculer un zoom sur l'image
					$menu['Zoom -']=$this->data->menu['Zoom -'];
					// Affichage du menu
					foreach ($menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
				</ul>
			</div>

		<div id="corps">
			<?php # mise en place de la vue partielle : le contenu central de la page
				# Mise en place des deux boutons
				print "<p>\n";
				// pre-calcul de l'image précedente
				$size=$this->data->size;
				$imgId=$this->data->imgId;

				print "<a href=\"index.php?controller=photo&action=prev&imgId=$imgId&size=".$size."\">Prev</a> ";
				// pre-calcul de l'image suivante
				print "<a href=\"index.php?controller=photo&action=next&imgId=$imgId&size=".$size."\">Next</a>\n";
				print "</p>\n";
				print "<p>".$this->data->imgCat."</p>";
				# Affiche l'image avec une reaction au click
				print "<a href=\"index.php?controller=photo&action=zoom&zoom=1.25&imgId=$imgId&size=".$size."\">\n";
				// Réalise l'affichage de l'image


				print "<img src=\"".$this->data->imgURL."\" width=\"".$size."\">\n";
				print "</a>\n";


				print "<p>".$this->data->imgComment."</p>";
				?>
			</div>

		<div id="pied_de_page">
		</div>
	</body>
</html>
