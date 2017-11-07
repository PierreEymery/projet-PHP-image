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
					foreach ($this->data->menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
				</ul>
			</div>

		<div id="corps">
			<h1> Information !</h1>
			<p> Cette application  a pour but de mettre en pratique  le modèle MVC en PHP par l'équipe de SIL3 de l'IUT2 de Grenoble. </p>
			</p> Cette version utilise les images sur le disque</p>
			</div>

		<div id="pied_de_page">
			</div>
		</body>
	</html>
