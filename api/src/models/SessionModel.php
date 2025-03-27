<?php
    class SessionModel{
        private $conn;
        private $id_session;
        private $id_user;
        private $id_date;
        private $auth_id;
        private $auth_pass;

        function setDB($db){
            $this->conn = $db;
        }

        function getSessions(){
            $query = "SELECT * FROM Sessions";
            $stmt = $this->conn->prepare($query);

            if ($stmt->execute()) {
                return $stmt->fetchAll();
            }else{
                return false;
            }
        }

        function createSession($id_user, $auth_id, $auth_pass){
            $query = "INSERT INTO Sessions (id_user, auth_id, auth_pass) VALUES (:id_user, :auth_id, :auth_pass)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':auth_id', $auth_id);
            $stmt->bindParam(':auth_pass', $auth_pass);

            return $stmt->execute();
        }

        function valideAuth($email, $auth_id, $auth_pass) {
            $query = "SELECT auth_id, auth_pass FROM Sessions
                      JOIN Users ON Sessions.id_user = Users.id_user
                      WHERE Users.email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            
    
            if ($result && $result['auth_id'] == $auth_id && $auth_pass == $result['auth_pass']) {
                var_dump($result);
                return true;
            } else {
                return false;
            }
        }
    }
?>