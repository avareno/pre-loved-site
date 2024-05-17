<?php
session_start(); // Start the session

require '../database/read_tables.php';
require_once '../utils/getters.php';

$db = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted
    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['new_password_conf'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $new_password_conf = $_POST['new_password_conf'];
        $user_id = $_SESSION['id'];

        // Validate new password
        $errors = [];
        if (strlen($new_password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
        if (!preg_match("#[0-9]+#", $new_password)) {
            $errors[] = "Password must contain at least one number";
        }
        if (!preg_match("#[a-zA-Z]+#", $new_password)) {
            $errors[] = "Password must contain at least one letter";
        }
        if ($new_password != $new_password_conf) {
            $errors[] = 'Passwords do not match';
        }

        if (!empty($errors)) {
            $_SESSION['error'] = $errors[0];
            header("location: ../pages/profile/profile.php");
            exit;
        }

        // Fetch the user's current password hash
        $user = fetchData($db, "SELECT password FROM users WHERE id = :id", [":id" => $user_id]);

        if (!$user || !password_verify($current_password, $user['password'])) {
            $_SESSION['error'] = 'Current password is incorrect';
            header("location: ../pages/profile/profile.php");
            exit;
        }

        // Hash the new password
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        try {
            $stmt = $db->prepare("UPDATE users SET password = :new_password WHERE id = :id");
            $stmt->bindParam(':new_password', $hashed_new_password);
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();

            // Provide feedback to the user
            $_SESSION['message'] = 'Password updated successfully';
            header("location: ../pages/profile/profile.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error updating password: ' . $e->getMessage();
            header("location: ../pages/profile/profile.php");
            exit;
        }
    } else {
        $_SESSION['error'] = 'All fields are required';
        header("location: ../pages/profile/profile.php");
        exit;
    }
}
?>
