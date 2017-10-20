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

		}


		// LISTE DES ACTIONS DE CE CONTROLEUR

		// Action par défaut
		function index() {
			$this->data->content="photoMatrixView.php";
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				# Ajoute à imgMatrixURL
				#  0 : l'URL de l'image
				#  1 : l'URL de l'action lorsqu'on clique sur l'image : la visualiser seul
				$this->data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&imgId=$iId");
			}

			$this->data->menu['More']="index.php?controller=photoMatrix&action=more&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Less']="index.php?controller=photoMatrix&action=less&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->imgId = $this->imgId;
			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// affiche la vue viewPhotoMatrix avec la première image affichée et deux photos
		function first(){
			$this->data->content="photoMatrixView.php";
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				# Ajoute à imgMatrixURL
				#  0 : l'URL de l'image
				#  1 : l'URL de l'action lorsqu'on clique sur l'image : la visualiser seul
				$this->data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&imgId=$iId");
			}

			$this->data->menu['More']="index.php?controller=photoMatrix&action=more&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Less']="index.php?controller=photoMatrix&action=less&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->imgId = $this->imgId;
			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhotoMatrix avec les photo suivantes de la dernière photo affichée, si elles existent,
		// d'après l'id de la dernière photo affichée à l'appel de la fonction et le nombre de photos à afficher
		function next(){
			$this->data->content="photoMatrixView.php";
			$this->imgId += $this->nbImg;
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				# Ajoute à imgMatrixURL
				#  0 : l'URL de l'image
				#  1 : l'URL de l'action lorsqu'on clique sur l'image : la visualiser seul
				$this->data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&imgId=$iId");
			}

			$this->data->menu['More']="index.php?controller=photoMatrix&action=more&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Less']="index.php?controller=photoMatrix&action=less&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->imgId = $this->imgId;
			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhotoMatrix avec les photo précédentes de la première photo affichée, si elles existent,
		// d'après l'id de la première photo affichée à l'appel de la fonction et le nombre de photos à afficher
		function prev(){
			$this->data->content="photoMatrixView.php";
			$this->imgId -= $this->nbImg;
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				# Ajoute à imgMatrixURL
				#  0 : l'URL de l'image
				#  1 : l'URL de l'action lorsqu'on clique sur l'image : la visualiser seul
				$this->data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&imgId=$iId");
			}

			$this->data->menu['More']="index.php?controller=photoMatrix&action=more&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Less']="index.php?controller=photoMatrix&action=less&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->imgId = $this->imgId;
			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhotoMatrix avec un nombre défini de photos sélectionnées aléatoirement
		function random(){

		}

		// affiche plus de photos
		function more(){
			$this->nbImg *= 2;

			$this->data->content="photoMatrixView.php";
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				# Ajoute à imgMatrixURL
				#  0 : l'URL de l'image
				#  1 : l'URL de l'action lorsqu'on clique sur l'image : la visualiser seul
				$this->data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&imgId=$iId");
			}

			$this->data->menu['More']="index.php?controller=photoMatrix&action=more&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Less']="index.php?controller=photoMatrix&action=less&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->imgId = $this->imgId;
			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		//affiche moins de photos si nb de photos affichées > 1
		function less(){
			$this->nbImg /= 2;

			$this->data->content="photoMatrixView.php";
			$firstImg = $this->imageDAO->getImage($this->imgId);
			$imgLst= $this->imageDAO->getImageList($firstImg,$this->nbImg);

			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				# Ajoute à imgMatrixURL
				#  0 : l'URL de l'image
				#  1 : l'URL de l'action lorsqu'on clique sur l'image : la visualiser seul
				$this->data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&imgId=$iId");
			}

			$this->data->menu['More']="index.php?controller=photoMatrix&action=more&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->menu['Less']="index.php?controller=photoMatrix&action=less&nbImg=".$this->nbImg."&imgId=".$this->imgId;
			$this->data->imgId = $this->imgId;
			$this->data->nbImg = $this->nbImg;

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

	}
?>
