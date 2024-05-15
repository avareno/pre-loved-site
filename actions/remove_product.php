<?php
require_once ("delete_field.php");
require_once ("../utils/getters.php");
require_once '../database/read_tables.php';
$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isPostParamSet("remove")) {
        $product_id = $_POST['product_id'];
        var_dump($product_id);
        deleteFieldProducts($db, $product_id);
        header("Location: ../pages/profile/profile.php");
        exit;
    }
}

?>