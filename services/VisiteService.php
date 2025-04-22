<?php

include_once 'Visite.php';
include_once 'Connexion.php';
include_once 'IDao.php';

class VisiteService implements IDao {
    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO visites (etat, heure, date, cout, type) VALUES (:etat, :heure, :date, :cout, :type)";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':etat' => $o->getEtat(),
            ':heure' => $o->getHeure(),
            ':date' => $o->getDate(),
            ':cout' => $o->getCout(),
            ':type' => $o->getType()
        ]);
    }

    public function delete($o) {
        $query = "DELETE FROM visites WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM visites";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT * FROM visites WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function update($o) {
        $query = "UPDATE visites SET etat = :etat, heure = :heure, date = :date, cout = :cout, type = :type WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':id' => $o->getId(),
            ':etat' => $o->getEtat(),
            ':heure' => $o->getHeure(),
            ':date' => $o->getDate(),
            ':cout' => $o->getCout(),
            ':type' => $o->getType()
        ]);
    }
}
