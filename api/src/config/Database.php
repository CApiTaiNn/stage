<?php
    class Database {
        private $host;
        private $db_name;
        private $username;
        private $password;
        private $conn;

        public function __construct() {
            $this->host = 'db';
        }

        public function setDB($dbname, $username, $password) {
            $this->db_name = $dbname;
            $this->username = $username;
            $this->password = $password;
        }

        // Méthode pour établir la connexion à la base de données
        public function getConnection() {
            $this->conn = null;
            try {
                // Création d'une nouvelle instance PDO pour se connecter à la base de données
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                // Définir le mode d'erreur sur Exception pour une meilleure gestion des erreurs
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                // Gestion des erreurs de connexion
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }

        // Méthode pour obtenir les configurations de la base de données selon le client spécifié
        public function getDatabaseConfig($db_name) {
            $db_configs = json_decode($_ENV['DB_CONFIGS'], true);
            if (isset($db_configs[$db_name])) {
                return $db_configs[$db_name];
            } else {
                return 'Invalid database specified';
            }
        }
    }
?>