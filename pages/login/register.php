<?php
session_start(); // Start the session

require '../../database/read_tables.php';
require_once '../../utils/getters.php';
require_once '../../actions/add_user.php';
require_once '../../common/login_register.php';

$db = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted

    if (isPostParamSet('username')) {
        $username = $_POST['username'];
    }
    if (isPostParamSet('password')) {
        $password = $_POST['password'];
    }
    if (isPostParamSet('email')) {
        $email = $_POST['email'];
    }
    if (isPostParamSet('password-conf')) {
        $password_conf = $_POST['password-conf'];
    }


    if (empty($username) || empty($email) || empty($password) || empty($password_conf)) {
        echo 'Fill all the fields to register';
    } else {

        $errors = [];
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
        if (!preg_match("#[0-9]+#", $password)) {
            $errors[] = "Password must contain at least one number";
        }
        if (!preg_match("#[a-zA-Z]+#", $password)) {
            $errors[] = "Password must contain at least one letter";
        }

        if ($password != $password_conf) {
            $errors[] = 'Passwords do not match';
        }

        if (!empty($errors)) {
            $login_err = $errors[0];
        } else {
            $banned = fetchData($db, "SELECT * FROM BAN WHERE email = :email", [":email" => $email]);
            if ($banned) {
                $login_err = "Sorry but that email is banned from this site, please use other email";
            } else {
                $existingUser = fetchData($db, "SELECT * FROM USERS WHERE username = :username OR email = :email", [":username" => $username, ":email" => $email]);

                if ($existingUser) {
                    $login_err = 'Username or email already exists';
                } else {
                    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

                    createUser($db, $username, $email, $hashed_pass);

                    $row = fetchData($db, "SELECT * FROM users WHERE email = :email", [":email" => $email]);

                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['permissions'] = $row['permissions'];
                    header("location: ../main_page/index.php");
                    exit;
                }
            }
        }
    }
}

fetch_head(["username", "email", "password", "password-conf"], ["text", "email", "password", "password"], ["username", "email", "password", "password-conf"], ["username", "email", "password", "password-conf"], ["Username", "Email", "Password", "Password Confirmation"], true, $login_err);
?>