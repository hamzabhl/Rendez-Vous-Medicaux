<?php
include_once '../racine.php';
include_once RACINE.'/services/SpecialiteService.php';

extract($_POST);

$ss = new SpecialiteService();
$ss->create(new Specialite(1, $nom));

header("location:../views/dashboard_admin.php");