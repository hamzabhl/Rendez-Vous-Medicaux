<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificat
 *
 * @author hamza
 */

class Certificat {
    private $id;
    private $medecinId;
    private $imagePath;

    // Constructor
    public function __construct($id = null, $medecinId, $imagePath) {
        $this->id = $id;
        $this->medecinId = $medecinId;
        $this->imagePath = $imagePath;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getMedecinId() {
        return $this->medecinId;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setMedecinId($medecinId) {
        $this->medecinId = $medecinId;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }
}

