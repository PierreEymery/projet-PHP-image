<?php

  # Notion d'image
  class Image {
    private $url="";
    private $id=0;
    private $category="";
    private $comment="";
    private $totalNotes = 0;
    private $nbVotes = 0;

    function __construct($u=null,$id=null,$cat=null,$comment=null,$totalNotes=null,$nbVotes=null) {
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

    function getId(){
      return $this->id;
    }

    function getCat(){
      return $this->category;
    }

    function getComment(){
      return $this->comment;
    }

    function getTotalNotes() {
      return $this->totalNotes;
    }

    function getNbVotes() {
      return $this->nbVotes;
    }

    function getNote() {
      if ($this->getNbVotes() > 0) {
        return number_format($this->getTotalNotes()/$this->getNbVotes(), 1, '.', ',');
      } else {
        return null;
      }
    }

    function addNote($note) {
      $this->totalNotes += $note;
      $this->nbVotes++;
    }
  }


?>
