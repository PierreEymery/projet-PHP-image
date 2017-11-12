<?php
	require_once("model/data.php");

	class Home {

		protected $data;

		function __construct() {
			// Ouvre le blog
			$this->data = new Data();
			$this->data->login = $_SESSION['login'];

		}

		// Recupere les parametres de manière globale
		// Pour toutes les actions de ce contrôleur
		protected function getParam() {
			// Recupère un éventuel no de départ
			global $from,$mode;
			if (isset($_GET["from"])) {
				$from = $_GET["from"];
			} else {
				$from = 1;
			}
			// Recupere le mode delete de l'interface
			if (isset($_GET["mode"])) {
				$mode = $_GET["mode"];
			} else {
				$mode = "normal";
			}


		}

		// LISTE DES ACTIONS DE CE CONTROLEUR

		// Action par défaut
		function index() {
			$this->data->content="homeView.php";
			$this->prepView();
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// affiche la vue A propos de l'application
		function apropos(){
			$this->data->content="aProposView.php";
			$this->prepView();
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// prépare les liens des menus dans la vue
		function prepView(){
			$this->data->menu['Home']="index.php";
			$this->data->menu['A propos']="index.php?controller=home&action=aPropos";
			$this->data->menu['Voir photos']="index.php?controller=photo&action=first";
		}




	}
?>
