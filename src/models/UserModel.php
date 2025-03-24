<?php

    require_once __DIR__ . '/../models/Database.php';

    class UserModel{
        private $conn;
        private $id_user;
        private $name;
        private $first_name;
        private $email;
        private $phone;
        private $adr_mac;

        public function __construct(){
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        function getUsers() {
            $query = "SELECT * FROM Users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $Users = $stmt->fetchAll();
            return $Users;
        }

        
    }
?>