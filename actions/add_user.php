<?php
function createUser($db, $username, $email, $password)
{


    
    $insert_stmt = 'INSERT INTO users (username, email, password, permissions) VALUES (:username, :email, :password, "user")';
    $insert_query = $db->prepare($insert_stmt);

  
    $insert_query->bindParam(":username", $username);
    $insert_query->bindParam(":email", $email);
    $insert_query->bindParam(":password", $password);

    
    $insert_query->execute();
}

?>