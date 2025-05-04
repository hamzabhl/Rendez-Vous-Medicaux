<?php

include_once '../racine.php';
include_once RACINE.'/classes/User.php';
include_once RACINE.'/services/UserService.php';

if (isset($_GET['id'])) {
    $us = new UserService();
    $user = $us->findById($_GET['id']);
    if ($user) {
        $us->delete($user);
    }
}

header("location:../views/test.php");