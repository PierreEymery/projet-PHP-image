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
    function getURL(): string {
		return $this->url;
    }

    function getId(): int{
      return $this->id;
    }

    function getCat(): string {
      return $this->category;
    }

    function getComment(): string {
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

    function addNote($note): void {
      $this->totalNotes += $note;
      $this->nbVotes++;
    }
  }


?>
