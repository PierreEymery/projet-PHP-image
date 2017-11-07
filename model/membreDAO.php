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

        // renvoi code retour vers controleur

        if ($data) {
          if ($data[0]['password'] != $password) {
              return 0;
          } else {
              $_SESSION['login'] = $login;
              return 1;
          }
        }
    }

}
