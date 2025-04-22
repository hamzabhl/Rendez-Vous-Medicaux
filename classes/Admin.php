<?php

include_once 'User.php';

class Admin extends User {

    public function __construct($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password) {
        parent::__construct($nom, $prenom, $cin, $email, $telephone, $sexe, $dateNaissance, $password);
    }

}