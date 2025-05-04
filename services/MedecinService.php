<?php

include_once __DIR__ . '/../racine.php';
include_once RACINE . '/classes/Medecin.php';
include_once RACINE . '/classes/Specialite.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class MedecinService implements IDao {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $pdo = $this->connexion->getConnexion();

        try {
            $pdo->beginTransaction();

            // Step 1: insert into Utilisateur
            $stmtUser = $pdo->prepare("
                INSERT INTO utilisateur (nom, prenom, cin, email, telephone, sexe, dateNaissance, password) 
                VALUES (:nom, :prenom, :cin, :email, :telephone, :sexe, :dateNaissance, :password)
            ");
            $stmtUser->execute([
                ':nom' => $o->getNom(),
                ':prenom' => $o->getPrenom(),
                ':cin' => $o->getCin(),
                ':email' => $o->getEmail(),
                ':telephone' => $o->getTelephone(),
                ':sexe' => $o->getSexe(),
                ':dateNaissance' => $o->getDateNaissance(),
                ':password' => $o->getPassword()
            ]);

            $userId = $pdo->lastInsertId();

            // Step 2: insert into Medecin
            $stmtMedecin = $pdo->prepare("
                INSERT INTO Medecin (user_id, adresse, numFix, specialite_id, is_confirmed) 
                VALUES (:user_id, :adresse, :numFix, :specialite_id, :is_confirmed)
            ");
            $stmtMedecin->execute([
                ':user_id' => $userId,
                ':adresse' => $o->getAdresse(),
                ':numFix' => $o->getNumFix(),
                ':specialite_id' => $o->getSpecialite()->getId(),
                ':is_confirmed' => $o->getIsConfirmed()
            ]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            throw new Exception("Medecin creation failed: " . $e->getMessage());
        }
    }

    public function delete($o) {
        $query = "DELETE FROM Medecin WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT 
                    u.id AS medecin_id, u.nom, u.prenom, u.cin, u.email, u.telephone, u.sexe, u.dateNaissance, u.password,
                    m.adresse, m.numFix, m.specialite_id, m.is_confirmed,
                    s.nom AS specialite_nom
                    FROM Medecin m
                    JOIN Utilisateur u ON m.user_id = u.id
                    JOIN Specialite s ON m.specialite_id = s.id";

        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        $medecins = [];

        while ($m = $req->fetch(PDO::FETCH_ASSOC)) {
            $specialite = new Specialite($m['specialite_id'], $m['specialite_nom']);

            $medecin = new Medecin(
                    $m['nom'], $m['prenom'], $m['cin'], $m['email'], $m['telephone'], $m['sexe'], $m['dateNaissance'], $m['password'], $m['adresse'], $m['numFix'], $specialite
            );
            $medecin->setIsConfirmed($m['is_confirmed']);

            // Attribuer l'id
            $reflection = new ReflectionClass($medecin);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($medecin, $m['medecin_id']);

            $medecins[] = $medecin;
        }

        return $medecins;
    }

    public function findById($id) {
        $query = "SELECT 
                u.id AS medecin_id, u.nom, u.prenom, u.cin, u.email, u.telephone, u.sexe, u.dateNaissance, u.password,
                m.adresse, m.numFix, m.specialite_id, m.is_confirmed,
                s.nom AS specialite_nom
              FROM Medecin m
              JOIN Utilisateur u ON m.user_id = u.id
              JOIN Specialite s ON m.specialite_id = s.id
              WHERE m.user_id = :id";  // <= correction ici aussi

        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        $m = $req->fetch(PDO::FETCH_ASSOC);

        if (!$m)
            return null;

        $specialite = new Specialite($m['specialite_id'], $m['specialite_nom']);

        $medecin = new Medecin(
                $m['nom'], $m['prenom'], $m['cin'], $m['email'], $m['telephone'], $m['sexe'], $m['dateNaissance'], $m['password'], $m['adresse'], $m['numFix'], $specialite
        );
        $medecin->setIsConfirmed($m['is_confirmed']);

        // Attribuer l’ID (nécessaire pour update)
        $reflection = new ReflectionClass($medecin);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($medecin, $m['medecin_id']);  // <= car on l'a sélectionné !

        return $medecin;
    }

    public function update($o) {
        $pdo = $this->connexion->getConnexion();

        try {
            $pdo->beginTransaction();

            // 1. Mise à jour dans la table utilisateur
            $queryUser = "UPDATE utilisateur 
                      SET email = :email, telephone = :telephone 
                      WHERE id = :id";
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->execute([
                ':email' => $o->getEmail(),
                ':telephone' => $o->getTelephone(),
                ':id' => $o->getId()
            ]);

            // 2. Mise à jour dans la table medecin
            $queryMedecin = "UPDATE medecin 
                         SET adresse = :adresse, numFix = :numFix, is_confirmed = :is_confirmed 
                         WHERE user_id = :id";
            $stmtMedecin = $pdo->prepare($queryMedecin);
            $stmtMedecin->execute([
                ':adresse' => $o->getAdresse(),
                ':numFix' => $o->getNumFix(),
                ':is_confirmed' => $o->getIsConfirmed(),
                ':id' => $o->getId()
            ]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            throw new Exception("Erreur lors de la mise à jour du médecin : " . $e->getMessage());
        }
    }

    public function approve($medecin) {
        $query = "UPDATE Medecin SET is_confirmed = :is_confirmed WHERE user_id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
                    ':is_confirmed' => $medecin->getIsConfirmed(), // <-- pas `$o`
                    ':id' => $medecin->getId()
        ]);
    }

    public function findAllApi() {
        $query = "SELECT m.id AS medecin_id, u.nom, u.prenom, s.nom AS specialite 
                  FROM Medecin m 
                  JOIN Utilisateur u ON m.user_id = u.id 
                  JOIN Specialite s ON m.specialite_id = s.id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}