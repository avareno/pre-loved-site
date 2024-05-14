<?php
function createUser($db, $username, $email, $password)
{
    // Hash the password
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the insert statement
    $insert_stmt = 'INSERT INTO users (username, email, password, permissions) VALUES (:username, :email, :password, "user")';
    $insert_query = $db->prepare($insert_stmt);

    // Bind parameters
    $insert_query->bindParam(":username", $username);
    $insert_query->bindParam(":email", $email);
    $insert_query->bindParam(":password", $hashed_pass);

    // Execute the query
    $insert_query->execute();
}
?>
