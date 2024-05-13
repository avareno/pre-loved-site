<?php
function updateField($db, $username, $field, $value)
{
    $query = "UPDATE users SET $field = :value WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
}
?>
