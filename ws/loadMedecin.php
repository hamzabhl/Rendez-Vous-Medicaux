<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    include_once '../racine.php';
    include_once RACINE . '/service/MedecinService.php';
    loadAll();
}

function loadAll() {
    $ms = new MedecinService();
    header('Content-type: application/json');
    echo json_encode($ms->findAllApi());
}