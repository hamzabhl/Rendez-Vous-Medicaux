<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    include_once '../racine.php';
    include_once RACINE . '/service/UserService.php';
    loadAll();
}

function loadAll() {
    $us = new UserService();
    header('Content-type: application/json');
    echo json_encode($us->findAllApi());
}