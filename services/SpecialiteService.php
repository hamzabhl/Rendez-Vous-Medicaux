<?php

include_once RACINE . '/classes/Specialite.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class SpecialiteService implements IDao {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO Specialite (nom) VALUES (:nom)";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
                    ':nom' => $o->getNom()
        ]);
    }

    public function delete($o) {
        $query = "DELETE FROM Specialite WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM Specialite";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        $specialites = [];

        while ($s = $req->fetch(PDO::FETCH_ASSOC)) {
            $specialites[] = new Specialite($s['id'], $s['nom']);
        }

        return $specialites;
    }

    public function findById($id) {
        $query = "SELECT * FROM Specialite WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        $s = $req->fetch(PDO::FETCH_ASSOC);

        return $s ? new Specialite($s['id'], $s['nom']) : null;
    }

    public function update($o) {
        $query = "UPDATE Specialite SET nom = :nom WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
                    ':id' => $o->getId(),
                    ':nom' => $o->getNom()
        ]);
    }

    public function findAllApi() {
        $query = "SELECT * FROM Specialite";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

}
