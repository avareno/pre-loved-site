<?php

require_once '../database/read_tables.php';
require_once '../utils/getters.php';
require_once 'update_field.php';


session_start();

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in and has admin permissions
    if (isset($_SESSION['permissions']) && $_SESSION['permissions'] === 'admin') {
        if (isPostParamSet("user_id")) {
            $user_id = $_POST["user_id"];
            $usernameData = fetchData($db, 'SELECT username FROM users WHERE id = :id', [':id' => $user_id]);

            // Check if username data exists and if it contains the 'username' index
            if ($usernameData && isset($usernameData['username'])) {
                $username = $usernameData['username'];
                updateFieldUsers($db, $username, 'permissions', 'admin');
                header("Location: ../pages/profile/public_profile.php?id=" . urlencode($user_id));
                exit;
            } else {
                echo "User not found.";
                // Handle the case where the user ID doesn't exist or username is not found
            }
        }
    }
}



?>