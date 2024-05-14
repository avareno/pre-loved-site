<?php
require '../../database/read_tables.php';
require '../../common/index_header.php';
require '../../templates/products_page.php';

$db = getDatabaseConnection();

// Handle search
if (isPostParamSet('find')) {
    $key = '%' . $_POST['key'] . '%';
    $query = 'SELECT id, title, carousel_img FROM images WHERE title LIKE :keyword ORDER BY title';
    $results = fetchDataAll($db, $query, [':keyword' => $key]);
}

if (isGetParamSet('category')) {
    $category = $_GET['category'];
    $query = 'SELECT p.id, p.title, i.carousel_img FROM products p JOIN images i ON p.id = i.product_id WHERE p.category = :category';
    $products = fetchDataAll($db, $query, [':category' => $category]);
}


drawHeader();
drawGridSection($results,$products);
?>