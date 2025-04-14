<?php
    /**
     * Genere un identifiant unique
     * @return string
    */

    function generateId(){
        return bin2hex(random_bytes(10));
    }
?>