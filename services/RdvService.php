<?php

include_once 'Rdv.php';
include_once 'Connexion.php';
include_once 'IDao.php';

class RdvService implements IDao {
    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO rdvs (date, etat, heure_rdv, heure_prise_rdv) VALUES (:date, :etat, :heure_rdv, :heure_prise_rdv)";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':date' => $o->getDate(),
            ':etat' => $o->getEtat(),
            ':heure_rdv' => $o->getHeureRdv(),
            ':heure_prise_rdv' => $o->getHeurePriseRdv()
        ]);
    }

    public function delete($o) {
        $query = "DELETE FROM rdvs WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM rdvs";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT * FROM rdvs WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function update($o) {
        $query = "UPDATE rdvs SET date = :date, etat = :etat, heure_rdv = :heure_rdv, heure_prise_rdv = :heure_prise_rdv WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':id' => $o->getId(),
            ':date' => $o->getDate(),
            ':etat' => $o->getEtat(),
            ':heure_rdv' => $o->getHeureRdv(),
            ':heure_prise_rdv' => $o->getHeurePriseRdv()
        ]);
    }
}
