<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>Site SIL3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="view/style.css" media="screen" title="Normal" />
		        <link rel="stylesheet" type="text/css" href="view/bootstrap/css/bootstrap.min.css"/>
		</head>
	<body>
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
				<form action="index.php?controller=photoMatrix&action=categorie" method="post">
					Choisir une catégorie : <br>
					<select name="categorie" class="custom-select">
						<?php foreach ($this->data->categories as $cat): ?>
							<option value="<?= $cat['category'] ?>"><?= $cat['category'] ?></option>
						<?php endforeach; ?>
					</select>
					<input class="btn btn-info" type="submit">
				</form>
			</div>

		<div id="corps">
			<?php # mise en place de la vue partielle : le contenu central de la page
				# Mise en place des deux boutons
				if (isset($this->data->categorieAffichee)) {
				}else{
					print "<p>\n";

					if ($this->data->imgId > 1) {
						print "<a href=\"index.php?controller=photoMatrix&action=prev&imgId=".$this->data->imgId."&nbImg=".$this->data->nbImg."\">Prev</a> ";
					}
					if ($this->data->nbImg + $this->data->imgId < $this->data->count) {
						print "<a href=\"index.php?controller=photoMatrix&action=next&imgId=".$this->data->imgId."&nbImg=".$this->data->nbImg."\">Next</a> ";
					}
					print "</p>\n";
				}


				// Réalise l'affichage de l'image
				# Adapte la taille des images au nombre d'images présentes
				if (isset($this->data->imgMatrixURL)) {
					$size = 480 / sqrt(count($this->data->imgMatrixURL));
				# Affiche les images
				foreach ($this->data->imgMatrixURL as $i) {
					print "<a href=\"".$i[1]."\"><img src=\"".$i[0]."\" width=\"".$size."\" height=\"".$size."\" class=\"img-thumbnail\"></a>\n";
				};


			}

			if (isset($this->data->categorieAffichee)) {
				print "<p class=\"lead\">Catégorie : ".$this->data->categorieAffichee."</p>";
			}
				?>
		</div>
		<div id="pied_de_page">
			</div>
		</body>
	</html>
