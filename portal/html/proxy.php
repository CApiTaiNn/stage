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
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "X-API-KEY: $apiKey"
    ]);

    $response = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    //Transmision de la reponse api au portail
    http_response_code($httpCode);
    echo $response;
    exit;
?>