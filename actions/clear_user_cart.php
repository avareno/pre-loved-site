<?php
require_once '../utils/getters.php';
function clearUserCart($db, $username, $products) {
    
    foreach ($products as $product) {
        $product_id = $product['id'];
        $seller_id = $product['seller_id'];
        $row = getUserByUsername($db, $username);
        $user_id = $row['id'];
        $queryIncreaseQuantity = $db->prepare('UPDATE products SET quantity = 0 WHERE id = :product_id');
        $queryIncreaseQuantity->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $queryIncreaseQuantity->execute();

        $queryRemoveFromCart = $db->prepare('DELETE FROM shopping_cart WHERE user_id = :user_id AND product_id = :product_id');
        $queryRemoveFromCart->bindValue(':user_id', $username, PDO::PARAM_STR);
        $queryRemoveFromCart->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $queryRemoveFromCart->execute();

        $queryInsertSoldProduct = $db->prepare('INSERT INTO sold_products (product_id, user_id, seller_id) VALUES (:product_id, :user_id, :seller_id)');
        $queryInsertSoldProduct->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $queryInsertSoldProduct->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $queryInsertSoldProduct->bindValue(':seller_id', $seller_id, PDO::PARAM_INT);
        $queryInsertSoldProduct->execute();
    }


}

?>