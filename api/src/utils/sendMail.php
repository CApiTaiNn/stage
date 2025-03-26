<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require_once __DIR__ . '/generator.php';

    function sendMail($orga, $email, $name){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Le serveur SMTP (ici Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = ''; // L'adresse email du compte Gmail que tu utilises pour envoyer les emails
        $mail->Password = '1a2b3c4d5e6f7g';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('confirmation@domaine-enregistré', $orga);
        $mail->addAddress($email, $name);
        $mail->Subject = 'Vos identifiants de connexion';

        // Définir le HTML 
        $mail->isHTML(TRUE);
        $mail->Body =
         '<html>
            Bonjour, <br>
            Voici vos identifiants de connexion : <br>
            Identifiant : ' . generateId() . '<br>
            Code : ' . generateId() . '<br>
            <br>
            Cordialement, <br>
            L\'équipe ' . $orga . '
        </html>';

        // envoyer le message
        if(!$mail->send()){
            echo 'Le message na pas pu être envoyé.';
            echo 'Erreur du Mailer : ' . $mail->ErrorInfo;
        } else {
            echo 'Le message a été envoyé';
        }
    }
?>