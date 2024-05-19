<?php
session_start();
require_once '../../database/read_tables.php';
require_once '../../utils/getters.php';
require_once '../../templates/shipping_label_tpl.php';
$db = getDatabaseConnection();

if (isset($_GET['sold_product_id'])) {
    $sold_product_id = $_GET['sold_product_id'];

    
    $sold_product = getSoldProductDetails($db, $sold_product_id);

    drawShippingLabel($db, $sold_product);
   
}
?>
