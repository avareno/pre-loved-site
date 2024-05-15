<?php
session_start(); // Start the session
require_once '../../database/read_tables.php';
require_once '../../utils/getters.php';
require_once '../../common/login_register.php';


$db = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isPostParamSet('email')) {
        $email = $_POST['email'];
    }
    if (isPostParamSet('password')) {
        $password = $_POST['password'];
    }

    // Check if any field is empty
    if (empty($email) || empty($password)) {
        $login_err = 'Fill all the fields to register';
    } else {
        $banned = fetchData($db, "SELECT * FROM BAN WHERE email = :email", [":email" => $email]);
        if ($banned) {
            $login_err = "Sorry but that email is banned from this site, please use other email";
        } else {
            $user = fetchData($db, "SELECT * FROM users WHERE email = :email", [":email" => $email]);
            if ($user) {
                if (password_verify($password, $user['password'])) {

                    $row = fetchData($db, "SELECT * FROM users WHERE email = :email", [":email" => $email]);

                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['permissions'] = $row['permissions'];
                    header("location: ../main_page/index.php");
                    exit;
                } else {
                    $login_err = 'Invalid password';
                }
            } else {
                $login_err = 'Username not found';
            }
        }
    }
}

fetch_head(["email", "password"], ["text", "password"], ["email", "password"], ["email", "password"], ["Email", "Password"], false, $login_err);
?>