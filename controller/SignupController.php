<?php

session_start();
include_once '../services/MedecinService.php';
include_once '../services/PatientService.php';
include_once '../classes/Specialite.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $role = $_POST['role'];

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($role === 'medecin') {
        $adresse = $_POST['adresse'];
        $numFix = $_POST['numFix'];
        $specialiteId = $_POST['specialite_id'];

        // Here we assume SpecialiteService is available to fetch object by name
        include_once '../services/SpecialiteService.php';
        $ss = new SpecialiteService();
        $specialiteObj = $ss->findById($specialiteId); // or findById if it's an ID

        if (!$specialiteObj) {
            echo $specialiteObj->getNom();
            die("Erreur : spécialité invalide");
        }

        $medecin = new Medecin($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password, $adresse, $numFix, $specialiteObj);

        // 🔥 Ajouter cette ligne pour éviter le NULL
        $medecin->setIsConfirmed(0);

        $ms = new MedecinService();
        $ms->create($medecin);

        $_SESSION['message'] = "Inscription médecin réussie. En attente de confirmation.";
        header("Location: ../views/login.php");
        exit;
    }

    if ($role === 'patient') {
        $patient = new Patient($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password);

        $ps = new PatientService();
        $ps->create($patient);

        $_SESSION['message'] = "Inscription patient réussie.";
        header("Location: ../views/login.php");
        exit;
    }

    die("Rôle invalide.");
} else {
    header("Location: ../views/signup.php");
    exit;
}