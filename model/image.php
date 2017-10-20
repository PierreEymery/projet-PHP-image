<?php

  # Notion d'image
  class Image {
    private $url="";
    private $id=0;
    private $category="";
    private $comment="";

    function __construct($u,$id,$cat,$comment) {
      $this->url = $u;
      $this->id = $id;
      $this->category = $cat;
      $this->comment = $comment;
    }

    # Retourne l'URL de cette image
    function getURL() {
		return $this->url;
    }

    function getId() {
      return $this->id;
    }

    function getCat() {
      return $this->category;
    }

    function getComment() {
      return $this->comment;
    }
  }


?>
