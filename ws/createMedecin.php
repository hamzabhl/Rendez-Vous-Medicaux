<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/services/MedecinService.php';
    include_once RACINE . '/classes/Medecin.php';
    create();
}

function create() {
    extract($_POST);
    $ms = new MedecinService();

    $medecin = new Medecin($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password, $ville, $adresse, $numFix, $specialite);
    $success = $ms->create($medecin);
}