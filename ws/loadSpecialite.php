<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/services/SpecialiteService.php';
    loadAll();
}

function loadAll() {
    $ss = new SpecialiteService();
    header('Content-type: application/json');
    echo json_encode($ss->findAllApi());
}
