<?php

session_start();
include_once '../racine.php';
include_once RACINE . '/services/UserService.php';
include_once RACINE . '/services/MedecinService.php';

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
                header('Location: ../views/admin/Admin.php');
                exit;
            case 'medecin':
                $ms = new MedecinService();
                $medecin = $ms->findById($user->getId());
                if ($medecin && $medecin->getIsConfirmed() === 1) {
                    header('Location: ../views/Medecin/Medecin.php');
                    exit;
                } else {
//                    echo "<script>alert('Votre compte est en attente de confirmation.'); window.location.href = '../views/login.php';</script>";
//                    exit;
                    header('Location: ../views/Login.php?error=2');
                    exit;
                }
            case 'patient':
                header('Location: ../views/Patient/Patient.php');
                exit;
        }
    } else {
        echo "<script>alert('Aucun rôle trouvé.'); window.location.href = '../views/login.php';</script>";
    }
} else {
    header('Location: ../views/Login.php?error=1');
    exit;
}