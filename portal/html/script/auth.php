<?php

    // Vérifier que les champs sont bien remplis
    if (!isset($_POST['orga'], $_POST['id'], $_POST['code'], $_POST['email'])) {
        echo json_encode(["status" => "error", "message" => "Données manquantes"]);
        exit;
    }

    //Recuperation des données
    $orga = htmlspecialchars(trim($_POST['orga']));
    $id = htmlspecialchars(trim($_POST['id']));
    $code = htmlspecialchars(trim($_POST['code']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    $url = "http://localhost:8081/authentification";
    $data = [
        'orga' => $orga,
        'id' => $id,
        'code' => $code,
        'email' => $email,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close($ch);

    var_dump($response);

    if ($response === false) {
        echo json_encode(["status" => "error", "message" => "Erreur lors de la communication avec l'API"]);
        exit;
    }else{
        // Décoder la réponse JSON
        $result = json_decode($response, true);
        if ($result && isset($result['status']) && $result['status'] === "success") {
            $ip = $_SERVER['REMOTE_ADDR'];
        
            // Vérifier si l'IP est valide
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                $command = "sudo /sbin/iptables -A INPUT -s $ip -j ACCEPT";
                //shell_exec($command);
                header("Location: https://www.google.fr");
                exit;
            } else {
                echo json_encode(["status" => "error", "message" => "IP invalide"]);
                exit;
            }
        } else {
            header("Location: error.php");
            exit;
        }
    }

       
?>