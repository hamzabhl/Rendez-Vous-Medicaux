<?php

class User {

    protected $id;
    protected $nom;
    protected $prenom;
    protected $cin;
    protected $email;
    protected $telephone;
    protected $sexe;
    protected $dateNaissance;
    protected $password;

    public function __construct($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->cin = $cin;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->sexe = $sexe;
        $this->dateNaissance = $dateNaissance;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getCin() {
        return $this->cin;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setCin($cin) {
        $this->cin = $cin;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
}