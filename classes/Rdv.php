<?php

class Rdv {
    private $id;
    private $date;
    private $etat;
    private $heureRdv;
    private $heurePriseRdv;

    public function __construct(string $date, string $etat, string $heureRdv, string $heurePriseRdv) {
        $this->date = $date;
        $this->etat = $etat;
        $this->heureRdv = $heureRdv;
        $this->heurePriseRdv = $heurePriseRdv;
    }

    function getId() { return $this->id; }
    function getDate() { return $this->date; }
    function getEtat() { return $this->etat; }
    function getHeureRdv() { return $this->heureRdv; }
    function getHeurePriseRdv() { return $this->heurePriseRdv; }

    function setDate($date) { $this->date = $date; }
    function setEtat($etat) { $this->etat = $etat; }
    function setHeureRdv($heureRdv) { $this->heureRdv = $heureRdv; }
    function setHeurePriseRdv($heurePriseRdv) { $this->heurePriseRdv = $heurePriseRdv; }
}
