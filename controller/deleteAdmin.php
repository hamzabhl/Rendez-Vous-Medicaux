<?php

include_once '../racine.php';
include_once RACINE.'/classes/Admin.php';
include_once RACINE.'/services/UserService.php';

if (isset($_GET['id'])) {
    $us = new UserService();
    $admin = $us->findById($_GET['id']);
    if ($admin) {
        $us->delete($admin);
    }
}

header("location:../views/test.php");