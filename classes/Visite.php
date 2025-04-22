<?php

class Visite {
    private $id;
    private $etat;
    private $heure;
    private $date;
    private $cout;
    private $type;

    public function __construct(string $etat, string $heure, string $date, float $cout, string $type) {
        $this->etat = $etat;
        $this->heure = $heure;
        $this->date = $date;
        $this->cout = $cout;
        $this->type = $type;
    }

    function getId() { return $this->id; }
    function getEtat() { return $this->etat; }
    function getHeure() { return $this->heure; }
    function getDate() { return $this->date; }
    function getCout() { return $this->cout; }
    function getType() { return $this->type; }

    function setEtat($etat) { $this->etat = $etat; }
    function setHeure($heure) { $this->heure = $heure; }
    function setDate($date) { $this->date = $date; }
    function setCout($cout) { $this->cout = $cout; }
    function setType($type) { $this->type = $type; }
}
