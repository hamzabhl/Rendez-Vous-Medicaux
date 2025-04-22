<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CertificatService
 *
 * @author hamza
 */
class CertificatService implements IDao {
    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO certificat (medecin_id, image_path) VALUES (:medecin_id, :image_path)";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':medecin_id' => $o->getMedecinId(),
            ':image_path' => $o->getImagePath()
        ]);
    }

    public function delete($o) {
        $query = "DELETE FROM certificat WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM certificat";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT * FROM certificat WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function update($o) {
        $query = "UPDATE certificat SET medecin_id = :medecin_id, image_path = :image_path WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
            ':id' => $o->getId(),
            ':medecin_id' => $o->getMedecinId(),
            ':image_path' => $o->getImagePath()
        ]);
    }
}

