<?php
session_start(); // Start the session
require_once '../../database/read_tables.php';
require_once '../../utils/getters.php';
require_once '../../common/head_login.php';


$db = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isPostParamSet('username')) {
        $username = $_POST['username'];
    }
    if (isPostParamSet('password')) {
        $password = $_POST['password'];
    }

    // Check if any field is empty
    if (empty($username) || empty($password)) {
        //echo 'Fill all the fields to register';
    } else {

        $user = fetchData($db, "SELECT * FROM users WHERE username = :username", [":username"=> $username]);

        if ($user) {
            if (password_verify($password, $user['password'])) {

                $_SESSION['username'] = $username;
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

fetch_head(["username","password"],["text","password"],["username","password"],["username","password"],["Username","Password"],false);
?>
