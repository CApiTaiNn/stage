<?php
    class UserModel{
        private $conn;
        private $id_user;
        private $name;
        private $firstname;
        private $email;
        private $phone;



        function setDB($con){
            $this->conn = $con;
        }

        function getUsers() {
            $query = "SELECT * FROM Users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $Users = $stmt->fetchAll();
            return $Users;
        }

        function createUser($user){
            $query = "INSERT INTO Users (name, firstname, email, phone) VALUES (:name, :firstname, :email, :phone)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':firstname', $user['firstname']);
            $stmt->bindParam(':email', $user['email']);
            $stmt->bindParam(':phone', $user['phone']);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
?>