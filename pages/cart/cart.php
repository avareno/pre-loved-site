<?php
session_start();
require_once '../../database/read_tables.php';
require_once '../../utils/getters.php';
require_once '../../common/index_header.php';
require_once '../../templates/shopping_cart_tpl.php';


$db = getDatabaseConnection();
checkSessionAndRedirect("../login/register.php");


$username = $_SESSION['username'];



$products = getCartbyUser($db, $username);





drawHeader();
drawShoppingCart($db, $products);



?>

