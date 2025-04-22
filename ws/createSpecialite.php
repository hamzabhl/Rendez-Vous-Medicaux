<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include_once '../racine.php';
    include_once RACINE.'/services/SpecialiteService.php';
    create();
}

function create(){
    extract($_POST);
    $ss = new SpecialiteService();
    $ss->create(new Specialite(1, $nom));
}