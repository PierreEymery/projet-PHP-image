<?php
	require_once("image.php");
	# Le 'Data Access Object' d'un ensemble images
	class ImageDAO {

		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# A MODIFIER EN FONCTION DE VOTRE INSTALLATION
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# Chemin LOCAL où se trouvent les images
		private $path="model/IMG/";
		# Chemin URL où se trouvent les images
		const urlPath="http://localhost/projet-PHP-image/model/IMG/";

		# Tableau pour stocker tous les chemins des images
		private $imgEntry;

		# Contient la connexion à la base de données
		private $db;

		# Lecture récursive d'un répertoire d'images
		# Ce ne sont pas des objets qui sont stockes mais juste
		# des chemins vers les images.
		private function readDir($dir) {
			# build the full path using location of the image base
			$fdir=$this->path.$dir;
			if (is_dir($fdir)) {
				$d = opendir($fdir);
				while (($file = readdir($d)) !== false) {
					if (is_dir($fdir."/".$file)) {
						# This entry is a directory, just have to avoid . and .. or anything starts with '.'
						if (($file[0] != '.')) {
							# a recursive call
							$this->readDir($dir."/".$file);
						}
					} else {
						# a simple file, store it in the file list
						if (($file[0] != '.')) {
							$this->imgEntry[]="$dir/$file";
						}
					}
				}
			}
		}



		function __construct() {
			$dsn = 'sqlite:'.dirname(__FILE__).DIRECTORY_SEPARATOR.'baseDeDonneesImages.db'; // Data source name
			$user= 'www-data'; // Utilisateur
			$pass= ''; // Mot de passe
			try {
			   $this->db = new PDO($dsn, $user, $pass); //$db est un attribut privé d'ImageDAO
			} catch (PDOException $e) {
			   die ("Erreur : ".$e->getMessage());
			}
    	$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		# Retourne le nombre d'images référencées dans le DAO
		function size(): int {
			$s = $this->db->query('SELECT * FROM image');
			$all = $s->fetchAll(PDO::FETCH_ASSOC);
			return count($all);
		}

		# Retourne un objet image correspondant à l'identifiant
		function getImage($imgId): Image {
			if ($imgId > 0) {
				$s = $this->db->query('SELECT * FROM image WHERE id='.$imgId);
			}else{
				$imgId = 1;
				$s = $this->db->query('SELECT * FROM image WHERE id='.$imgId);
			}

			if ($s) {
				$img = $s->fetchAll(PDO::FETCH_ASSOC);
				return new Image(self::urlPath.$img[0]['path'],$img[0]['id'],$img[0]['category'],$img[0]['comment'],$img[0]['totalNotes'],$img[0]['nbVotes']);
			} else {
				print "Error in getImage. id=".$id."<br/>";
				$err= $this->db->errorInfo();
				print $err[2]."<br/>";
				die;
			}

		}


		# Retourne l'id d'une image au hazard
		function getRandomImage(): int {
			return rand(1, $this->size());
		}

		# Retourne l'objet de la premiere image
		function getFirstImage(): Image {
			return $this->getImage(1);
		}

		# Retourne l'image suivante d'une image
		function getNextImage(image $img): Image {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id+1);
			}
			return $img;
		}

		# Retourne l'image précédente d'une image
		function getPrevImage(image $img): Image {
			$id = $img->getId();
			if ($id < $this->size() && $id > 1) {
				$img = $this->getImage($id-1);http://localhost/image/model/imageDAO.php?test
			}
			return $img;
		}

		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		function jumpToImage(image $img,$nb): Image {
			$id = $img->getId();
			$newId = $id + $nb;

			if ($newId <= $this->size() && $newId > 0) {
				$img = $this->getImage($newId);
			}

			if ($newId < 0) {
				$img = $this->getFirstImage();
			}

			return $img;
		}

		# Retourne la liste des images consécutives à partir d'une image
		function getImageList(image $img,$nb): array {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			while ($id < $this->size() && $id < $max) {
				$res[] = $this->getImage($id);
				$id++;
			}
			return $res;
		}

		function getCategoryImages($cat): array {
			$imagesListe = array();
			$s = $this->db->query('SELECT * FROM image WHERE category="'.$cat.'"');
			if($s){
				$images = $s->fetchAll(PDO::FETCH_ASSOC);
				foreach ($images as $key => $value) {
					$imagesListe[$key] = new Image(self::urlPath.$value['path'],$value['id'],$value['category'],$value['comment'],$value['totalNotes'],$value['nbVotes']);
				}
			}
			// var_dump($imagesListe); die;
			return $imagesListe;
		}

		function getCategories(): array {
			$categories = array();
			$s = $this->db->query('SELECT DISTINCT category FROM image');
			if($s){
				$categories = $s->fetchAll(PDO::FETCH_ASSOC);

			}
			return $categories;
		}

		function updateCategorieImage($imgId, $newCat) {
			$s = $this->db->query('UPDATE image SET category="'.$newCat.'" WHERE id='.$imgId);
		}

		function updateCommentImage($imgId, $newComment) {
			$s = $this->db->query('UPDATE image SET comment="'.$newComment.'" WHERE id='.$imgId);
		}

		function saveFile($file, $categorie, $comment) {

			$q = $this->db->query('SELECT MAX(id) FROM image');

			$id = $q->fetch()[0] + 1;

			$imagesDir = "model/IMG/jons/uploads/";
			$targetFile = $imagesDir . basename($file["name"]);

			move_uploaded_file($file["tmp_name"], $targetFile);

			$s = $this->db->query('INSERT INTO image VALUES ('.$id.', "jons/uploads/'.$file['name'].'", "'.$categorie.'", "'.$comment.'", 0, 0)');

		}

	}

	# Test unitaire
	# Appeler le code PHP depuis le navigateur avec la variable test
	# Exemple : http://localhost/image/model/imageDAO.php?test
	if (isset($_GET["test"])) {
		echo "<H1>Test de la classe ImageDAO</H1>";
		$imgDAO = new ImageDAO();
		echo "<p>Creation de l'objet ImageDAO.</p>\n";
		echo "<p>La base contient ".$imgDAO->size()." images.</p>\n";
		$img = $imgDAO->getFirstImage("");
		echo "La premiere image est : ".$img->getURL()."</p>\n";
		# Affiche l'image
		echo "<img src=\"".$img->getURL()."\"/>\n";

	}


	?>
