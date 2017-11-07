<?php

# Notion d'image

class User {

    private $id = 0;
    private $login = "";
    private $password = "";

    function __construct($id, $login, $password) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

}
