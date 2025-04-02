<?php
    function checkApiKey($request) {
        $apiKeyEnv = getenv('API_KEY');  // API Key stockée dans l'environnement
        $apiKeyHeader = $request->getHeaderLine('X-API-KEY');  // API Key envoyée dans le header 

        //Retourne le resultat de la comparaison entre l'API Key Env et l'API Key header
        return $apiKeyEnv === $apiKeyHeader;
    }
?>