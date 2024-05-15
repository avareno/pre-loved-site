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

    $query = "UPDATE Products SET $field = :value WHERE id = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
}


function updateFieldCart($db, $product_id, $username)
{
    $query = $db->prepare('INSERT INTO shopping_cart (user_id, product_id) VALUES (:user_id, :product_id)');
    $query->bindValue(':user_id', $username, PDO::PARAM_STR);
    $query->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $query->execute();

    $decrementQuery = $db->prepare('UPDATE products SET quantity = 0 WHERE id = :product_id');
    $decrementQuery->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $decrementQuery->execute();

}
?>