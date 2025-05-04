<?php

include_once '../racine.php';
include_once RACINE.'/services/UserService.php';

extract($_POST);

$us = new UserService();
$user = new User($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password);
$us->create($user);

header("location:../views/test.php");