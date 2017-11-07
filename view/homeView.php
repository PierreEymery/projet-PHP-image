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
						<?php print "<span class=\"lead\">Bonjour, ".$_SESSION["login"]."</span>"; ?>

								<button type="submit" name="log_out" class="btn btn-primary">Deconnexion</button>
								&nbsp;
					</form>
				</span>
			</h1>
		</div>
		<div id="menu" class="text-center">
			<h3>Menu</h3>
			<ul class="list-unstyled">
				<?php # Mise en place du menu par un parcours de la table associative
					$menu['Home']=$this->data->menu['Home'];
					$menu['A propos']=$this->data->menu['A propos'];
					$menu['Voir photos']=$this->data->menu['Voir photos'];

					foreach ($menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
				</ul>
			</div>

		<div id="corps">
			<h1> Bonjour !</h1>
			<p> Cette application vous permet de manipuler des photos <br/>
			Vous pouvez : noter, afficher par catégories, modifier, déposer des images</p>
			</div>

		<div id="pied_de_page">
			</div>
		</body>
	</html>
