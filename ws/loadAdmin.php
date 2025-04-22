<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    include_once '../racine.php';
    include_once RACINE . '/service/AdminService.php';
    loadAll();
}

function loadAll() {
    $as = new AdminService();
    header('Content-type: application/json');
    echo json_encode($as->findAllApi());
}