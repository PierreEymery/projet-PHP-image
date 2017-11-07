<?php

require_once("membre.php");

class MembreDAO {
    # Contient la connexion à la base de données

    private $db;

    function __construct() {
        $dsn = 'sqlite:' . dirname(__FILE__) . DIRECTORY_SEPARATOR . 'baseDeDonneesImages.db'; // Data source name
        $user = 'www-data'; // Utilisateur
        $pass = ''; // Mot de passe
        try {
            $this->db = new PDO($dsn, $user, $pass); //$db est un attribut privé d'ImageDAO
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function getMembre($user_id): User {
        if (isset($user_id)) {
            $s = $this->db->query('SELECT * FROM membre WHERE id=' . $user_id);
        } else {
            var_dump('Il n\'y a pas de membre');
        }
    }

    function saveUser($login, $password) {
        try {
            $req = 'INSERT INTO membre (login,password) VALUES ("' . $login . '","' . $password . '")';
            $res = $this->db->query($req);
        } catch (PDOException $Exception) {
            var_dump($req);
            var_dump($Exception);
            var_dump($this->db->errorInfo());
        }
        if ($res == FALSE) {
            var_dump($req);
            var_dump($this->db->errorInfo());
            exit(1);
        }
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
    }

    function checkUser($login, $password) {
        // on recupére le password de la table qui correspond au login du visiteur
        $sql = "select password from membre where login='" . $login . "'";
        $req = $this->db->query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

        //$data = mysql_fetch_assoc($req);
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        if ($data[0]['password'] != $password) {
            echo '<div class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>Oh Non !</strong> Mauvais login / password. Merci de recommencer !
                </div>';
        } else {
            $_SESSION['login'] = $login;
            echo '<div class="alert alert-dismissable alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Yes !</strong> Vous etes bien logué, Redirection dans 5 secondes ! <meta http-equiv="refresh" content="5; URL=index.php">
                  </div>';
        }
    }

}
