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
            $stmt->execute();
           
            //Récupération de l'id de la session
            return $this->conn->lastInsertId();
        }

        function valideAuth($id_session, $auth_id, $auth_pass) {
            $query = "SELECT s.id_session, s.id_user, s.auth_id, s.auth_pass 
                      FROM Sessions as s
                      WHERE s.id_session = :id_session";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_session', $id_session, PDO::PARAM_INT);
            $stmt->execute();

            // Debugging: Vérifie si des résultats sont retournés
            if ($stmt->rowCount() == 0) {
                // Si aucune ligne n'est trouvée
                error_log("Aucune session trouvée pour l'id_session: $id_session");
                return false;
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Vérification des hashs
            if ($result && password_verify($auth_id, $result['auth_id']) && password_verify($auth_pass, $result['auth_pass'])) {
                return [
                    'id_session' => $result['id_session'],
                    'id_user' => $result['id_user']
                ];
            } else {
                // Debugging: Message d'erreur pour vérifier si les hashs ne correspondent pas
                error_log("Erreur de vérification des hashs pour auth_id ou auth_pass");
                return false;
            }
        }

        function suppSession($idSession){
            $query = "DELETE FROM Sessions
                    WHERE id_session = :idSession";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idSession', $idSession, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>