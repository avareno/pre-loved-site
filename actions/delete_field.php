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



function deleteFieldCart($db, $product_id, $username)
{

    $queryIncreaseQuantity = $db->prepare('UPDATE products SET quantity = 1 WHERE id = :product_id');
    $queryIncreaseQuantity->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $queryIncreaseQuantity->execute();

    $queryRemoveFromCart = $db->prepare('DELETE FROM shopping_cart WHERE user_id = :user_id AND product_id = :product_id');
    $queryRemoveFromCart->bindValue(':user_id', $username, PDO::PARAM_STR);
    $queryRemoveFromCart->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $queryRemoveFromCart->execute();



}


?>



