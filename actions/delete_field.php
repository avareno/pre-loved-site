<?php
function deleteFieldUsers($db, $username)
{

    $query = "DELETE FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
}

function deleteFieldProducts($db, $product_id)
{
    var_dump($product_id);
    $query = "DELETE FROM Products WHERE id = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    $query = "DELETE FROM images WHERE product_id = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
}
?>
