<?php

include_once '../racine.php';
include_once RACINE . '/classes/Specialite.php';
include_once RACINE . '/classes/Medecin.php';
include_once RACINE . '/services/MedecinService.php';

// Récupération des données
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$cin = $_POST['cin'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$sexe = $_POST['sexe'];
$dateNaissance = $_POST['dateNaissance'];
$password = $_POST['password'];
$adresse = $_POST['adresse'];
$numFix = $_POST['numFix'];
$specialite_id = $_POST['specialite_id'];

$specialite = new Specialite($specialite_id, "");

$medecin = new Medecin(
    $nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password,
    $adresse, $numFix, $specialite
);

$ms = new MedecinService();
$ms->create($medecin);

header('Location: ../index.php');