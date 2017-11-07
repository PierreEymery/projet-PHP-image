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

    function index() {
        $this->data->content = "connexionView.php";

        if (isset($_POST['login']) && !empty($_POST['login']) && !empty($_POST['password'])) {
            if (isset($_POST['connexion'])) {
                //$_POST['password'] = hash("sha256", $_POST['password']);
                //extract($_POST);
                $login = $_POST['login'];
                $password = $_POST['password'];
                $this->membreDAO->checkUser($login, $password);
            }
            if (isset($_POST['inscription'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $this->membreDAO->saveUser($login, $password);
            }
        } else {
            $champs = '<p><b>(Remplissez tous les champs pour vous connectez !)</b></p>';
        }
        require_once("view/mainView.php");
    }

}
