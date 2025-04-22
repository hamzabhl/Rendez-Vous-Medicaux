<?php

class MedecinSpecialite {
    private $medecinId;
    private $specialiteId;

    // Constructor
    public function __construct($medecinId, $specialiteId) {
        $this->medecinId = $medecinId;
        $this->specialiteId = $specialiteId;
    }

    // Getters
    public function getMedecinId() {
        return $this->medecinId;
    }

    public function getSpecialiteId() {
        return $this->specialiteId;
    }

    // Setters
    public function setMedecinId($medecinId) {
        $this->medecinId = $medecinId;
    }

    public function setSpecialiteId($specialiteId) {
        $this->specialiteId = $specialiteId;
    }
}

