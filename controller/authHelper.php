<?php
function isLoggedIn() {
    return isset($_SESSION['user']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isMedecin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'medecin';
}

function isPatient() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'patient';
}