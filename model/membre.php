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

    function getId(): int {
        return $this->id;
    }

    function getLogin(): string {
        return $this->login;
    }

    function getPassword(): string {
        return $this->password;
    }

}
