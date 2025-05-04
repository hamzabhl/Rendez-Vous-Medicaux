<?php

include_once '../racine.php';
include_once RACINE.'/classes/Medecin.php';
include_once RACINE.'/services/UserService.php';

if (isset($_GET['id'])) {
    $us = new UserService();
    $medecin = $us->findById($_GET['id']);
    if ($medecin) {
        $us->delete($medecin);
    }
}

header("location:../views/Admin/Admin.php");