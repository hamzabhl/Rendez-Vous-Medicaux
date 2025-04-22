<?php

include_once 'Ordonnance.php';
include_once 'Connexion.php';
include_once 'IDao.php';

class OrdonnanceService implements IDao {
    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO ordonnances (libelle_medicament, dosage, duree, description) VALUES (:libelle_medicament, :dosage, :duree, :description)";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':libelle_medicament' => $o->getLibelleMedicament(),
            ':dosage' => $o->getDosage(),
            ':duree' => $o->getDuree(),
            ':description' => $o->getDescription()
        ]);
    }

    public function delete($o) {
        $query = "DELETE FROM ordonnances WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM ordonnances";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT * FROM ordonnances WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function update($o) {
        $query = "UPDATE ordonnances SET libelle_medicament = :libelle_medicament, dosage = :dosage, duree = :duree, description = :description WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':id' => $o->getId(),
            ':libelle_medicament' => $o->getLibelleMedicament(),
            ':dosage' => $o->getDosage(),
            ':duree' => $o->getDuree(),
            ':description' => $o->getDescription()
        ]);
    }
}
