<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>Site SIL3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../view/style.css" media="screen" title="Normal" />
		</head>
	<body>
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
					$menu['First']=$this->data->menu['First'];
					// $menu['Random']="viewPhoto.php?imgId=".$imgDAO->getRandomImage()."&size=$size";
					$menu['More']=$this->data->menu['More'];
					if($this->data->nbImg != 1){
					 	$menu['Less']=$this->data->menu['Less'];
					}
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
				if ($this->data->imgId > 1) {
					print "<a href=\"index.php?controller=photoMatrix&action=prev&imgId=".$this->data->imgId."&nbImg=".$this->data->nbImg."\">Prev</a> ";
				}
				if ($this->data->nbImg + $this->data->imgId < $this->data->count) {
					print "<a href=\"index.php?controller=photoMatrix&action=next&imgId=".$this->data->imgId."&nbImg=".$this->data->nbImg."\">Next</a> ";
				}
				print "</p>\n";

				// Réalise l'affichage de l'image
				# Adapte la taille des images au nombre d'images présentes
				if (isset($this->data->imgMatrixURL)) {
					$size = 480 / sqrt(count($this->data->imgMatrixURL));
				# Affiche les images
				foreach ($this->data->imgMatrixURL as $i) {
					print "<a href=\"".$i[1]."\"><img src=\"".$i[0]."\" width=\"".$size."\" height=\"".$size."\"></a>\n";
				};
			}
				?>
			</div>

		<div id="pied_de_page">
			</div>
		</body>
	</html>
