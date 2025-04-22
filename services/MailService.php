<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load manually (no Composer)
require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';

function sendVerificationEmail($toEmail, $code) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'unknownexperimenting@gmail.com';
        $mail->Password   = 'dxhdzyldohgeqlwe';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('unknownexperimenting@gmail.com', 'DoctoCity');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Votre code de vérification';
        $mail->Body    = "<h3>Votre code est :</h3><p style='font-size: 24px;'>$code</p>";
        $mail->AltBody = "Votre code est : $code";

        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}