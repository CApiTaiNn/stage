<?php

    function generateId(){
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-!#&%$?';
        $id = '';
        for ($i=0; $i < random_int(12, 30); $i++) { 
            $id .= $char[random_int(0, strlen($char) - 1)];
        }
        return $id;
    }
?>