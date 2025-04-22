<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MedecinSpecialiteService
 *
 * @author hamza
 */
class MedecinSpecialiteService implements IDao {
    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO medecin_specialite (medecin_id, specialite_id) VALUES (:medecin_id, :specialite_id)";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':medecin_id' => $o->getMedecinId(),
            ':specialite_id' => $o->getSpecialiteId()
        ]);
    }

    public function delete($o) {
        $query = "DELETE FROM medecin_specialite WHERE medecin_id = :medecin_id AND specialite_id = :specialite_id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':medecin_id' => $o->getMedecinId(),
            ':specialite_id' => $o->getSpecialiteId()
        ]);
    }

    public function findAll() {
        $query = "SELECT * FROM medecin_specialite";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT * FROM medecin_specialite WHERE medecin_id = :medecin_id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':medecin_id' => $id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($o) {
        return false;
    }
}
