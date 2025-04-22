<?php

require_once 'User.php';
require_once 'Specialite.php';

class Medecin extends User {

    private $adresse;
    private $numFix;
    private $specialite; // objet Specialite

    public function __construct($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password, $adresse, $numFix, Specialite $specialite) {
        parent::__construct($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password);
        $this->adresse = $adresse;
        $this->numFix = $numFix;
        $this->specialite = $specialite;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getNumFix() {
        return $this->numFix;
    }

    public function setNumFix($numFix) {
        $this->numFix = $numFix;
    }

    public function getSpecialite() {
        return $this->specialite;
    }

    public function setSpecialite(Specialite $specialite) {
        $this->specialite = $specialite;
    }

}