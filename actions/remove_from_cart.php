<?php
require_once ("delete_field.php");
require_once ("../utils/getters.php");
require_once '../database/read_tables.php';
require_once 'update_field.php';
$db = getDatabaseConnection();


checkSessionAndRedirect("../pages/login/login.php");

$username = $_SESSION['username'];


if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    $product_id = $_POST['product_id'];


    deleteFieldCart($db, $product_id, $username);

    header("Location: ../pages/cart/cart.php");
    exit;
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Bad Request"));
    exit;
}
?>
