<?php
	require_once("model/imageDAO.php");
	require_once("model/data.php");

	class PhotoMatrix {

		protected $imageDAO;
		protected $imgId,$nbImg;
		protected $img;
		protected $data;
		protected $imgMatrixURL;
		protected $count;

		function __construct() {
			// Ouvre le blog
			$this->imageDAO = new ImageDAO();
			$this->data = new Data();
			// Recupère l'id de l'image affichée
			if (isset($_GET["imgId"])) {
				$this->imgId = $_GET["imgId"];
			} else {
				$this->imgId = 1;
			}
			// Recupere le nombre d'images affiché
			if (isset($_GET["nbImg"])) {
				$this->nbImg = $_GET["nbImg"];
			} else {
				$this->nbImg = 2;
			}
			// Recupere la taille de l'image
			if (isset($_GET["size"])) {
				$this->data->size = $_GET["size"];
			} else {
				$this->data->size = 480;
			}
			$this->data->menu['Home'] = "index.php";
			$this->data->menu['A propos']="index.php?controller=home&action=aPropos";
			$this->data->menu['Voir photos']="index.php?controller=photo&action=first";
			$this->data->menu['First']="index.php?controller=photoMatrix&action=first&nbImg=".$this->nbImg;
			$this->data->count = $this->imageDAO->size();
			$this->data->content="photoMatrixView.php";

			$this->data->login = $_SESSION['login'];

		}


		// LISTE DES ACTIONS DE CE CONTROLEUR

		function prepView(){
			$this->data->menu['More']="index.php?controller=photoMatrix&action=more&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Less']="index.php?controller=photoMatrix&action=less&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Random'] = "index.php?controller=photoMatrix&action=randomImage&nbImg=".$this->nbImg;
			$this->data->categories = $this->imageDAO->getCategories();
			$this->data->imgId = $this->imgId;

		}

		function prepList($imgLst){
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				# Ajoute à imgMatrixURL
				#  0 : l'URL de l'image
				#  1 : l'URL de l'action lorsqu'on clique sur l'image : la visualiser seul
				$this->data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&imgId=$iId");
			}
		}

		// Action par défaut
		function index() {
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// affiche la vue viewPhotoMatrix avec les hpotos d'une catégorie
		function categorie() {
			$this->data->categorieAffichee=$_POST["categorie"];
			$imgLst=$this->imageDAO->getCategoryImages($_POST["categorie"]);

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = sizeof($imgLst);

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// affiche la vue viewPhotoMatrix avec la première image affichée et deux photos
		function first(){
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhotoMatrix avec les photo suivantes de la dernière photo affichée, si elles existent,
		// d'après l'id de la dernière photo affichée à l'appel de la fonction et le nombre de photos à afficher
		function next(){
			$this->imgId += $this->nbImg;
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhotoMatrix avec les photo précédentes de la première photo affichée, si elles existent,
		// d'après l'id de la première photo affichée à l'appel de la fonction et le nombre de photos à afficher
		function prev(){
			$this->imgId -= $this->nbImg;
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// affiche plus de photos
		function more(){
			$this->nbImg *= 2;

			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		//affiche moins de photos si nb de photos affichées > 1
		function less(){
			$this->nbImg /= 2;

			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function randomImage() {
			$firstImg = $this->imageDAO->getImage($this->imageDAO->getRandomImage());
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);
			$this->imgId = $firstImg->getId();

			$this->prepList($imgLst);
			$this->prepView();

			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

	}
?>
