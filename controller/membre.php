<?php

require_once("model/membreDAO.php");
require_once("model/data.php");

class Membre {

    protected $membreDAO;
    protected $userId, $login;
    protected $data;

    function __construct() {
        $this->membreDAO = new MembreDAO();
        $this->data = new Data();
        if (isset($_POST['user_id'])) {
            $this->userId = $_POST["user_id"];
        } else {
            $this->userId = 0;
        }
        if (isset($_POST['login'])) {
            $this->login = $_POST['login'];
        } else {
            $this->login = 'John Doe';
        }
        if (isset($_POST['password'])) {
            $this->password = $_POST['password'];
        } else {
            $this->password = 'mdp';
        }
    }

    // prépare le message affiché lors de la tentative de connexion, selon le résultat
    function prepMessage($retour){
      if ($retour == 0) {
        $this->data->message = '<div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Oh Non !</strong> Mauvais login / password. Merci de recommencer !
            </div>';
      }elseif ($retour == 1) {
        $this->data->message = '<div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Yes !</strong> Vous etes bien logué, Redirection dans 5 secondes ! <meta http-equiv="refresh" content="5; URL=index.php">
              </div>';
      }
    }

    // affiche la vue de connexion ConnexionView
    function index() {
        $this->data->content = "connexionView.php";

        if (isset($_POST['login']) && !empty($_POST['login']) && !empty($_POST['password'])) {
            if (isset($_POST['connexion'])) {
                //$_POST['password'] = hash("sha256", $_POST['password']);
                //extract($_POST);
                $login = $_POST['login'];
                $password = $_POST['password'];
                $retour = $this->membreDAO->checkUser($login, $password);
                $this->prepMessage($retour);
            }
            if (isset($_POST['inscription'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $retour = $this->membreDAO->saveUser($login, $password);
                $this->prepMessage($retour);

            }
        } else {
            $champs = '<p><b>(Remplissez tous les champs pour vous connectez !)</b></p>';
        }
        require_once("view/mainView.php");
    }

}
