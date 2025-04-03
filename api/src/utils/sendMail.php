<?php

    /**
     * 
     * Envoi un mail avec les identifiants de connexion
     * @return array avec Code et Identifiant
    */

    use PHPMailer\PHPMailer\PHPMailer;
    require_once __DIR__ . '/../../vendor/autoload.php';

    function sendMail($orga, $email, $name){
        //Parametrage de PHPMailer
        //Source et Destinataire
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Le serveur SMTP (ici Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'sloan.morgant@gmail.com'; //Changer l'adr mail pour la production
        $mail->Password = $_ENV['MAILPWD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('sloan.morgant@gmail.com', $orga); //Changer l'adr mail pour la production
        $mail->addAddress($email, $name);
        $mail->Subject = 'Vos identifiants de connexion';

        //Génération des identifiants
        $idLogin = generateId();
        $idPass = generateId();

        // Définir le HTML du mail
        $mail->isHTML(TRUE);
        $mail->Body =
         '<html>
            Bonjour, <br>
            <br>
            Voici vos identifiants de connexion : <br>
            Identifiant : ' . $idLogin . '<br>
            Code : ' . $idPass . '<br>
            <br>
            Cordialement, <br>
            L`équipe ' . $orga .'
        </html>';
        
        // Envoyer le message
        if (!$mail->send()) {
            error_log('Erreur d\'envoi de mail : ' . $mail->ErrorInfo);
            return false;
        } else {
            $code = array(
                $idLogin,
                $idPass
            );
            return $code;
        }
    }
?>