<?php


    declare(stricttypes = 1);

    function getDatabaseConnection() : PDO {
        try {

            $db = new PDO('sqlite:' . __DIR__ . '/database.db');
            return $db;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

?>