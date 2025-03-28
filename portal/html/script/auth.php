<?php
    header('Content-Type: application/json');

    // Vérifier que les champs sont bien remplis
    if (!isset($_POST['orga'], $_POST['id'], $_POST['code'], $_POST['email'])) {
        echo json_encode(["status" => "error", "message" => "Données manquantes"]);
        exit;
    }

    // Récupérer les données du formulaire
    $orga = trim($_POST['orga']) ?? ''; // Remplace par les valeurs appropriées
    $email = trim($_POST['email']) ?? ''; // Idem
    $id = trim($_POST['id']) ?? '';
    $code =trim($_POST['code']) ?? '';

    // URL de l'API
    $apiUrl = 'http://api/authentification';

    // Créer les données à envoyer
    $data = [
        'orga' => $orga,
        'email' => $email,
        'id' => $id,
        'code' => $code
    ];

    // Initialiser cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    // Exécuter la requête
    $response = curl_exec($ch);

    // Vérifier si une erreur s'est produite
    if (curl_errno($ch)) {
        echo 'Erreur cURL: ' . curl_error($ch);
        exit;
    }

    // Fermer la session cURL
    curl_close($ch);

    // Décoder la réponse JSON
    $result = json_decode($response, true);

    if ($result['status'] === 'success') {
        $ip = $_SERVER['REMOTE_ADDR'];

        // Vérifier si l'IP est valide
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
        echo json_encode(["status" => "error", "message" => "Erreur d'authentification"]);
        exit; 
    }
?>