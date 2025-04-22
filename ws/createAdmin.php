 <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/services/AdminService.php';
    include_once RACINE . '/classes/Admin.php';
    create();
}

function create() {
    extract($_POST);
    $as = new AdminService();

    $admin = new Admin($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password);
    $success = $as->create($admin);
}