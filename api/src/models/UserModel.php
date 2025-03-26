<?php

    require_once __DIR__ . '/../config/Database.php';

    class UserModel{
        private $conn;
        private $id_user;
        private $name;
        private $first_name;
        private $email;
        private $phone;
        private $adr_mac;

        public function __construct($db){
            $this->conn = $db->getConnection();
        }

        function getUsers() {
            $query = "SELECT * FROM Users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $Users = $stmt->fetchAll();
            return $Users;
        }

        function createUser($user){
            $query = "INSERT INTO Users (name, first_name, email, phone, adr_mac) VALUES (:name, :first_name, :email, :phone, :adr_mac)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':first_name', $user['first_name']);
            $stmt->bindParam(':email', $user['email']);
            $stmt->bindParam(':phone', $user['phone']);
            $stmt->bindParam(':adr_mac', $user['adr_mac']);
            return $stmt->execute();
        }

        
    }
?>