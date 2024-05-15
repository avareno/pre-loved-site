<?php
function updateFieldUsers($db, $username, $field, $value)
{

    $query = "UPDATE users SET $field = :value WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
}

function updateFieldProducts($db, $product_id, $field, $value)
{

    $query = "UPDATE Products SET $field = :value WHERE product_id = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
}
?>
