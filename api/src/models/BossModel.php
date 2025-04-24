<?php
    /**
     * Model d'un utilisateur
    */

    //require_once __DIR__ . '/../Config/Database.php';

    class BossModel{
        private $conn;
        private $id;
        private $name;
        private $password;
        private $email;
        private $phone;
        private $a2f_activated;
        private $a2f_secret;

        function setDB($con){
            $this->conn = $con;
        }

        function getAllBoss() {
            $query = "SELECT * FROM Boss";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            }else{
                return false;
            }
        }

        /**
         * @param string $name
         * @param string $password non hashe
         * 
         * Récupere tout les Boss ou le nom est le même que celui passé en paramètre
         * Compare les mot de passe hashé avec le mot de passe passé en paramètre
         * 
         * @return bool true si le mot de passe est bon, false sinon
        */
        function login($name, $passwordHash) {
            // Config de la bdd
            $db = new Database();
            $db->setDB(getenv('DBNAMEBOSS'), getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
            $this->conn = $db->getConnection();
            
            $query = "SELECT * FROM Boss WHERE name = :name";
        
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $tabBoss = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Vérifier si aucun boss n'a été trouvé avec ce nom
            if (empty($tabBoss)) {
                return false;
            }
        
            // Si le nom existe dans la base, vérifier le mot de passe
            foreach ($tabBoss as $boss) {
                if (password_verify($passwordHash, $boss['password'])) {
                    return true;
                } else {
                    return false;
                }
            }
        }


        function a2fIsActivated($name) {
            // Config de la bdd
            $db = new Database();
            $db->setDB(getenv('DBNAMEBOSS'), getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
            $this->conn = $db->getConnection();
            
            $query = "SELECT a2f_activated FROM Boss WHERE name = :name";
        
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
            // Vérifier si aucun boss n'a été trouvé avec ce nom
            if (empty($response)) {
                return false;
            }

            if ($response[0]['a2f_activated'] == 1) {
                return true;
            } else {
                return false;
            }
        }


        function setSecret($name, $secret) {
            // Config de la bdd
            $db = new Database();
            $db->setDB(getenv('DBNAMEBOSS'), getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
            $this->conn = $db->getConnection();
            
            $query = "UPDATE Boss SET a2f_secret = :secret, a2f_activated = true WHERE name = :name";
        
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':secret', $secret);
        
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        function getSecret($name) {
            // Config de la bdd
            $db = new Database();
            $db->setDB(getenv('DBNAMEBOSS'), getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
            $this->conn = $db->getConnection();
            
            $query = "SELECT a2f_secret FROM Boss WHERE name = :name";
        
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
        
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }
        
    }
?>