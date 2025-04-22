<?php

include_once '../racine.php';
include_once RACINE . '/classes/User.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class UserService implements IDao {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO Utilisateur (nom, prenom, cin, email, telephone, sexe, dateNaissance, password) 
                  VALUES (:nom, :prenom, :cin, :email, :telephone, :sexe, :dateNaissance, :password)";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
                    ':nom' => $o->getNom(),
                    ':prenom' => $o->getPrenom(),
                    ':cin' => $o->getCin(),
                    ':email' => $o->getEmail(),
                    ':telephone' => $o->getTelephone(),
                    ':sexe' => $o->getSexe(),
                    ':dateNaissance' => $o->getDateNaissance(),
                    ':password' => $o->getPassword()
        ]);
    }

    public function delete($o) {
        $query = "DELETE FROM Utilisateur WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([':id' => $o->getId()]);
    }

    public function findAll() {
        $query = "SELECT * FROM Utilisateur";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        $users = [];

        while ($u = $req->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                    $u['nom'], $u['prenom'], $u['cin'], $u['email'], $u['telephone'], $u['sexe'], $u['dateNaissance'], $u['password']
            );
            $reflection = new ReflectionClass($user);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($user, $u['id']);
            $users[] = $user;
        }

        return $users;
    }

    public function findById($id) {
        $query = "SELECT * FROM Utilisateur WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':id' => $id]);
        $u = $req->fetch(PDO::FETCH_ASSOC);

        if ($u) {
            $user = new User(
                    $u['nom'], $u['prenom'], $u['cin'], $u['email'], $u['telephone'], $u['sexe'], $u['dateNaissance'], $u['password']
            );
            $reflection = new ReflectionClass($user);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($user, $u['id']);
            return $user;
        }

        return null;
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM Utilisateur WHERE email = :email";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([':email' => $email]);
        $u = $req->fetch(PDO::FETCH_ASSOC);

        if ($u) {
            $user = new User(
                    $u['nom'], $u['prenom'], $u['cin'], $u['email'], $u['telephone'], $u['sexe'], $u['dateNaissance'], $u['password']
            );
            $reflection = new ReflectionClass($user);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($user, $u['id']);
            return $user;
        }

        return null;
    }

    public function update($o) {
        $query = "UPDATE Utilisateur SET nom = :nom, prenom = :prenom, cin = :cin, email = :email, 
                  telephone = :telephone, sexe = :sexe, dateNaissance = :dateNaissance, password = :password 
                  WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        return $req->execute([
                    ':id' => $o->getId(),
                    ':nom' => $o->getNom(),
                    ':prenom' => $o->getPrenom(),
                    ':cin' => $o->getCin(),
                    ':email' => $o->getEmail(),
                    ':telephone' => $o->getTelephone(),
                    ':sexe' => $o->getSexe(),
                    ':dateNaissance' => $o->getDateNaissance(),
                    ':password' => $o->getPassword()
        ]);
    }

    public function getUserRole($userId) {
        $pdo = $this->connexion->getConnexion();

        $roles = ['admin', 'medecin', 'patient'];

        foreach ($roles as $role) {
            $stmt = $pdo->prepare("SELECT * FROM $role WHERE user_id = :id");
            $stmt->execute([':id' => $userId]);
            if ($stmt->fetch()) {
                return $role;
            }
        }

        return null;
    }

    public function findAllApi() {
        $query = "SELECT * FROM Utilisateur";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}