<?php

include_once '../racine.php';
include_once RACINE.'/classes/Patient.php';
include_once RACINE.'/services/UserService.php';

if (isset($_GET['id'])) {
    $us = new UserService();
    $patient = $us->findById($_GET['id']);
    if ($patient) {
        $us->delete($patient);
    }
}

header("location:../views/Admin/Admin.php");