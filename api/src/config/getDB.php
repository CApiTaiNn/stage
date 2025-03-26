<?php
    function getDatabaseConfig($db_name) {
        $db_configs = json_decode($_ENV['DB_CONFIGS'], true);

        print_r($db_configs);

        if (isset($db_configs[$db_name])) {
            return $db_configs[$db_name];
        } else {
            throw new Exception('Invalid database specified');
        }
    }
?>