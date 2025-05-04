<?php

include_once __DIR__ . '/../racine.php';
include_once RACINE . '/classes/Patient.php';
include_once RACINE . '/classes/User.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class PatientService implements IDao {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($patient) {
        $pdo = $this->connexion->getConnexion();

        try {
            $pdo->beginTransaction();

            // Step 1: insert into Utilisateur
            $stmtPatient = $pdo->prepare("
            INSERT INTO utilisateur (nom, prenom, cin, email, telephone, sexe, dateNaissance, password) 
            VALUES (:nom, :prenom, :cin, :email, :telephone, :sexe, :dateNaissance, :password)
        ");
            $stmtPatient->execute([
                ':nom' => $patient->getNom(),
                ':prenom' => $patient->getPrenom(),
                ':cin' => $patient->getCin(),
                ':email' => $patient->getEmail(),
                ':telephone' => $patient->getTelephone(),
                ':sexe' => $patient->getSexe(),
                ':dateNaissance' => $patient->getDateNaissance(),
                ':password' => $patient->getPassword()
            ]);

            // Step 2: get the ID from utilisateur
            $userId = $pdo->lastInsertId();

            // Step 3: insert into admin using user_id as foreign key
            $stmtPatient = $pdo->prepare("INSERT INTO Patient (user_id) VALUES (:user_id)");
            $stmtPatient->execute([':user_id' => $userId]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            throw new Exception("Patient creation failed: " . $e->getMessage());
        }
    }

    public function delete($o) {
        $query = "DELETE FROM Patient WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM Patient p JOIN Utilisateur u ON p.user_id = u.id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        $patients = [];

        while ($p = $req->fetch(PDO::FETCH_ASSOC)) {
            $patient = new Patient(
                    $p['nom'], $p['prenom'], $p['cin'], $p['email'], $p['telephone'], $p['sexe'], $p['dateNaissance'], $p['password']
            );
            $reflection = new ReflectionClass($patient);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($patient, $p['id']);
            $patients[] = $patient;
        }

        return $patients;
    }

    public function findById($id) {
        $query = "SELECT * FROM Patient WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        $p = $req->fetch(PDO::FETCH_ASSOC);

        return $p ? new Patient(
                $p['nom'], $p['prenom'], $p['cin'], $p['email'], $p['telephone'], $p['sexe'], $p['dateNaissance'], $p['password']
                ) : null;
    }

//    public function update($o) {
//        $query = "UPDATE Specialite SET nom = :nom WHERE id = :id";
//        $req = $this->connexion->getConnexion()->prepare($query);
//        return $req->execute([
//                    ':id' => $o->getId(),
//                    ':nom' => $o->getNom()
//        ]);
//    }

    public function update($patient) {
        $query = "UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
                    ':nom' => $patient->getNom,
                    ':prenom' => $patient->getPrenom(),
                    ':email' => $patient->getEmail(),
                    ':telephone' => $patient->getTelephone(),
                    ':id' => $patient->getId()
        ]);
    }

    public function findAllApi() {
        $query = "SELECT * FROM Patient p JOIN Utilisateur u ON p.user_id = u.id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

}
