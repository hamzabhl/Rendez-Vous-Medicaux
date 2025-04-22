<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    include_once '../racine.php';
    include_once RACINE . '/service/PatientService.php';
    loadAll();
}

function loadAll() {
    $ps = new PatientService();
    header('Content-type: application/json');
    echo json_encode($ps->findAllApi());
}