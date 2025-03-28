<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require_once __DIR__ . '/generator.php';
    require_once __DIR__ . '/../../vendor/autoload.php';

    function sendMail($orga, $email, $name){

        //Parametrage de PHPMailer
        //Source et Destinataire
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Le serveur SMTP (ici Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'sloan.morgant@gmail.com'; 
        $mail->Password = $_ENV['MAILPWD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('sloan.morgant@gmail.com', $orga);
        $mail->addAddress($email, $name);
        $mail->Subject = 'Vos identifiants de connexion';

        //Génération des identifiants
        $idLogin = generateId();
        $idPass = generateId();

        // Définir le HTML 
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