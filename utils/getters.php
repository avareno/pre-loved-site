<?php

    function checkSessionAndRedirect($redirectPage) {
        session_start();
        if (!isUserLoggedIn()) {
            header("Location: " . $redirectPage);
            exit();
        }
    }

    function getUserByUsername($db, $username) {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; // Returns the user data as an associative array
    }

    function getProductsBySellerId($db, $sellerId) {
        $product_query = "SELECT * FROM products WHERE seller_id = :seller_id";
        $product_stmt = $db->prepare($product_query);
        $product_stmt->bindParam(":seller_id", $sellerId);
        $product_stmt->execute();
        $products = $product_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products; // Returns an array of products
    }

    function isUserLoggedIn() {
        return isset($_SESSION['username']);
    }

    function isPostParamSet($paramName) {
            return isset($_POST[$paramName]);
    }

    function isGetParamSet($paramName) {
            return isset($_GET[$paramName]);
    }

    function fetchDataAll($db, $query, $params = []) {
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetchData($db, $query, $params = []) {
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

?>
