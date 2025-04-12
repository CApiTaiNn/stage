<?php

    /**
     * Script d'authentification des codes recu par mail
     * Envoie des codes à l'api
     * Gere les 3 tentatives d'authentification
     * 
    */
    
    //Creation de la session pour 3 tentatives
    session_start();
    if (!isset($_SESSION['attempts'])) {
        $_SESSION['attempts'] = 0;
    }

    // Vérifier que les champs sont bien remplis
    if (!isset($_POST['orga'], $_POST['id'], $_POST['code'], $_POST['id_session'])) {
        echo json_encode(["status" => "error", "message" => "Données manquantes"]);
        exit;
    }

    /**
     * Initialisation de la requete cURL
     * 
     * Variable a envoyer
     * Url et Key API
     * Configuration de la requete
     * 
     * Envoi de la requete
    */

    $orga = trim($_POST['orga']) ?? ''; 
    $id = trim($_POST['id']) ?? '';
    $code =trim($_POST['code']) ?? '';
    $idSession = $_POST['id_session'] ?? '';
    $apiUrl = 'http://api/authentification';
    $apiKey = getenv('API_KEY');
    $data = [
        'orga' => $orga,
        'id' => $id,
        'code' => $code,
        'id_session' => $idSession
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "X-API-KEY: $apiKey"
    ]);

    $response = curl_exec($ch);
    // Vérifier si une erreur s'est produite
    if (curl_errno($ch)) {
        echo 'Erreur cURL: ' . curl_error($ch);
        exit;
    }
    curl_close($ch);
    $result = json_decode($response, true);
    
    /**
     * Vérification de la réponse de l'API
     * 
     * Si success, on ajoute l'IP de l'utilisateur dans la liste blanche
     * Si error, on incrémente le nombre de tentatives
     * Si 3 tentatives échouées, on supprime la session de l'utilisateur
     *  
    */ 

    if ($result['status'] === 'success') {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $command = "sudo /sbin/iptables -A INPUT -s $ip -j ACCEPT";
            //shell_exec($command);
            echo json_encode(["status" => "success", "redirect" => "https://www.google.fr"]);
            exit;
        } else {
            echo json_encode(["status" => "error", "message" => "IP invalide"]);
            exit;
        }
    }else{
        $_SESSION['attempts']++;
        if ($_SESSION['attempts'] >= 3) {

            /**
             * Configuration de la requete de suppression de la session
             */
            $url = 'http://api/errorAuth';
            $data = [
                'orga' => $orga,
                'id_session' => $idSession
            ];
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                "X-API-KEY: $apiKey"
            ]);
            $deleteSession = curl_exec($ch);
            curl_close($ch);

            $_SESSION['attempts'] = 0;
            echo json_encode(["status" => "error", "message" => "tentativeMaxAtteinte", 'orga' => $orga]);
            exit;
        }
        echo json_encode(["status" => "error", "message" => "Erreur d'authentification, veuillez saisir des identifiants valident sinon vous serez rediriger vers le portail, tentative " . $_SESSION['attempts'] . "/3"]);
        exit; 
    }
?>