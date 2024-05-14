<?php
require_once '../../database/read_tables.php';
require_once '../../common/index_header.php';
require_once '../../templates/product_profile_page.php';

$db = getDatabaseConnection();
if(isGetParamSet('id')){
    $product_id = $_GET['id'];
}


$product = fetchData($db,'SELECT * FROM products WHERE id = :product_id',[':product_id' => $product_id]);

$productImage = fetchData($db,'SELECT carousel_img FROM images WHERE product_id = :product_id LIMIT 1',[':product_id' => $product_id]);

// If the product is not found or image URL is not available, handle the error
if (!$product || !$productImage) {
    echo "<p>Error: Product not found or image not available.</p>";
    // You can redirect the user to an error page or display a message
    exit; // Stop further execution
}

drawHeader();
drawProductProfile($product, $productImage,$product_id);
?>
