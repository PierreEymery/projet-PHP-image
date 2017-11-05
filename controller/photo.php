<?php
	require_once("model/imageDAO.php");
	require_once("model/data.php");

	class Photo {

		protected $imageDAO;
		protected $imgId, $size, $nbImg, $zoom; //ce qui est récupéré dans l'URl
		protected $data;												//ce qui est généré par le controller et envoyé à la vue

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
			// Recupere la taille de l'image
			if (isset($_GET["size"])) {
				$this->data->size = $_GET["size"];
			} else {
				$this->data->size = 480;
			}
			// Recupere le nombre d'images affiché
			if (isset($_GET["nbImg"])) {
				$this->nbImg = $_GET["nbImg"];
			} else {
				$this->nbImg = 1;
			}
			//Recupere le niveau de zoom
			if (isset($_GET["zoom"])) {
				$this->zoom = $_GET["zoom"];
			} else {
				$this->zoom = 1;
			}

			$this->data->menu['Home']="index.php";
			$this->data->menu['A propos']="index.php?controller=home&action=aPropos";
			$this->data->menu['Voir photos']="index.php?controller=photo&action=first";
			$this->data->menu['Random']="index.php?controller=photo&action=random&size=".$this->data->size;

		}

		// LISTE DES ACTIONS DE CE CONTROLEUR

		// Action par défaut
		function index() {
			$this->data->content="photoView.php";
			$this->img=$this->imageDAO->getImage($this->imgId);
			$this->imgId = $this->img->getId();

			$this->data->menu['Zoom +']="index.php?controller=photo&action=zoom&zoom=1.2&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['Zoom -']="index.php?controller=photo&action=zoom&zoom=0.8&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['More']="index.php?controller=photoMatrix&imgId=".$this->imgId;

			$this->data->categories = $this->imageDAO->getCategories();

			$this->data->imgId=$this->imgId;
			$this->data->imgCat=$this->img->getCat();
			$this->data->imgURL=$this->img->getURL();
			$this->data->imgComment=$this->img->getComment();
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// affiche la vue viewPhoto avec la première image affichée
		function first(){
			$this->data->content="photoView.php";
			$this->img=$this->imageDAO->getFirstImage();
			$this->imgId = $this->img->getId();

			$this->data->menu['Zoom +']="index.php?controller=photo&action=zoom&zoom=1.2&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['Zoom -']="index.php?controller=photo&action=zoom&zoom=0.8&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['More']="index.php?controller=photoMatrix&imgId=".$this->imgId;

			$this->data->categories = $this->imageDAO->getCategories();

			$this->data->imgId=$this->imgId;
			$this->data->imgCat=$this->img->getCat();
			$this->data->imgURL=$this->img->getURL();
			$this->data->imgComment=$this->img->getComment();
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhoto avec la photo suivante affichée, si elle existe, d'après l'id de la photo affichée à l'appel de la fonction
		function next(){
			$this->data->content="photoView.php";
			$prevImg =$this->imageDAO->getImage($this->imgId);
			$this->img=$this->imageDAO->getNextImage($prevImg);
			$this->imgId = $this->img->getId();

			$this->data->categories = $this->imageDAO->getCategories();

			$this->data->menu['Zoom +']="index.php?controller=photo&action=zoom&zoom=1.2&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['Zoom -']="index.php?controller=photo&action=zoom&zoom=0.8&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['More']="index.php?controller=photoMatrix&imgId=".$this->imgId;

			$this->data->imgId=$this->imgId;
			$this->data->imgCat=$this->img->getCat();
			$this->data->imgURL=$this->img->getURL();
			$this->data->imgComment=$this->img->getComment();
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhoto avec la photo précédente affichée, si elle existe, d'après l'id de la photo affichée à l'appel de la fonction
		function prev(){
			$this->data->content="photoView.php";
			$nextImg =$this->imageDAO->getImage($this->imgId);
			$this->img=$this->imageDAO->getPrevImage($nextImg);
			$this->imgId = $this->img->getId();

			$this->data->categories = $this->imageDAO->getCategories();

			$this->data->menu['Zoom +']="index.php?controller=photo&action=zoom&zoom=1.2&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['Zoom -']="index.php?controller=photo&action=zoom&zoom=0.8&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['More']="index.php?controller=photoMatrix&imgId=".$this->imgId;

			$this->data->imgId=$this->imgId;
			$this->data->imgCat=$this->img->getCat();
			$this->data->imgURL=$this->img->getURL();
			$this->data->imgComment=$this->img->getComment();
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhoto avec une photo sélectionnée aléatoirement
		function random(){
			$this->data->content="photoView.php";
			$this->img =$this->imageDAO->getImage($this->imageDAO->getRandomImage());
			$this->imgId = $this->img->getId();

			$this->data->categories = $this->imageDAO->getCategories();

			$this->data->menu['Zoom +']="index.php?controller=photo&action=zoom&zoom=1.2&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['Zoom -']="index.php?controller=photo&action=zoom&zoom=0.8&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['More']="index.php?controller=photoMatrix&imgId=".$this->imgId;

			$this->data->imgId=$this->imgId;
			$this->data->imgCat=$this->img->getCat();
			$this->data->imgURL=$this->img->getURL();
			$this->data->imgComment=$this->img->getComment();
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		// renvoie la vue viewPhoto avec la photo zoomée ou dézoomée selon la valeur du paramètre zoom
		function zoom(){
			$this->data->content="photoView.php";
			$this->img =$this->imageDAO->getImage($this->imgId);
			$this->data->size *= $this->zoom;
			$this->imgId = $this->img->getId();

			$this->data->categories = $this->imageDAO->getCategories();

			$this->data->menu['Zoom +']="index.php?controller=photo&action=zoom&zoom=1.2&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['Zoom -']="index.php?controller=photo&action=zoom&zoom=0.8&imgId=".$this->imgId."&size=".$this->data->size;
			$this->data->menu['More']="index.php?controller=photoMatrix&imgId=".$this->imgId;

			$this->data->imgId=$this->imgId;
			$this->data->imgCat=$this->img->getCat();
			$this->data->imgURL=$this->img->getURL();
			$this->data->imgComment=$this->img->getComment();

			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}
	}
?>
