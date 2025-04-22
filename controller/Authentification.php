<?php

session_start();
include_once '../racine.php';
include_once RACINE . '/services/UserService.php';

$email = $_POST['email'];
$password = $_POST['password'];

$us = new UserService();
$user = $us->findByEmail($email);

if ($user && password_verify($password, $user->getPassword())) {
    $userId = $user->getId();
    $role = $us->getUserRole($userId);

    if ($role) {
        $_SESSION['user'] = $user;
        $_SESSION['role'] = $role;

        switch ($role) {
            case 'admin':
                header('Location: ../views/dashboard_admin.php');
                exit;
            case 'medecin':
                header('Location: ../medecin/dashboard_medecin.php');
                exit;
            case 'patient':
                header('Location: ../patient/dashboard_patient.php');
                exit;
        }
    } else {
        echo "<script>alert('Aucun rôle trouvé.'); window.location.href = '../admin/login.php';</script>";
    }
} else {
    echo "<script>alert('Identifiants incorrects'); window.location.href = '../login.php';</script>";
}