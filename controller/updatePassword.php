<?php

include_once '../classes/User.php';
include_once '../services/UserService.php';

session_start();

// Accept only if role is 'patient' OR 'medecin'
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['patient', 'medecin'])) {
    header('Location: ../index.php');
    exit;
}

$user = $_SESSION['user'];

// Sécuriser les entrées
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmNewPassword = $_POST['confirmNewPassword'];

// Vérifier que le mot de passe actuel est correct
if (!password_verify($currentPassword, $user->getPassword())) {
    header('Location: ../views/error.php?error=invalid_current_password');
    exit;
}

// Vérifier que les nouveaux mots de passe correspondent
if ($newPassword !== $confirmNewPassword) {
    header('Location: ../views/error.php?error=passwords_do_not_match');
    exit;
}

// Mise à jour de l'objet
$user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));

$us = new UserService();
$us->update($user);

// Rafraîchir la session
$_SESSION['user'] = $user;

// Redirection
$redirectPath = $_SESSION['role'] === 'patient' ? '../views/Patient/Patient.php' : '../views/Medecin/Medecin.php';
header("Location: $redirectPath?updated=1");
exit;
