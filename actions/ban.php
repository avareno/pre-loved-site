<?php

require_once '../database/read_tables.php';
require_once '../utils/getters.php';
require_once 'update_field.php';
require_once 'query_execute.php'; 
require_once 'delete_field.php'; 

session_start();

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in and has admin permissions
    if (isset($_SESSION['permissions']) && $_SESSION['permissions'] === 'admin') {
        if (isPostParamSet("user_id")) {
            $user_id = $_POST["user_id"];
            $row = fetchData($db, 'SELECT * FROM users WHERE id = :id', [':id' => $user_id]);

            // Check if user data exists
            if ($row && isset($row['username'])) {
                // Delete products associated with the user
                executeQuery($db, "DELETE FROM products WHERE seller_id = :seller_id", [':seller_id' => $user_id]);

                // Add user's email to the ban table
                executeQuery($db, "INSERT INTO ban (email) VALUES (:email)", [':email' => $row['email']]);

                // Remove user from users table
                deleteFieldUsers($db, $row['username']);

                // Redirect to the appropriate page
                header("Location: ../pages/main_page/index.php");
                exit;
            } else {
                // User not found
                echo "User not found.";
                header("Location: ../pages/main_page/index.php");
                exit;
            }
        }
    }
}

?>
