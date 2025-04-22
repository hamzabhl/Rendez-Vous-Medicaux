<?php

session_start();
session_unset();  // optional
session_destroy();
header('Location: login.php');
exit;