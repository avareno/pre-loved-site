<?php
    session_start(); // Start the session

    require '../../database/readdbproducts.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form has been submitted

        if(isset($_POST['username'])){
            $username = $_POST['username'];
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['password-conf'])){
            $password_conf = $_POST['password-conf'];
        }

        // Check if any field is empty
        if(empty($username) || empty($email) || empty($password) || empty($password_conf)){
            echo 'Fill all the fields to register';
        } else {
            // Check password strength
            $errors = [];
            if(strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long";
            }
            if(!preg_match("#[0-9]+#", $password)) {
                $errors[] = "Password must contain at least one number";
            }
            if(!preg_match("#[a-zA-Z]+#", $password)) {
                $errors[] = "Password must contain at least one letter";
            }

            if($password != $password_conf){
                $errors[] = 'Passwords do not match';
            }

            if(!empty($errors)) {
                echo $errors[0] . "<br>";
            } else {
                $query = "SELECT * FROM USERS WHERE username = :username OR email = :email";
                $stmt = $db->prepare($query);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
                if($existingUser){
                    echo 'Username or email already exists';
                } else {
                    $hashed_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    $insert_stmt = 'INSERT INTO users (username, email, password, permissions) VALUES (:username, :email, :password, "user")';
                    $insert_query = $db->prepare($insert_stmt);
                    $insert_query->bindParam(":username", $username);
                    $insert_query->bindParam(":email", $email);
                    $insert_query->bindParam(":password", $hashed_pass);
                    $insert_query->execute();
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="password-conf">Confirm Password:</label><br>
        <input type="password" id="password-conf" name="password-conf" required><br><br>

        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Log in here</a></p>
</body>
</html>

