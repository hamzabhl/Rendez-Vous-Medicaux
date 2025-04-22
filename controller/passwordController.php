<?php

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
                echo "Verification code sent to $email.";
            } else {
                echo "Failed to send verification email.";
            }
        }
        break;

    case 'verify_code':
        $inputCode = isset($_POST['code']) ? $_POST['code'] : null;
        $storedCode = isset($_SESSION['reset_code']) ? $_SESSION['reset_code'] : null;
        $expiresAt = isset($_SESSION['reset_expires']) ? $_SESSION['reset_expires'] : 0;

        if (!$inputCode || !$storedCode) {
            echo "Code missing.";
            break;
        }

        if ($inputCode !== $storedCode) {
            echo "Invalid code.";
            break;
        }

        if (time() > $expiresAt) {
            echo "Code expired.";
            break;
        }

        // If we reach here, all good
        echo "Code verified.";
        break;


    case 'reset_password':
        $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : null;
        $email = isset($_SESSION['reset_email']) ? $_SESSION['reset_email'] : null;

        if ($email && $newPassword) {
            $us = new UserService();
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $us->updatePassword($email, $hashedPassword);

            // Clean up session
            unset($_SESSION['reset_code']);
            unset($_SESSION['reset_email']);
            unset($_SESSION['reset_expires']);

            echo "Password has been reset.";
        } else {
            echo "Missing data.";
        }
        break;

    default:
        echo "Invalid action.";
        break;
}
?>
