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
        }else{
            if($password!= $password_conf){
                echo 'different passwords';
            }else{
                $query = "SELECT * FROM USERS WHERE username = :username OR email = :email";
                $stmt = $db->prepare($query);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                if( $stmt->rowCount() > 0){
                    echo 'Username or email already exists';
                }else{
                    $hashed_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    $insert_stmt = 'INSERT INTO users (username, email, password,permissions) VALUES (:username, :email, :password,"user")';
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
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" >
        <label >Username:</label><br>
        <input type="text"  name="username" required><br><br>

        <label >Email:</label><br>
        <input type="email"  name="email" required><br><br>

        <label >Password:</label><br>
        <input type="password"  name="password" required><br><br>

        <label >Confirm Password:</label><br>
        <input type="password"  name="password-conf" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
