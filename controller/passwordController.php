<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once '../racine.php';
include_once RACINE . '/services/UserService.php';
include_once RACINE . '/services/MailService.php';
include_once RACINE . '/connexion/Connexion.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;
$pdo = new Connexion();
$us = new UserService();

switch ($action) {
    case 'send_code':
        $email = isset($_POST['email']) ? $_POST['email'] : null;

        $user = $us->findByEmail($email);
        if ($user) {
            $resetCode = rand(100000, 999999);
            $_SESSION['reset_code'] = $resetCode;
            $_SESSION['reset_email'] = $email;
            $_SESSION['reset_expires'] = time() + 300;


            if (sendVerificationEmail($email, $resetCode)) {
//                echo "Verification code sent to $email.";
//                header("location:../views/password/verifyCode.php");
                echo "<script>alert('Verification code sent to $email'); window.location.href = '../views/password/verifyCode.php';</script>";
            } else {
//                echo "Failed to send verification email.";
                echo "<script>alert('Failed to send verification email');</script>";
            }
        }
        break;

    case 'verify_code':
        $inputCode = isset($_POST['code']) ? $_POST['code'] : null;
        $storedCode = isset($_SESSION['reset_code']) ? $_SESSION['reset_code'] : null;
        $expiresAt = isset($_SESSION['reset_expires']) ? $_SESSION['reset_expires'] : 0;

        if (!$inputCode) {
//        if (!$inputCode || !$storedCode)
            echo "<script>alert('Veuillez saisir le Code!');</script>";
            echo "Code missing.";
            break;
        }

        if (trim((string) $inputCode) !== trim((string) $storedCode)) {
            echo "<script>alert('Code non valid!');</script>";
            break;
        }

        if (time() > $expiresAt) {
            echo "<script>alert('Code expiré!');</script>";
            break;
        }
        header("location:../views/password/newPassword.php");

        break;


    case 'reset_password':
        $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : null;
        $c_newPassword = isset($_POST['conf_new_password']) ? $_POST['conf_new_password'] : null;

        if ($newPassword !== $c_newPassword) {
            echo "<script>alert('Passwords don't matche');</script>";
            return;
        }

        $email = isset($_SESSION['reset_email']) ? $_SESSION['reset_email'] : null;

        if ($email && $newPassword) {
            $us = new UserService();
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $us->updatePassword($email, $hashedPassword);

            unset($_SESSION['reset_code']);
            unset($_SESSION['reset_email']);
            unset($_SESSION['reset_expires']);

            header("location:../views/login.php");
        } else {
            echo "Missing data.";
        }
        break;

    default:
        echo "Invalid action.";
        break;
}