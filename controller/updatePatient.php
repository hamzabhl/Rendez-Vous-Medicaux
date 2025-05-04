<?php
include_once '../classes/User.php';
include_once '../classes/Patient.php'; // nécessaire pour unserialize()

include_once '../services/PatientService.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'patient') {
    header('Location: ../index.php');
    exit;
}

$patient = $_SESSION['user'];

// Sécuriser les entrées
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];

// Mise à jour de l'objet
$patient->setNom($nom);
$patient->setPrenom($prenom);
$patient->setEmail($email);
$patient->setTelephone($telephone);

// Mise à jour en base
$ps = new PatientService();
$ps->update($patient);

// Rafraîchir la session
$_SESSION['user'] = $patient;

// Rediriger vers le tableau de bord
header('Location: ../views/Patient/Patient.php?updated=1');
exit;
