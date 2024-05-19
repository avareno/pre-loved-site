<?php

function checkSessionAndRedirect($redirectPage)
{
    session_start();
    if (!isUserLoggedIn()) {
        header("Location: " . $redirectPage);
        exit();
    }
}

function getUserByUsername($db, $username)
{
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row; // Returns the user data as an associative array
}

function getUserByUserId($db, $id)
{
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row; // Returns the user data as an associative array
}

function getProductsBySellerId($db, $sellerId)
{
    $product_query = "SELECT * FROM products WHERE seller_id = :seller_id";
    $product_stmt = $db->prepare($product_query);
    $product_stmt->bindParam(":seller_id", $sellerId);
    $product_stmt->execute();
    $products = $product_stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products; // Returns an array of products
}

function isUserLoggedIn()
{
    return isset($_SESSION['username']);
}

function isPostParamSet($paramName)
{
    return isset($_POST[$paramName]);
}

function isGetParamSet($paramName)
{
    return isset($_GET[$paramName]);
}

function fetchDataAll($db, $query, $params = [])
{
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchData($db, $query, $params = [])
{
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    function getCartbyUser($db, $id){
        $query = $db->prepare('SELECT products.id, products.title, products.description, products.price, products.seller_id, images.carousel_img FROM shopping_cart JOIN products ON shopping_cart.product_id = products.id JOIN images ON products.title = images.title WHERE shopping_cart.user_id = :user_id');
        $query->bindValue(':user_id', $id, PDO::PARAM_STR);
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    function getSoldProductsBySellerId($db, $sellerId) {
        $query = "
            SELECT sp.*, p.title AS product_title, u.username AS buyer_username
            FROM sold_products sp
            JOIN products p ON sp.product_id = p.id
            JOIN users u ON sp.user_id = u.id
            WHERE sp.seller_id = :seller_id ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":seller_id", $sellerId, PDO::PARAM_INT);
        $stmt->execute();
        $sold_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $sold_products;
    }

    function getSoldProductDetails($db, $sold_product_id) {
        $query = $db->prepare('
            SELECT sp.*, 
                   p.title, p.description, p.price, p.condition, p.category, 
                   u_buyer.username AS buyer_username, u_buyer.email AS buyer_email, u_buyer.country AS buyer_country, u_buyer.city AS buyer_city, u_buyer.phone_number AS buyer_phone,
                   u_seller.username AS seller_username, u_seller.email AS seller_email, u_seller.country AS seller_country, u_seller.city AS seller_city, u_seller.phone_number AS seller_phone
            FROM sold_products sp
            JOIN products p ON sp.product_id = p.id
            JOIN users u_buyer ON sp.user_id = u_buyer.id
            JOIN users u_seller ON sp.seller_id = u_seller.id
            WHERE sp.id = :sold_product_id
        ');
        $query->bindValue(':sold_product_id', $sold_product_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
    }
    
    

?>
