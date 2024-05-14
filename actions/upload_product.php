<?php
function uploadProduct($db, $username, $imageFile, $title, $description, $price, $condition, $category, $seller_id)
{
    if (isset($imageFile) && $imageFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/';
        $filename = uniqid() . '_' . $imageFile['name'];
        // Define the full path to the uploaded file
        $uploadPath = $uploadDir . $filename;
        
        // Move the uploaded file to the designated directory
        if (move_uploaded_file($imageFile['tmp_name'], $uploadPath)) {



            
            // Insert product into database
            $query = "INSERT INTO products (title, description, price, condition, category, seller_id) VALUES (:title, :description, :price, :condition, :category, :seller_id)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":condition", $condition);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":seller_id", $seller_id);
            

            // Execute the query
            if($stmt->execute()) {
                // Get the ID of the newly inserted product
                $product_id = $db->lastInsertId();
                
                // Insert the uploaded image path into the images table
                $image_url = '../../assets/' . $filename;
                $query = "INSERT INTO images (title, img_url, carousel_img, product_id) VALUES (:title, :img_url, :carousel_img, :product_id)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":img_url", $image_url);
                $stmt->bindParam(":carousel_img", $image_url);
                $stmt->bindParam(":product_id", $product_id);
                
                // Execute the query
                if ($stmt->execute()) {
                    echo "<p>Product added successfully.</p>";
                } else {
                    echo "<p>Error adding product.</p>";
                }
            } else {
                echo "<p>Error adding product.</p>";
            }
        } else {
            echo "<p>Error uploading image.</p>";
        }
    }
}
?>
