 <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/UserService.php';
    include_once RACINE . '/classes/User.php';
    create();
}

function create() {
    extract($_POST);
    $us = new UserService();

    $user = new User($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password);
    $success = $us->create($user);
}