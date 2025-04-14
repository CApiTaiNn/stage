<?php
    /**
     * Model d'un utilisateur
    */

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

        function getAllUsers() {
            $query = "SELECT
                    u.id_user,
                    u.name,
                    u.firstname,
                    u.email,
                    u.phone,
                    COUNT(s.id_session) AS connection_count,
                    MAX(s.date) AS last_session_date,
                    CASE 
                        WHEN TIMESTAMPDIFF(MINUTE, MAX(s.date), NOW()) <= 60 THEN true
                        ELSE false
                    END AS status
                    FROM Users as u
                    JOIN Sessions as s ON u.id_user = s.id_user
                    GROUP BY u.id_user, u.name, u.firstname, u.email, u.phone";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
                
        }

        function getUserId($name, $firstname, $email){
            $query = "SELECT id_user
                    FROM Users 
                    WHERE name = :name 
                    AND firstname = :firstname 
                    AND email = :email";
                    
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['id_user'] : null;
        }

        function createUser($user){
            $query = "INSERT INTO Users (name, firstname, email, phone) 
                    VALUES (:name, :firstname, :email, :phone)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':firstname', $user['firstname']);
            $stmt->bindParam(':email', $user['email']);
            $stmt->bindParam(':phone', $user['phone']);

            return $stmt->execute();             
        }

        function ifExist($name, $firstname, $email){
            $query = "SELECT * FROM Users
                    WHERE name = :name
                    AND firstname = :firstname
                    AND email = :email";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return !empty($result);
        }


        function getIp(): string{
            if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
                $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
            } elseif (isset($_SERVER['REMOTE_ADDR']) === true) {
                $ip = $_SERVER['REMOTE_ADDR'];
                if (preg_match('/^(?:127|10)\.0\.0\.[12]?\d{1,2}$/', $ip)) {
                    if (isset($_SERVER['HTTP_X_REAL_IP'])) {
                        $ip = $_SERVER['HTTP_X_REAL_IP'];
                    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    }
                }
            } else {
                $ip = '127.0.0.1';
            }
            if (in_array($ip, ['::1', '0.0.0.0', 'localhost'], true)) {
                $ip = '127.0.0.1';
            }
            $filter = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
            if ($filter === false) {
                $ip = '127.0.0.1';
            }

            return $ip;
        }
    }
?>