<?php

  # Notion d'image
  class Image {
    private $url="";
    private $id=0;
    private $category="";
    private $comment="";
    private $totalNotes = 0;
    private $nbVotes = 0;

    function __construct($u,$id,$cat,$comment,$totalNotes,$nbVotes) {
      $this->url = $u;
      $this->id = $id;
      $this->category = $cat;
      $this->comment = $comment;
      $this->totalNotes = $totalNotes;
      $this->nbVotes = $nbVotes;
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

    function getTotalVotes() {
      return $this->totalVotes;
    }

    function getNbVotes() {
      return $this->nbVotes;
    }

    function getNote() {
      return $this->getTotalVotes()/$this->getNbVotes();
    }
  }


?>
