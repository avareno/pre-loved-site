<?php

require_once ("delete_field.php");
require_once ("../utils/getters.php");
require_once '../database/read_tables.php';
require_once 'update_field.php';
$db = getDatabaseConnection();


checkSessionAndRedirect("../pages/login/login.php");

$username = $_SESSION['username'];



if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

   updateFieldCart($db, $product_id, $username);

    header("Location: ../pages/products_page/product_profile.php?id=$product_id&added_to_cart=true");
    exit;
} else {
    

    header("Location: error.php");
    exit;
}
?>
