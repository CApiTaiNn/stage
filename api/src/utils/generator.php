<?php
    function generateId(){
        return bin2hex(random_bytes(16));
    }
?>