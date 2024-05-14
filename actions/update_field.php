<?php
function updateField($db, $username, $field, $value)
{
    var_dump($field);
    $query = "UPDATE users SET $field = :value WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
}
?>
