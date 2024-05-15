<?php
require_once '../../database/read_tables.php';
require_once '../../common/index_header.php';
require_once '../../templates/index_page.php';

$db = getDatabaseConnection();

$latests = fetchDataAll($db, 'SELECT p.id, p.title, i.carousel_img AS carousel_url
                                                              FROM products p
                                                              JOIN images i ON p.id = i.product_id
                                                              ORDER BY p.created_at DESC
                                                              LIMIT 4');

$images = fetchDataAll($db, 'SELECT * FROM IMAGES');

$products = fetchDataAll($db, 'SELECT * FROM products');

drawHeader();

drawIndexMain($images, $products, $latests);
?>