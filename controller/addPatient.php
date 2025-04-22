<?php

include_once '../racine.php';
include_once RACINE . '/services/PatientService.php';
include_once RACINE . '/classes/Patient.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    $patient = new Patient($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, password_hash($password, PASSWORD_DEFAULT));
    
    $ps = new PatientService();
    $ps->create($patient);

    header("Location: ../index.php");
}