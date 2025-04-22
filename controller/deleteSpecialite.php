<?php
include_once '../racine.php';
include_once RACINE.'/services/SpecialiteService.php';

extract($_GET);

$is = new SpecialiteService();
$is->delete($is->findById($id));

header("location:../index.php");