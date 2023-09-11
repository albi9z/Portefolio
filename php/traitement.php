/**
 * Traitement du formulaire de contact.
 *
 * Ce fichier est responsable de la gestion des données du formulaire
 * et de l'envoi d'e-mails.
 *
 * PHP version 7
 *
 * @author DigiprogTech
 * @Date 07/09/2023
 * @version 1.0
 */


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données
    $nom = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $sujet = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Vérification des données nettoyées
    if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
        die('Veuillez remplir tous les champs.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('L\'adresse e-mail fournie n\'est pas valide.');
    }

    // Configuration de l'e-mail avec PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Paramètres du serveur
        $mail->SMTPDebug = 0; // Activer le mode debug si nécessaire
        $mail->isSMTP();    // Utiliser SMTP
        $mail->Host = 'smtp.example.com';  // Adresse du serveur SMTP
        $mail->SMTPAuth = true;             // Activer l'authentification SMTP
        $mail->Username = 'user@example.com';  // SMTP username (votre adresse e-mail)
        $mail->Password = 'password';       // SMTP password
        $mail->SMTPSecure = 'tls';          // Activer le chiffrement TLS, `ssl` est aussi accepté
        $mail->Port = 587;                  // Port TCP à connecter, utilisez 465 pour `ssl`

        // Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('votre_email@example.com'); // Ajoutez une adresse destinataire

        // Contenu
        $mail->isHTML(true);    // Format de l'e-mail en HTML
        $mail->Subject = "Nouveau message de $nom : $sujet";
        $mail->Body    = "Nom: $nom<br>Email: $email<br>Sujet: $sujet<br>Message: $message";

        $mail->send();
        header('Location: index.html?status=success');
        exit;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        header('Location: index.html?status=error');
        exit;
    }
}
?>
