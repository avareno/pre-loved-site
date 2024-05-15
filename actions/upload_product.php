<?php
function uploadProduct($db, $username, $imageFile, $title, $description, $price, $condition, $category, $seller_id)
{
    
    if (isset($imageFile) && $imageFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/';
        $filename = uniqid() . '_' . $imageFile['name'];
        
        $uploadPath = $uploadDir . $filename;

        
        if (move_uploaded_file($imageFile['tmp_name'], $uploadPath)) {

            $query = "INSERT INTO products (title, description, price, condition, category, seller_id) VALUES (:title, :description, :price, :condition, :category, :seller_id)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":condition", $condition);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":seller_id", $seller_id);

            
            if($stmt->execute()) {
                
                $product_id = $db->lastInsertId();

                $image_url = '../../assets/' . $filename;
                $query = "INSERT INTO images (title, img_url, carousel_img, product_id) VALUES (:title, :img_url, :carousel_img, :product_id)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":img_url", $image_url);
                $stmt->bindParam(":carousel_img", $image_url); 
                $stmt->bindParam(":product_id", $product_id);

                
                $stmt->execute();
            }
        }
    } else {
        $query = "INSERT INTO products (title, description, price, condition, category, seller_id) VALUES (:title, :description, :price, :condition, :category, :seller_id)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":condition", $condition);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":seller_id", $seller_id);

        
        if($stmt->execute()) {
           
            $product_id = $db->lastInsertId();

            $query = "INSERT INTO images (title,product_id) VALUES (:title,  :product_id)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":product_id", $product_id);

            $stmt->execute();
        }
    }
}
?>
