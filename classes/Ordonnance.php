<?php

class Ordonnance {
    private $id;
    private $libelleMedicament;
    private $dosage;
    private $duree;
    private $description;

    function __construct(string $libelleMedicament, string $dosage, int $duree, string $description) {
        $this->libelleMedicament = $libelleMedicament;
        $this->dosage = $dosage;
        $this->duree = $duree;
        $this->description = $description;
    }

    public function getId() { return $this->id; }
    function getLibelleMedicament() { return $this->libelleMedicament; }
    function getDosage() { return $this->dosage; }
    function getDuree() { return $this->duree; }
    function getDescription() { return $this->description; }

    function setLibelleMedicament($libelleMedicament) { $this->libelleMedicament = $libelleMedicament; }
    function setDosage($dosage) { $this->dosage = $dosage; }
    function setDuree($duree) { $this->duree = $duree; }
    function setDescription($description) { $this->description = $description; }
}
