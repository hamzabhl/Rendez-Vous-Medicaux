<?php

include_once '../racine.php';
include_once RACINE . '/services/UserService.php';
include_once RACINE . '/services/MedecinService.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $ms = new MedecinService();
    $us = new UserService();
    $medecin = $ms->findById($id);

    if ($medecin) {
        $medecin->setIsConfirmed(1);
        $ms->approve($medecin);
    }
}

header('Location: ../views/Admin/Admin.php');
exit;