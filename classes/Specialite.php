<?php

class Specialite {

    private $id;
    private $nom;

    public function __construct($id, string $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    public function __toString() {
        return $this->nom;
    }

}