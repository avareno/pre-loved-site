<?php

require_once '../database/read_tables.php';
require_once '../utils/getters.php';
require_once 'update_field.php';


session_start();

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_SESSION['permissions']) && $_SESSION['permissions'] === 'admin') {
        if (isPostParamSet("user_id")) {
            $user_id = $_POST["user_id"];
            $usernameData = fetchData($db, 'SELECT username FROM users WHERE id = :id', [':id' => $user_id]);

            
            if ($usernameData && isset($usernameData['username'])) {
                $username = $usernameData['username'];
                updateFieldUsers($db, $username, 'permissions', 'admin');
                header("Location: ../pages/profile/public_profile.php?id=" . urlencode($user_id));
                exit;
            } else {
                echo "User not found.";
                
            }
        }
    }
}



?>