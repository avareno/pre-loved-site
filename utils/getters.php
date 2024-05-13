<?php
function getProductsBySellerId($db, $sellerId)
{
    $product_query = "SELECT * FROM products WHERE seller_id = :seller_id";
    $product_stmt = $db->prepare($product_query);
    $product_stmt->bindParam(":seller_id", $row['id']);
    $product_stmt->execute();
    return $products = $product_stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>
