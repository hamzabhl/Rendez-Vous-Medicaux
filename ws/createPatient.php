 <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/services/PatientService.php';
    include_once RACINE . '/classes/Patient.php';
    create();
}

function create() {
    extract($_POST);
    $ps = new PatientService();

    $patient = new Patient($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password);
    $success = $ps->create($patient);
}