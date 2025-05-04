<?php

include_once '../services/MedecinService.php';
header('Content-Type: application/json');

if (!isset($_GET['query'])) {
    echo json_encode([]);
    exit;
}

$query = strtolower(trim($_GET['query']));
$ms = new MedecinService();
$results = [];

foreach ($ms->findAll() as $medecin) {
    $specialite = $medecin->getSpecialite() ? $medecin->getSpecialite()->getNom() : '';
    if (
        str_contains(strtolower($medecin->getNom()), $query) ||
        str_contains(strtolower($medecin->getPrenom()), $query) ||
        str_contains(strtolower($specialite), $query)
    ) {
        $results[] = [
            'nom' => $medecin->getNom(),
            'prenom' => $medecin->getPrenom(),
            'email' => $medecin->getEmail(),
            'specialite' => $specialite
        ];
    }
}

echo json_encode($results);