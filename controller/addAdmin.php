<?php

include_once '../racine.php';
include_once RACINE . '/services/AdminService.php';
include_once RACINE . '/classes/Admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    $admin = new Admin($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, password_hash($password, PASSWORD_DEFAULT));
    
    $adminService = new AdminService();
    $adminService->create($admin);

    header("Location: ../test.php");
}