<?php
require_once 'query_execute.php';

function uploadProduct($db, $username, $imageFile, $title, $description, $price, $condition, $category, $seller_id)
{
    
    if (isset($imageFile) && $imageFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/';
        $filename = uniqid() . '_' . $imageFile['name'];
        
        $uploadPath = $uploadDir . $filename;

        
        if (move_uploaded_file($imageFile['tmp_name'], $uploadPath)) {

            $query = "INSERT INTO products (title, description, price, condition, category, seller_id) VALUES (:title, :description, :price, :condition, :category, :seller_id)";
            $params = [
                ':title' => $title,
                ':description' => $description,
                ':price' => $price,
                ':condition' => $condition,
                ':category' => $category,
                ':seller_id' => $seller_id
            ];

            // Execute the query
            if(executeQuery($db, $query, $params)) {
                // Get the ID of the newly inserted product
                $product_id = $db->lastInsertId();

                $image_url = '../../assets/' . $filename;
                $query = "INSERT INTO images (title, img_url, carousel_img, product_id) VALUES (:title, :img_url, :carousel_img, :product_id)";
                $params = [
                    ':title' => $title,
                    ':img_url' => $image_url,
                    ':carousel_img' => $image_url,
                    ':product_id' => $product_id
                ];

                // Execute the query
                executeQuery($db, $query, $params);
            }
        }
    } else {
        $query = "INSERT INTO products (title, description, price, condition, category, seller_id) VALUES (:title, :description, :price, :condition, :category, :seller_id)";
        $params = [
            ':title' => $title,
            ':description' => $description,
            ':price' => $price,
            ':condition' => $condition,
            ':category' => $category,
            ':seller_id' => $seller_id
        ];

        // Execute the query
        if(executeQuery($db, $query, $params)) {
            // Get the ID of the newly inserted product
            $product_id = $db->lastInsertId();

            // Insert product with default values for img_url and carousel_img
            $query = "INSERT INTO images (title,product_id) VALUES (:title, :product_id)";
            $params = [
                ':title' => $title,
                ':product_id' => $product_id
            ];

            // Execute the query
            executeQuery($db, $query, $params);
        }
    }
}
?>
