<?php
    //Coonfiguration de l'API
    $apiKey = getenv('API_KEY');
    $apiUrl = "http://api/login";

    //Récupération des données du formulaire
    $data = json_decode(file_get_contents('php://input'), true);

    //Préparation de la requete
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "X-API-KEY: $apiKey"
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Séparer les headers et le body de la réponse
    list($headers, $body) = explode("\r\n\r\n", $response, 2);

    // Rechercher le cookie SESSION_ID dans les headers
    if (preg_match('/Set-Cookie:\s*SESSION_ID=([^;]+)/', $headers, $matches)) {
        $sessionId = $matches[1];

        // Définir le cookie côté navigateur
        setcookie("SESSION_ID", $sessionId, [
            'expires' => time() + 3600,
            'path' => '/',
            'secure' => true, 
            'httponly' => true, 
            'samesite' => 'Strict'
        ]);
    }

    //Transmision de la reponse api au portail
    http_response_code($httpCode);
    echo $response;
    exit;
?>