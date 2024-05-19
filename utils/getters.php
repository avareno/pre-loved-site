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

function getCartbyUser($db, $id)
{
    $query = $db->prepare('SELECT products.id, products.title, products.description, products.price, products.seller_id, images.carousel_img FROM shopping_cart JOIN products ON shopping_cart.product_id = products.id JOIN images ON products.title = images.title WHERE shopping_cart.user_id = :user_id');
    $query->bindValue(':user_id', $id, PDO::PARAM_STR);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}
?>