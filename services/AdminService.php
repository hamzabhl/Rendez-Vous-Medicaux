<?php

include_once RACINE . '/classes/Admin.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class AdminService implements IDao {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($admin) {
        $pdo = $this->connexion->getConnexion();

        try {
            $pdo->beginTransaction();

            // Step 1: insert into Utilisateur
            $stmtUser = $pdo->prepare("
            INSERT INTO utilisateur (nom, prenom, cin, email, telephone, sexe, dateNaissance, password) 
            VALUES (:nom, :prenom, :cin, :email, :telephone, :sexe, :dateNaissance, :password)
        ");
            $stmtUser->execute([
                ':nom' => $admin->getNom(),
                ':prenom' => $admin->getPrenom(),
                ':cin' => $admin->getCin(),
                ':email' => $admin->getEmail(),
                ':telephone' => $admin->getTelephone(),
                ':sexe' => $admin->getSexe(),
                ':dateNaissance' => $admin->getDateNaissance(),
                ':password' => $admin->getPassword()
            ]);

            // Step 2: get the ID from utilisateur
            $userId = $pdo->lastInsertId();

            // Step 3: insert into admin using user_id as foreign key
            $stmtAdmin = $pdo->prepare("INSERT INTO admin (user_id) VALUES (:user_id)");
            $stmtAdmin->execute([':user_id' => $userId]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            throw new Exception("Admin creation failed: " . $e->getMessage());
        }
    }

    public function delete($o) {
        $query = "DELETE FROM Admin WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM Admin a JOIN Utilisateur u ON a.user_id = u.id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        $admins = [];

        while ($a = $req->fetch(PDO::FETCH_ASSOC)) {
            $admin = new Admin(
                    $a['nom'], $a['prenom'], $a['cin'], $a['email'], $a['telephone'], $a['sexe'], $a['dateNaissance'], $a['password']
            );
            $reflection = new ReflectionClass($admin);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($admin, $a['id']);
            $admins[] = $admin;
        }

        return $admins;
    }

    public function findById($id) {
        $query = "SELECT * FROM Admin WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        $a = $req->fetch(PDO::FETCH_ASSOC);

        return $a ? new Specialite($a['id'], $a['nom']) : null;
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
        $query = "SELECT * FROM Admin a JOIN Utilisateur u ON a.user_id = u.id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

}