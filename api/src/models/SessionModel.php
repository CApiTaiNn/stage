<?php

    /**
     * Model d'une session
     */

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

        function createSession($id_session, $id_user, $auth_id, $auth_pass){
            $query = "INSERT INTO Sessions (id_session, id_user, auth_id, auth_pass) 
                    VALUES (:id_session, :id_user, :auth_id, :auth_pass)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_session', $id_session, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':auth_id', $auth_id);
            $stmt->bindParam(':auth_pass', $auth_pass);
            
            return $stmt->execute();
        }

        function valideAuth($id_session, $auth_id, $auth_pass) {
            $id_session = trim($id_session);
            $query = "SELECT s.id_session, s.id_user, s.auth_id, s.auth_pass 
                      FROM Sessions as s
                      WHERE s.id_session = :id_session";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_session', $id_session);
            $stmt->execute();

            //Vérifie si des résultats sont retournés
            if ($stmt->rowCount() == 0) {
                return json_encode(['status' => 'error', 'message' => 'aucune session trouvee']);
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Vérification des hashs
            if ($result && password_verify($auth_id, $result['auth_id']) && password_verify($auth_pass, $result['auth_pass'])) {
                true;
            } else {
                false;
            }
        }

        function suppSession($idSession){
            $query = "DELETE FROM Sessions
                    WHERE id_session = :idSession";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idSession', $idSession, PDO::PARAM_INT);
            return $stmt->execute();
        }

        /*
        * Récupère les sessions courantes
        * Si le datetime actuel - le datetime de la session est inférieur à 1h, on considère que la session est courante
        */
        function getCurrentSession(){
            $query = "SELECT count(id_session) as currentSession FROM Sessions
                    WHERE TIMEDIFF(CURTIME(), date) < '01:00:00'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /*
        * Récupère les utilisateurs qui se sont connecté aujourd'hui
        */
        function getDaySession(){
            $query = "SELECT count(id_session) as daySession FROM Sessions
                    WHERE DATE(date) = CURDATE()";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /*
        * Récupère les 10 derniers utilisateurs qui se sont connecté
        */
        function get10LastSession(){
            $query = "SELECT u.name, u.firstname, TIME(s.date) AS time 
                    FROM Sessions as s
                    INNER JOIN Users as u
                    ON s.id_user = u.id_user";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>